<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * Retrieve the user associated with a specific Link by a foreign key.
     *
     * @params  n/a
     * @return  php variable $this that belongs to a certain User.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
