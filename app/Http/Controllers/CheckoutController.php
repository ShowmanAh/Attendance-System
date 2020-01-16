<?php

namespace App\Http\Controllers;
use App\Attendance;
use App\Hour;
use DateTime;
use Illuminate\Support\Carbon;
use App\Chekout;
use App\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
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
                    CheckoutController::total($user, $check);
                    $check->save();
                } else {
                    return redirect()->route('log')->with('error', 'You are checkout before');
                }
            } else {
                return redirect()->route('log')->with('error', 'Check Pincode incorrect');
            }
        }



        return redirect()->route('home')->with('success', 'Successful in assign the leave');
    }

    public static function total(User $user, Chekout $last_chekout)
    {

        $last_checkin = Attendance::where('user_id', $user->id)->latest()->get()[0];
        //$last_checkin = User::find($user->id)->attendance()->latest();
        $end = Carbon::parse( $last_checkin->checkin_time);
        $start = Carbon::parse($last_chekout->checkout_time);
       // dd($end."".$start);
        $length = $end->diffinhours($start);
        //dd($length);
        $month=date('m',strtotime(($last_checkin->checkin_date)));
        $year=date('Y',strtotime(($last_checkin->checkin_date)));
        $month_hours=Hour::where('user_id',$user->id)->where('month',$month)->where('year',$year)->get();
        if($month_hours->count()==0){
            $hour = new Hour;
            $hour->month = $month;
            $hour->year=$year;
            $hour->user_id=$user->id;
            $hour->total = $length;
            $hour->save();
        }else{
            $hour = Hour::find($month_hours[0]->id);
            $hour->total = $hour->total + $length;
            $hour->save();
        }

    }

}
