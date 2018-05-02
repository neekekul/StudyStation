<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    protected $redirectTo = 'instructorHome';
    /**
     * Create a new controller instance.
     * All functions must be authenticated in this controller by the 'auth' middleware. Except logout of course.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('destroy');
    }

    /**
     * Show the application's Login view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return view('Login')
     *
     */
    protected function onInstructorCreate(){
        //create the instructor login view
        //display it route it, whatever you wanna call it
        return view('Login');
    }

    /**
     * Handles authenticating a users final request for login permission in the Login view.
     * Passing relevant data through the compact() to the view itself in the form of php variables.
     *
     * @return redirect('/home')
     * @return back()->withErrors(['message' => 'username or password is incorrect!']);
     *
     */
    public function instructorSession(){
        //completely validate the input or request
        $this->validate(request(), [
            'email' => 'required|email|string|max:60',
            'password' => 'required|string|alpha_num|min:6|max:100',
        ]);


            if (auth()->attempt(['email' => request('email'), 'password' => request('password')])){

                return redirect('/home');
            }
            else{

                return back()->withErrors([
                'message' => 'username or password is incorrect!'
            ]);

            }


    }

    public function destroy(){

        auth()->logout();

        return redirect('/');
    }

}
