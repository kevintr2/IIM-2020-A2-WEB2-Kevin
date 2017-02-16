<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isCommentOwner', ['only' => 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ], [
            'content.required' => 'Un contenu est requis.',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'article_id' => $id,
        ]);

        return redirect()->route('articles.show', $id)->with('success', "Le commentaire a bien été ajouté");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Comment::find($id);
        return view('comments.edit', compact('edit', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Comment::where('id', $id)->update([
            'content' => $request->content,
        ]);

        $comment = Comment::find($id);

        return redirect()->route('articles.show', [$comment->article_id])->with('success', 'Commentaire modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        Comment::where('id', $id)->delete();


        return redirect()->route('articles.show', [$comment->article_id])->with('success', 'Commentaire supprimé avec succès');
    }
}
