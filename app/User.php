<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retrieve the Courses associated with a specific User by a foreign key.
     *
     * @params  n/a
     * @return  php variable $this that has many Courses.
     */
    public function courses(){
        return $this->hasMany(Course::class);
    }

    /**
     * Retrieve the Links associated with a specific User by a foreign key.
     *
     * @params  n/a
     * @return  php variable $this that has many Links.
     */
    public function links(){
        return $this->hasMany(Link::class);
    }
}
