<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
      'comment',
      'question_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }


}
