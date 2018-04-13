<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class StudentCourseViewerController extends Controller
{
  protected function onStudentViewCourseCreate(){
      return view('studentCourseViewer');

    }
  protected function getCourses(){
    $courses = Course::select('name', 'instructor_id', 'id')->where('instructor_id','>','-1') -> get();
    return view('studentCourseViewer',compact('courses'));
  }
}
