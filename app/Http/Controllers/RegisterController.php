<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     * All functions must be authenticated in this controller by the 'auth' middleware. Except logout of course.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application's registration view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('registration')
     *
     */
    protected function create()
    {
        return view('registration');
    }

    /**
     * Handles registering the users input into the database as a new user!
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('/registration', compact('msg'))
     *
     */
    public function store(){

        //first completely validate the users input
        $this->validate(request(), [

            'type' => 'required|string|alpha|max:11',
            'username' => 'required|string|alpha_num|max:60',
            'email' => 'required|email|string|max:60',
            'password' => 'required|string|alpha_num|min:6|max:100|confirmed',
            'password_confirmation' => 'required|string|alpha_num|min:6|max:100',
        ]);

        //pull all validated inputs into variables
        $username = request('username');

        $email = request('email');

        $password = request('password');

        $passCheck = request('password_confirmation');

        $type = request('type');


        //count instances of said email address
        $count = User::where('email', $email)->count();

        //hash the validated password
        $hashed = Hash::make($password);

            //if there are no accounts with the same email address
            if($count == 0){

                    $usr = new User;
                    $usr->type = $type;
                    $usr->username = $username;
                    $usr->email = $email;
                    $usr->password = $hashed;

                //if the model is successfully saved to the database
                if($usr->save()){
                    //set a success message
                    $msg = "Successfully Registered!";
                }
                else{
                    //set a failure message
                    $msg = "ERROR Registering...";
                }

            }else{
                //set a failure message
                $msg = "The account that you are registering already exists.";
            }


        //return the same view, so the same registration page will show again.
        //Only this time it has the $msg sent through
        return view('/registration', compact('msg'));
    }
}
