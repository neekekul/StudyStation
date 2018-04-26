<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
