<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    // public function educations()
    // {
    //     return $this->hasMany(Education::class)->orderBy('start_year', 'DESC');
    // }


    // public function experiences()
    // {
    //     return $this->hasMany(Experience::class)->orderBy('start_year', 'DESC');
    // }
}
