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

        $username = request('username');

        $email = request('email');

        $password = request('password');

        $passCheck = request('passwordCheck');

        $type = request('type');

        $stu = 'student';

        $ins = 'instructor';

        $countStu = Student::where('email', $email)->count();

        $countIns = Instructor::where('email', $email)->count();

        if($password == $passCheck && strlen($password) <= 100){
            $hashed = Hash::make($password);

                if($type == $stu){
                    $guest = new Student;
                    $guest->username = $username;
                    $guest->email = $email;
                    $guest->password = $hashed;

                    if($countStu == 0 && strlen($email)<=60 && strlen($username)<=60 && strlen($type)<=11){
                        $guest->save();
                        $msg = "<div class='alert'>Successfully Registered!</div>";
                    }
                    else{
                        $msg = "<div class='alert'>ERROR Registering</div>";
                    }
                }
                else if($type == $ins) {
                    $guest = new Instructor;
                    $guest->username = $username;
                    $guest->email = $email;
                    $guest->password = $hashed;

                    if($countIns == 0 && strlen($email)<=60 && strlen($username)<=60 && strlen($type)<=11){
                        $guest->save();
                        $msg = "<div class='alert'>Successfully Registered!</div>";
                    }
                    else{
                        $msg = "<div class='alert'>ERROR Registering</div>";
                    }
                }
        }
        else{
            $msg = "<div class='alert'>The passwords you entered do not match!</div>";
        }

        return view('/registration');
    }
}
