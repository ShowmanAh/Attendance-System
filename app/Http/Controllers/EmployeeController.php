<?php

namespace App\Http\Controllers;
use DateTime;
use App\Schedule;
use App\User;
use App\Attendance;
use App\Chekout;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {

        $schedules = Schedule::all();
        $users = User::when($request->search,function($q) use ($request){
            return $q->where('name','like','%' . $request->search . '%')
                ->orwhere('pin_code', 'like', '%' . $request->search . '%')
                ->orwhere('id', 'like', '%' . $request->search . '%')
                ->orwhere('email', 'like', '%' . $request->search . '%');
        })->latest()->paginate(20);



        //$users = User::paginate(20);
       return view('dashboard.employee.index', compact('schedules','users'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedules = Schedule::all();
        return view('dashboard.employee.create',compact('schedules'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'pin_code' => 'required|integer|unique:users',
            'schedule' => 'required',

        ]);
        $request_data = $request->except(['password','password_confirmation']);
        $request_data['password'] = bcrypt($request->password);
        $user = User::create($request_data);
        if($request->schedule){

            $schedule = Schedule::whereSlug($request->schedule)->first();

            $user->schedules()->attach($schedule);
        }

        session()->flash('success', 'Employee Addedd Successfully');
        return redirect()->route('dashboard.employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedules = Schedule::all();
        $user = User::find($id);
        return view('dashboard.employee.edit', compact('schedules','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'schedule' => 'required',

        ]);

        $user = User::find($id);
        $user->update($request->all());
        if($request->schedule){
            $user->schedules()->detach();
            $schedule = Schedule::whereSlug($request->schedule)->first();

            $user->schedules()->attach($schedule);
        }

        session()->flash('success', 'Employee Edited Successfully');
        return redirect()->route('dashboard.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user = User::find($id);
       $user->delete();
        session()->flash('success', 'Employee Deleted Successfully');
        return redirect()->route('dashboard.employee.index');

    }

}
