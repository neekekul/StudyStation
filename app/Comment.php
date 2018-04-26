<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
