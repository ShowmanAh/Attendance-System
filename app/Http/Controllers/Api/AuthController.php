<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\CheckinResource;
use App\Http\Resources\CheckResource;
use App\Http\Resources\UserResource;
use App\User;
use App\Chekout;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $users = UserResource::collection(User::paginate(20));


        return $this->apiResponse($users);
    }
    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'name'=>'required|max:55',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed'
        ]);
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user'=> $user, 'access_token'=> $accessToken]);



    }
   public function sign(Request $request){
       $loginData = $request->validate([
           'email' => 'email|required',
           'password' => 'required',
       ]);
       if(!auth()->attempt($loginData)){
           return response(['message' => 'invalid credentials']);
       }
       $accessToken = auth()->user()->createToken('authToken')->accessToken;
       return response(['user' => auth()->user(), 'accessToken' => $accessToken]);

   }
   public function checkin(Request $request){
       $request->validate([
           'email' => 'required|string|email|max:255|exists:users',
           'pin_code' => 'required|integer',
       ]);

       if ($user = User::whereEmail(request('email'))->first()){

           if ( $user->pin_code === $request->pin_code) {

               if (!Attendance::whereCheckin_date(date("Y-m-d"))->whereUser_id($user->id)->first()){
                   $attendance = new Attendance;
                   $attendance->user_id = $user->id;
                   $attendance->checkin_time = date("H:i:s");
                   $attendance->checkin_date = date("Y-m-d");


                   $attendance->save();
               } else {
                   return $this->apiResponse(null,'you checkin before ',404);;
               }
           } else {
               return $this->notFoundResponse();
           }
       }

       return $this->apiResponse(new CheckinResource($attendance));


   }
   public function log(Request $request){
       $request->validate([
           'email' => 'required|string|email|max:255|exists:users',
           'pin_code' => 'required|integer',
       ]);
       if ($user = User::whereEmail(request('email'))->first()) {

           if ( $user->pin_code === $request->pin_code) {
               if (!Chekout::whereCheckout_date(date("Y-m-d"))->whereUser_id($user->id)->first()) {
                   $check = new Chekout;
                   $check->user_id = $user->id;
                   $check->checkout_time = date("H:i:s");
                   $check->checkout_date = date("Y-m-d");

                   $check->save();
               } else {
                   return $this->apiResponse(null,'you checkout before ',404);;
               }
           } else {
               return $this->notFoundResponse();
           }
       }

       return $this->apiResponse(new CheckResource($check));

   }
}
