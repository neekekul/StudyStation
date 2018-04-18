<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;

class StudentCourseViewerController extends Controller
{
  protected function onStudentViewCourseCreate(){
      return view('studentCourseViewer');

    }
  protected function getCourses(){
    $courses = Course::select('name', 'instructor_id','username')-> join('users', 'courses.instructor_id', '=', 'users.id') ->where('instructor_id','>','-1') -> get();
    return view('studentCourseViewer',compact('courses'));
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
