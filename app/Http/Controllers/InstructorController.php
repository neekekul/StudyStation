<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class InstructorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except('destroy');
    }

    public function create(){
        return view('instructorHome');
    }
}
