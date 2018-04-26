<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
