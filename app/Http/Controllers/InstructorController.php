<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lesson;
use App\Course;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class InstructorController extends Controller
{

    //
    public function __construct()
    {
        $this->middleware('auth')->except('destroy');
    }

    public function lessonCreate(){

        $courses = Course::select('name', 'id')->where('instructor_id', '=', auth()->user()->id)->get();

        return view('lessonCreator', compact('courses'));
    }

    public function courseCreate(){
        $courses = Course::select('name', 'instructor_id', 'id')->where('instructor_id', '=', auth()->user()->id)->get();


        return view('courseCreator', compact('courses'));
    }

    public function editCreate(){
        return view('editInstructor');
    }

    public function courseShow(){
        $courses = Course::select('name', 'instructor_id', 'id')->where('instructor_id', '=', auth()->user()->id)->get();

        return view('courseViewer', compact('courses'));

    }

    public function courseGuts(){
        //first completely validate the users input
        $this->validate(request(), [

            'course' => 'required|integer',
        ]);

        $courseID = request('course');

        $course = Course::where('id', $courseID)->first();

        $lessons = Lesson::select('title', 'id')->where('course_id', $courseID)->get();

        return view('courseGuts', compact('lessons', 'course'));
    }

    public function lessonStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'course' => 'required|integer',
            'title' => 'required|string|alpha_num|max:100',
            'body' => 'required|string|max:13000',
            'note' => 'string|max:700',
        ]);

        $courses = Course::select('name', 'id')->where('instructor_id', '=', auth()->user()->id)->get();

        //pull the fields into php variables
        $courseID = request('course');
        $title = request('title');
        $body = request('body');
        $note = request('note');
        $msg = '';

        $lesson = new Lesson;
        $lesson->course_id = $courseID;
        $lesson->title = $title;
        $lesson->body = $body;
        $lesson->summary = $note;
        if ($lesson->save()){
            $msg = 'Lesson has been saved!';
        }else{
            $msg = 'Lesson has failed to be saved correctly.';
        }

        return view('lessonCreator', compact('msg', 'courses'));

    }

    public function courseStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'name' => 'required|string|alpha_num|max:100',
        ]);

        $courses = Course::select('name')->where('instructor_id', '=', auth()->user()->id)->get();

        //pull the fields into php variables
        $name = request('name');
        $msg = '';

        $course = new Course;
        $course->instructor_id = auth()->user()->id;
        $course->name = $name;

        if ($course->save()){
            $msg = 'Course has been saved!';
        }else{
            $msg = 'Course failed to be saved..';
        }

        return view('courseCreator', compact('msg', 'courses'));

    }

    public function editStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'username' => 'string|alpha_num|max:60',
            'email' => 'email|string|max:60',

        ]);

        $username = request('username');

        $email = request('email');

        $msg = '';

        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->username = $username;

        $user->email = $email;

        if ($user->save()){

            $msg = 'Account has been updated properly!';

        }else{

            $msg = 'Error updating your account..';

        }

        return view('editInstructor', compact('msg'));
    }


    public function destroy(){

        auth()->logout();

        return redirect('/');
    }
}
