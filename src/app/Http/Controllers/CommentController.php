<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Events\NewComment;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvoicePaid;



class CommentController extends Controller
{


    public function createToken(Request $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['token' => $token];
    }
    public function index(Post $post)
    {
        return response()->json($post->comments()->with('user')->latest()->get());
    }

    public function store(Request $request, Post $post)
    {
        $comment = $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);

        $comment = Comment::where('id', $comment->id)->with('user')->first();

        broadcast(new NewComment($comment))->toOthers();


        //return Auth::user()->id;
        #return $post->user_id;
        #return $post->user;
        if (Auth::user()->id != $post->user_id) {
            $post->user->notify(new InvoicePaid($comment));
        }
        return $comment->toJson();
    }
}
