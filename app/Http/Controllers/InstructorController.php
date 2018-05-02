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
     * Show the applications lesson creator view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('lessonCreator', compact('courses', 'instructors'))
     *
     */
    public function lessonCreate(){

        //This ORM query gets all the courses that are owned by the specificly authenticated instructor/user.
        $courses = Course::select('name', 'id')->where('user_id', '=', auth()->user()->id)->get();

        $instructors= User::where('type','instructor')->get();

        //return the lesson creator view, and pass all of those courses to the view itself for display/use.
        return view('lessonCreator', compact('courses', 'instructors'));
    }

    /**
     * Show the applications course creator view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('courseCreator', compact('user', 'instructors'))
     *
     */
    public function courseCreate(){
        //ORM query
        $courses = Course::select('name', 'user_id', 'id')->where('user_id', '=', auth()->user()->id)->get();

        //Retrieve authenticated user through the Auth facade.
        $user = Auth::user();

        //ORM query
        $instructors= User::where('type','instructor')->get();


        return view('courseCreator', compact('user', 'instructors'));
    }

    /**
     * Show the applications edit account view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('editInstructor', compact('instructors'))
     *
     */
    public function editCreate(){
        //ORM query
        $instructors= User::where('type','instructor')->get();

        return view('editInstructor', compact('instructors'));
    }

    /**
     * Show the applications course viewer view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('courseViewer', compact('courses', 'instructors'))
     *
     */
    public function courseShow(){

        //ORM query
        $instructors= User::where('type','instructor')->get();
        //ORM query
        $courses = Course::select('name', 'user_id', 'id')->where('user_id', '=', auth()->user()->id)->get();

        return view('courseViewer', compact('courses', 'instructors'));

    }

    /**
     * Show the applications course guts view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('courseGuts', compact('lessons', 'course', 'instructors'))
     *
     */
    public function courseGuts(){
        //first completely validate the users input
        $this->validate(request(), [

            'course' => 'required|integer',
        ]);
        //ORM query
        $instructors= User::where('type','instructor')->get();
        //request variable
        $courseID = request('course');
        //ORM query
        $course = Course::where('id', $courseID)->first();
        //ORM query
        $lessons = Lesson::select('title', 'id')->where('course_id', $courseID)->get();

        return view('courseGuts', compact('lessons', 'course', 'instructors'));
    }

    /**
     * Show the applications lesson viewer view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('lessonViewer', compact('lesson', 'course', 'lessonComments', 'instructors'))
     *
     */
    public function lessonShow(){

        //first completely validate the users input
        $this->validate(request(), [

            'lesson' => 'required|integer',
        ]);
        //ORM query
        $instructors= User::where('type','instructor')->get();
        //request variable
        $lessonID = request('lesson');
        //ORM query
        $lesson = Lesson::where('id', $lessonID)->first();
        //use the query variable to retrieve the foreign key
        $courseID = $lesson->course_id;
        //ORM query
        $course = Course::where('id', $courseID)->first();
        //ORM query
        $lessonComments = Comment::where('lesson_id', $lessonID)->get();


        return view('lessonViewer', compact('lesson', 'course', 'lessonComments', 'instructors'));

    }

    /**
     * Handles comment creation on the lesson viewer view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('lessonViewer', compact('lesson', 'course', 'msg', 'instructors'))
     *
     */
    public function commentStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'lesson' => 'required|integer',
            'body' => 'required|string|max:2000',
        ]);
        //ORM query
        $instructors= User::where('type','instructor')->get();
        //request variable
        $lessonID = request('lesson');
        //request variable
        $lessonComment = request('body');
        //ORM query
        $lesson = Lesson::where('id', $lessonID)->first();
        //Use the query result variable to get the foreign key.
        $courseID = $lesson->course_id;
        //ORM query
        $course = Course::where('id', $courseID)->first();
        //string variable message
        $msg = '';
        //instantiate a new comment or (row in comments table) using the comment model.
        $comment = new Comment;
        //populate fields appropriately
        $comment->lesson_id = $lessonID;

        $comment->user_id = auth()->user()->id;

        $comment->body = $lessonComment;

        //try to save the new comment and give the message a value
        if($comment->save()){
            $msg = 'Comment has been saved!';
        }else{
            $msg = 'Error saving comment!';
        }


        return view('lessonViewer', compact('lesson', 'course', 'msg', 'instructors'));

    }

    /**
     * Handles lesson creation in the lesson creator view
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('instructorHome', compact('msg', 'lessons', 'instructors'))
     *
     */
    public function lessonStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'course' => 'required|integer',
            'title' => 'required|string|alpha_num|max:100',
            'body' => 'required|string|max:13000',
            'image' => 'file|image',
            'note' => 'string|max:700',
        ]);
        //assign the entire request to a variable
        $request = request();
        //prepare a filename variable
        $filename = '';
        //if there was an image, save, resize.
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(700, 500)->save( public_path('/uploads/images/' . $filename) );

        }
        //ORM query
        $lessons = Lesson::latest()->get();
        //ORM query
        $instructors= User::where('type','instructor')->get();

        //pull the fields into php variables
        $courseID = request('course');
        $title = request('title');
        $body = request('body');
        $note = request('note');
        //prepare a message
        $msg = '';

        //instantiate and assign a new lesson in the lessons table
        $lesson = new Lesson;
        $lesson->course_id = $courseID;
        $lesson->title = $title;
        $lesson->body = $body;
        $lesson->image = $filename;
        $lesson->summary = $note;
        //try to save an give the message a value
        if ($lesson->save()){
            $msg = 'Lesson has been saved!';
        }else{
            $msg = 'Lesson has failed to be saved correctly.';
        }

        return view('instructorHome', compact('msg', 'lessons', 'instructors'));

    }

    /**
     * Handles course creation in the course creator view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('courseCreator', compact('msg', 'user', 'instructors'))
     *
     */
    public function courseStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'name' => 'required|string|alpha_num|max:100',
        ]);
        //get the authenticated user
        $user = Auth::user();
        //ORM query
        $instructors= User::where('type','instructor')->get();

        //pull the fields into php variables
        $name = request('name');
        //prepare a message variable
        $msg = '';

        //instantiate and assign a new course in the courses table
        $course = new Course;
        $course->user_id = auth()->user()->id;
        $course->name = $name;

        //try to save the new course and give the message a value
        if ($course->save()){
            $msg = 'Course has been saved!';
        }else{
            $msg = 'Course failed to be saved..';
        }

        return view('courseCreator', compact('msg', 'user', 'instructors'));

    }

    /**
     * Handles icon uploading in the edit account view
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('editInstructor', compact('instructors'))
     *
     */
    public function iconStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'icon' => 'file|image',
        ]);

        //pull the entire request into a variable
        $request = request();
        //ORM query
        $instructors= User::where('type','instructor')->get();

        //if it has an image/icon , save , resize
        if($request->hasFile('icon')){
            $icon = $request->file('icon');
            $filename = time() . '.' . $icon->getClientOriginalExtension();
            Image::make($icon)->resize(300, 300)->save( public_path('/uploads/icons/' . $filename) );
            $user = Auth::user();
            $user->icon = $filename;
            $user->save();
        }

        return view('editInstructor', compact('instructors'));
    }

    /**
     * Handles changing emails in the edit account view
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('instructorHome', compact('msg', 'lessons', 'instructors'))
     *
     */
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

    /**
     * Handles changing usernames in the edit account view
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('instructorHome', compact('msg', 'lessons', 'instructors'))
     *
     */
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
