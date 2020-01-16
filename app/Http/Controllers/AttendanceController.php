<?php

namespace App\Http\Controllers;
use App\Hour;
use DateTime;
use Illuminate\Support\Carbon;
use App\Attendance;
use App\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
   public function index(){
       $attendances = Attendance::paginate(20);
       return view('dashboard.attendance.index', compact('attendances'));
   }
   public function totalhour(){

       $totalhours = Hour::all();

       //dd($hours);
       return view('dashboard.attendance.emp_hours', compact('totalhours'));

   }
   public function sign(Request $request){
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

               }else{
                   return redirect()->route('sign')->with('error', 'You are checkin before');
               }
           } else {
               return redirect()->route('sign')->with('error', 'Check Pincode incorrect');
           }
       }



       return redirect()->route('home')->with('success', 'Successful in assign the attendance');
   }



}
