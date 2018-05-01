<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Retrieve the lessons associated with a specific course by a foreign key.
     *
     * @params  n/a
     * @return  php variable $this that has many Lessons.
     */
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    /**
     * Retrieve the user associated with creating a specific course by a foreign key.
     *
     * @params  n/a
     * @return  php variable $this that belongs to a certain User.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
