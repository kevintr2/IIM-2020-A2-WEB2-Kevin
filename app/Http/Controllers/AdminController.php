<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('isAdmin');
    }

    public function index(){
        return view('admin.index');
    }

    public function articles(){
        $articles = Article::paginate(5);
        return view('admin.articles', compact('articles'));
    }

    public function comments($id){

        $comments = Comment::where('article_id', $id)->get();
        return view('admin.comments', compact('comments', 'id'));
    }
}
