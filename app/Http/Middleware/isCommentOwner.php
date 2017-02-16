<?php

namespace App\Http\Middleware;

use App\Comment;
use Closure;
use Illuminate\Support\Facades\Auth;

class isCommentOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Comment::find(intval($request->route('id')))->user_id == Auth::user()->id){
            return $next($request);
        }else{
            return redirect('articles');
        }
    }
}
