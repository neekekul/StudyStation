<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Course;
use App\Lesson;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * All functions must be authenticated in this controller by the 'auth' middleware. Except logout of course.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('destroy');
    }

    /**
     * Show the applications home screen depending on user type.
     * Passing relevant
     *
     * @return view('instructorHome', compact('lessons', 'instructors', 'user'))
     * @return view('studentHome', compact('instructors', 'lessons', 'user'))
     */
    public function show()
    {
        $instructors= User::where('type','instructor')->get();
        $lessons = Lesson::latest()->get();
        $user = Auth::user();
        
        if (auth()->user()->type == 'instructor'){
            return view('instructorHome', compact('lessons', 'instructors', 'user'));
        }
        else{
            return view('studentHome', compact('instructors', 'lessons', 'user'));
        }
    }
}
