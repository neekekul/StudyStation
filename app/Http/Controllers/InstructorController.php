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

        $courses = Course::select('name')->where('instructor_id', '=', auth()->user()->id)->get();

        return view('lessonCreator', compact('courses'));
    }

    public function courseCreate(){
        $courses = Course::select('name')->where('instructor_id', '=', auth()->user()->id)->get();
        $names = $courses->filter(function($item) {
                        return $item->name;
        })->all();


        return view('courseCreator', compact('names'));
    }

    public function lessonStore(){

        //first completely validate the users input
        $this->validate(request(), [

            'title' => 'required|string|alpha_num|max:100',
            'body' => 'required|string|max:13000',
            'note' => 'string|max:700',
        ]);

        //pull the fields into php variables
        $title = request('title');
        $body = request('body');
        $note = request('note');
        $msg = '';

        $lesson = new Lesson;
        $lesson->course_id = auth()->user()->id;
        $lesson->title = $title;
        $lesson->body = $body;
        $lesson->summary = $note;
        if ($lesson->save()){
            $msg = 'Lesson has been saved!';
        }

        return view('lessonCreator', compact('msg'));

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
        }

        return view('courseCreator', compact('msg', 'courses'));

    }


    public function destroy(){

        auth()->logout();

        return redirect('/');
    }
}
