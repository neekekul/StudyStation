<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Retrieve the lesson associated with a specific comment by foreign key.
     *
     * @params  n/a
     * @return  php variable $this that belongs to a certain Lesson
     */
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Retrieve the user associated with a specific comment by a link of foreign keys.
     *
     * @params  n/a
     * @return  php variable $this that belongs to a certain User.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
