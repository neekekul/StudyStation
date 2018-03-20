<?php

namespace App\Http\Controllers\Auth;

use App\Instructor;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registration';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'type' => 'required|string|max:11',
            'username' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:users',
            'password' => 'required|string|min:6|max:100|confirmed',
            'passwordCheck' => 'required|string|min:6|max:100|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {
        return view('/registration');
    }

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

        //These are the two string possibilities for 'type'
        $stu = 'student';

        $ins = 'instructor';

        //count how many instances of the input email address is in the Students table
        $countStu = Student::where('email', $email)->count();

        //count how many instances of the input email address is in the Instructors table
        $countIns = Instructor::where('email', $email)->count();

        //hash the validated password
        $hashed = Hash::make($password);

        //if the user is creating a student account
        if($type == $stu){

            //guest is made using the Student model
            $guest = new Student;
            //Student model is appropriately populated with the values designed above
            $guest->username = $username;
            $guest->email = $email;
            $guest->password = $hashed;

            //if there are no accounts with the same email address
            if($countStu == 0){

                //if the model is successfully saved to the database
                if($guest->save()){
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
        }

        //otherwise if the user is creating a instructor account
        else if($type == $ins) {

            //guest is made using the Instructor model
            $guest = new Instructor;

            //Instructor model is appropriately populated with the values designed above
            $guest->username = $username;
            $guest->email = $email;
            $guest->password = $hashed;

            //if there are no accounts with the same email address
            if($countIns == 0){

                //if the model is successfully saved to the database
                if($guest->save()){
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
        }

        //return the same view, so the same registration page will show again.
        //Only this time it has the $msg sent through
        return view('/registration', compact('msg'));
    }
}
