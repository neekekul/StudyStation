<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Lesson;
use App\Course;
use App\Comment;
use Image;
use Auth;
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
        $courses = Course::select('name', 'id')->where('user_id', '=', auth()->user()->id)->get();

        //return the lesson creator view, and pass all of those courses to the view itself for display/use.
        return view('lessonCreator', compact('courses'));
    }

    public function courseCreate(){
        $courses = Course::select('name', 'user_id', 'id')->where('user_id', '=', auth()->user()->id)->get();

        $user = Auth::user();


        return view('courseCreator', compact('user'));
    }

    public function editCreate(){
        return view('editInstructor');
    }

    public function courseShow(){
        $courses = Course::select('name', 'user_id', 'id')->where('user_id', '=', auth()->user()->id)->get();

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

        $lessonComments = Comment::where('lesson_id', $lessonID)->get();


        return view('lessonViewer', compact('lesson', 'course', 'lessonComments'));

    }

    public function commentStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'lesson' => 'required|integer',
            'body' => 'required|string|max:2000',
        ]);

        $lessonID = request('lesson');

        $lessonComment = request('body');

        $lesson = Lesson::where('id', $lessonID)->first();

        $courseID = $lesson->course_id;

        $course = Course::where('id', $courseID)->first();

        $msg = '';

        $comment = new Comment;

        $comment->lesson_id = $lessonID;

        $comment->user_id = auth()->user()->id;

        $comment->body = $lessonComment;

        if($comment->save()){
            $msg = 'Comment has been saved!';
        }else{
            $msg = 'Error saving comment!';
        }


        return view('lessonViewer', compact('lesson', 'course', 'msg'));

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
        $instructors= User::where('type','instructor')->get();

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

        return view('instructorHome', compact('msg', 'lessons', 'instructors'));

    }

    public function courseStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'name' => 'required|string|alpha_num|max:100',
        ]);
        $user = Auth::user();

        //pull the fields into php variables
        $name = request('name');
        $msg = '';

        $course = new Course;
        $course->user_id = auth()->user()->id;
        $course->name = $name;

        if ($course->save()){
            $msg = 'Course has been saved!';
        }else{
            $msg = 'Course failed to be saved..';
        }

        return view('courseCreator', compact('msg', 'user'));

    }

    public function iconStore(Request $request){

        if($request->hasFile('icon')){
            $icon = $request->file('icon');
            $filename = time() . '.' . $icon->getClientOriginalExtension();
            Image::make($icon)->resize(300, 300)->save( public_path('/uploads/icons/' . $filename) );
            $user = Auth::user();
            $user->icon = $filename;
            $user->save();
        }

        return view('editInstructor');
    }

    public function editEmailStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'email' => 'email|string|max:60',

        ]);
        $lessons = Lesson::latest()->get();
        $instructors= User::where('type','instructor')->get();

        $email = request('email');

        $msg = '';

        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->email = $email;

        if ($user->save()){

            $msg = 'Account has been updated properly! Please press home.';

        }else{

            $msg = 'Error updating your account..';

        }

        return view('instructorHome', compact('msg', 'lessons', 'instructors'));
    }

    public function editUsernameStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'username' => 'string|alpha_num|max:60',

        ]);
        $lessons = Lesson::latest()->get();
        $instructors= User::where('type','instructor')->get();

        $username = request('username');

        $msg = '';

        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->username = $username;

        if ($user->save()){

            $msg = 'Account has been updated properly! Please press home.';

        }else{

            $msg = 'Error updating your account..';

        }

        return view('instructorHome', compact('msg', 'lessons', 'instructors'));
    }


    public function destroy(){

        auth()->logout();

        return redirect('/');
    }
}
