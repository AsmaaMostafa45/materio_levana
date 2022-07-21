<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use Validator;
use DB;
use Date;
use Redirect;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// use DB;


class LoginController extends Controller
{
     // insert data to database fnc start 
     public function register(Request $request)
     {
         $name = $request->input('username');
         $email = $request->input('email');
         $password = $request->input('password');
         

             $data = array(
                 "name" => $name,
                 "email" => $email,
                 "password" => $password,
                 
             );

         DB::table('users')
         ->insert($data);
         
         return [
                 'username'=>$name,
                 'email'=>$email,
                 'password'=>$password,
                ];
     }
    // insert data to database fnc end 

    // fetch data from database start
    public function Login(Request $request)
    {
                    // $credentials = $request->only( 'email', 'password'); 
                    // var_dump($credentials);
                    // if(Auth::attempt($credentials)){
                    //     return response(Auth::user(), status:200);
                        
                    // }
                    // abort(code : 401);

                    if(Auth::attempt(array('email' => $request->email, 'password' => $request->password))){
                        return response()
                            ->json([
                                'authenticated' => true
                            ]);
                    }
    }

    public function Logout() 
    {
        Auth::logout();
                    
        return response(content: null, status:200);
                   
    }

// fetch data from database end


    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return response()->json([], 200);
    //     }
    //     return response()->json([
    //         'msg' => 'The provided credentials do not match our records.',
    //     ], 412);
    // }
    // public function register(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'name' => ['required'],
    //         'email' => ['required', 'email'],
    //         'password' => ['required','confirmed','min:8']
    //     ]);
    //     User::create([
    //         'email' => $credentials['email'],
    //         'password' => Hash::make($credentials['password']),
    //         'name' => $credentials['name']
    //     ]);
    //     return response()->json([
    //         'msg' => 'Successfully registered',
    //     ], 200);
    // }

// start axios login in controller

//     public function login(Request $request, User $user)
// {
    
//  $email = $request->input('email');
//  $password = $request->input('password');

//  $user = User::where('email', '=', $email)->first();
//  if (!$user || !Hash::check($password, $user->password)) {
//     // never tell the person if it's email or password, always say it's one of both for security reasons
//     return response(401)->json(['message' => 'Login Fail, please check email or password']);
//  }

//   return response()->json(['data' => $user]);
// }
// end axios login in controller


// public function index(){
//     // echo"hello from login controller index function";
//     // return DB::select("select * from migrations" );
//     echo"email";
// }

// public function login(LoginRequest $request)
//     {
//         $credentials = $request->getCredentials();

//         if(!Auth::validate($credentials)):
//             return redirect()->to('login')
//                 ->withErrors(trans('auth.failed'));
//         endif;

//         $user = Auth::getProvider()->retrieveByCredentials($credentials);

//         Auth::login($user);

//         return $this->authenticated($request, $user);
//     }

            // function checkuser(Request $request){
            //     $request->validate(
            //     array(
            //     "email" => 'required|email',
            //     "password" => "required"
            //     ));
            
            // $data = new User;
            // $user = $data->where(array("email" => $request->email,"password" => $request->password))->get();
            // if(!empty($user[0]['email'])){
            //     session()->put('loged_in', $user[0]['email']);
            //     return response()->json(['success' => 'successfully login'], 200);
            // }else{
            //     return response()->json(['fail' => 'Wrong Email Or Password'], 422);
            // }
            // }

}