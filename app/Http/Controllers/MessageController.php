<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();
        // All threads that user is participating in
         $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();
        // All threads that user is participating in, with new messages
        //$threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();
        return view('messenger.index', compact('threads'));
    }
    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messenger');
        }
        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list
        $thread->getParticipantFromUser(Auth::id());
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
        $thread->markAsRead($userId);
        return view('messenger.show', compact('thread', 'users'));
    }
    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messenger.create', compact('users'));
    }
    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();
        $toUser = intval(Input::get('test'));
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );

        $user_id = Auth::user()->id;
        $threaduser1 = Participant::where('user_id', $user_id )->first();
        $threaduser2 = Participant::where('user_id', $toUser)->first();

        if(is_null($threaduser1)|| is_null($threaduser2)){
            // Message
            Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => Auth::user()->id,
                    'body'      => $input['message'],
                ]
            );
            // Sender
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => Auth::user()->id,
                    'last_read' => new Carbon,
                ]
            );
            // Recipients
            $thread->addParticipant($toUser);
        }else{
            if($threaduser1->thread_id == $threaduser2->thread_id){

                // Message
                Message::create(
                    [
                        'thread_id' => Participant::where('user_id', Auth::user()->id)->first()->thread_id,
                        'user_id'   => $user_id,
                        'body'      => $input['message'],
                    ]
                );

                // Sender
                Participant::where('id', $threaduser1->id)->update(
                    [
                        'thread_id' => Participant::where('user_id', Auth::user()->id)->first()->thread_id,
                        'user_id'   => Auth::user()->id,
                        'last_read' => new Carbon,
                    ]
                );
                // Recipients
                $thread->addParticipant($toUser);
            }else{
                // Message
                Message::create(
                    [
                        'thread_id' => $thread->id,
                        'user_id'   => Auth::user()->id,
                        'body'      => $input['message'],
                    ]
                );
                // Sender
                Participant::create(
                    [
                        'thread_id' => $thread->id,
                        'user_id'   => Auth::user()->id,
                        'last_read' => new Carbon,
                    ]
                );
                // Recipients
                $thread->addParticipant($toUser);
            }
        }





        return redirect('messenger');
    }
    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messenger');
        }
        $thread->activateAllParticipants();
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );
        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }
        return redirect(route('messages.show', $id));
    }
}
