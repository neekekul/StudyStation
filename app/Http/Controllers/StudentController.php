<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Link;
use App\Lesson;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
  protected function onStudentViewCourseCreate(){
      return view('studentCourseViewer');

    }

  protected function makeLink(){
    $this->validate(request(), [

        'insID' => 'required|integer',
    ]);
    $ins = Request('insID');
    $link = new Link;
    $link->stu_id = auth()->user()->id;
    $link->ins_id = $ins;
    if ($link->save()){
        $msg = 'Link has been saved!';
    }else{
        $msg = 'Link failed to be saved..';
    }
    $instructors= User::where('type','instructor')->get();
    $lessons = Lesson::latest()->get();
    return view ('studentHome', compact('ins', 'lessons', 'instructors'));
    }
  protected function getCourses(){
    $courses = Course::select('courses.name','courses.id', 'users.username')
	->join('links', 'courses.user_id', '=', 'links.ins_id')
	->where('links.stu_id', '=', auth()->user()->id)
  ->join('users', 'links.ins_id', '=', 'users.id')
  ->where('users.id', '>', '0')
	->get();

  return view('studentCourseViewer', compact('courses', 'instructors'));
  }
    public function instructorFind(){
        //first completely validate the users input
        $this->validate(request(), [

            'search' => 'required|integer',
        ]);

        $instructorID = request('search');

        $instructors= User::where('type','instructor')->get();

        $ins = User::where('id', $instructorID)->first();

        $courses = Course::where('instructor_id', $instructorID)->get();

        return view('studentInstructorView', compact('instructors', 'ins', 'courses'));
    }
}
