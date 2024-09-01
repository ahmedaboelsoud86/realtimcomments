<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


//For All Authorization Users
// Broadcast::channel('post.{id}', function ($user, $id) {
//     return true;
// });
/// For Only Auther
Broadcast::channel('post.{id}', function ($user, $id) {
    return $user->id == \App\Models\Post::find($id)->user_id;
});
