<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * Retrieve the comments associated with a specific lesson by a foreign key.
     *
     * @params  n/a
     * @return  php variable $this that has many Comments.
     */
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * Retrieve the Course associated with a specific Lesson by a foreign key.
     *
     * @params  n/a
     * @return  php variable $this that belongs to a certain Course.
     */
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
