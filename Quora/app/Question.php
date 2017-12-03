<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
      'question',
      'state',
      'topic',
      'answer',
       'upvote',
        'bookmarked'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
