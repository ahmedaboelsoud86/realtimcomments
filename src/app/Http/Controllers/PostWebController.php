<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PostWebController extends Controller
{

    public function index(Post $post)
    {
        return view('posts');
    }

    public function show(Post $post)
    {
        #return Auth::user()->id;
        return view('post', compact('post'));
    }
}
