<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Course;
use App\Lesson;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('destroy');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $instructors= User::where('type','instructor')->get();
        $lessons = Lesson::latest()->get();
        
        if (auth()->user()->type == 'instructor'){
            return view('instructorHome', compact('lessons', 'instructors'));
        }
        else{
            return view('studentHome', compact('instructors', 'lessons'));
        }
    }
}
