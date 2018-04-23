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

    //all functions must be authenticated in this controller by the 'auth' middleware. Except logout of course.
    public function __construct()
    {
        $this->middleware('auth')->except('destroy');
    }

    //method to pull up the lesson creator function.
    public function lessonCreate(){

        //This ORM query gets all the courses that are owned by the specificly authenticated instructor/user.
        $courses = Course::select('name', 'id')->where('instructor_id', '=', auth()->user()->id)->get();

        //return the lesson creator view, and pass all of those courses to the view itself for display/use.
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

    public function lessonShow(){

        //first completely validate the users input
        $this->validate(request(), [

            'lesson' => 'required|integer',
        ]);

        $lessonID = request('lesson');

        $lesson = Lesson::where('id', $lessonID)->first();

        $courseID = $lesson->course_id;

        $course = Course::where('id', $courseID)->first();

        return view('lessonViewer', compact('lesson', 'course'));

    }

    public function lessonStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'course' => 'required|integer',
            'title' => 'required|string|alpha_num|max:100',
            'body' => 'required|string|max:13000',
            'note' => 'string|max:700',
        ]);
        $lessons = Lesson::latest()->get();

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

        return view('instructorHome', compact('msg', 'lessons'));

    }

    public function courseStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'name' => 'required|string|alpha_num|max:100',
        ]);
        $lessons = Lesson::latest()->get();

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

        return view('instructorHome', compact('msg', 'lessons'));

    }

    public function editEmailStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'email' => 'email|string|max:60',

        ]);
        $lessons = Lesson::latest()->get();

        $email = request('email');

        $msg = '';

        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->email = $email;

        if ($user->save()){

            $msg = 'Account has been updated properly! Please press home.';

        }else{

            $msg = 'Error updating your account..';

        }

        return view('instructorHome', compact('msg', 'lessons'));
    }

    public function editUsernameStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'username' => 'string|alpha_num|max:60',

        ]);
        $lessons = Lesson::latest()->get();

        $username = request('username');

        $msg = '';

        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->username = $username;

        if ($user->save()){

            $msg = 'Account has been updated properly! Please press home.';

        }else{

            $msg = 'Error updating your account..';

        }

        return view('instructorHome', compact('msg', 'lessons'));
    }


    public function destroy(){

        auth()->logout();

        return redirect('/');
    }
}
