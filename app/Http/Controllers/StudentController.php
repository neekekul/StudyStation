<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Link;
use App\Lesson;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    //all functions must be authenticated in this controller by the 'auth' middleware. Except logout of course.
    public function __construct()
    {
        $this->middleware('auth');
    }
  protected function onStudentViewCourseCreate(){
      return view('studentCourseViewer');

    }

  protected function makeLink(){
    $this->validate(request(), [

        'insID' => 'required|integer',
    ]);
    $ins = Request('insID');
    $msg = '';
    $link = new Link;
    $link->user_id = auth()->user()->id;
    $link->link_id = $ins;
    if ($link->save()){
        $msg = 'Link has been saved!';
    }else{
        $msg = 'Link failed to be saved..';
    }
    $instructors= User::where('type','instructor')->get();
    $user = Auth::user();
    $link = Link::where('link_id', $ins)->first();
    $courses = Course::where('user_id', $ins)->get();
    $instruct = User::where('id', $ins)->first();
    return view ('studentInstructorView', compact('instruct', 'instructors', 'user', 'msg', 'link', 'courses'));
    }

    public function unmakeLink(){

        $this->validate(request(), [

            'insID' => 'required|integer',
        ]);

        $ins = Request('insID');

        $msg = '';

        $link = Link::where('link_id', $ins)->first();

        if($link->delete()){
            $msg = 'Link Correctly Terminated!';
        }else{
            $msg = 'Link was not deleted properly!';
        }

        $instructors= User::where('type','instructor')->get();
        $user = Auth::user();
        $link = Link::where('link_id', $ins)->first();
        $courses = Course::where('user_id', $ins)->get();
        $instruct = User::where('id', $ins)->first();

        return view('studentInstructorView', compact('instruct', 'instructors', 'user', 'msg', 'link', 'courses'));
    }
  protected function getCourses(){
    $courses = Course::select('courses.name','courses.id', 'users.username')
	->join('links', 'courses.user_id', '=', 'links.ins_id')
	->where('links.stu_id', '=', auth()->user()->id)
  ->join('users', 'links.ins_id', '=', 'users.id')
  ->where('users.id', '>', '0')
	->get();

  return view('studentHome', compact('courses', 'instructors'));
  }

    public function getLinks(){

        $user = Auth::user();
        $instructors = User::where('type', 'instructor')->get();
        return view('linkedInstructorView', compact('user', 'instructors'));
    }

    public function instructorFind(){
        //first completely validate the users input
        $this->validate(request(), [

            'search' => 'required|integer',
        ]);

        $instructorID = request('search');

        $instructors= User::where('type','instructor')->get();

        $instruct = User::where('id', $instructorID)->first();

        $link = Link::where('link_id', $instructorID)->first();

        $courses = Course::where('user_id', $instructorID)->get();

        return view('studentInstructorView', compact('instructors', 'instruct', 'courses', 'link'));
    }
}
