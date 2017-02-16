<?php

namespace App\Http\Middleware;

use App\Article;
use Closure;
use Illuminate\Support\Facades\Auth;

class isArticleOwner
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
        if(Auth::check() && Article::find(intval($request->route('article')))->user_id == Auth::user()->id){
            return $next($request);
        }else{
            return redirect('articles');
        }
    }
}
