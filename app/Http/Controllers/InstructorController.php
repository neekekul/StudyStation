<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lesson;
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
        return view('lessonCreator');
    }

    public function lessonShow(){

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

        $lesson = new Lesson;
        $lesson->instructor_id = auth()->user()->id;
        $lesson->title = $title;
        $lesson->body = $body;
        $lesson->summary = $note;
        $lesson->save();

        return view('instructorHome');

    }


    public function destroy(){

        auth()->logout();

        return redirect('/');
    }
}
