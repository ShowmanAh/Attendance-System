<?php

namespace App\Http\Controllers;

use App\Schedule;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::paginate(20);
        return view('dashboard.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.schedule.create');
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
            'slug' => 'required',
            'time_in' => 'required|date_format:H:i',
            'time_out' => 'required|date_format:H:i'

        ]);
        $schedule = Schedule::create($request->all());
        session()->flash('success', 'Schedule Added Successfully');
        return redirect()->route('dashboard.schedule.index');
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
       $schedule = Schedule::find($id);
       return view('dashboard.schedule.edit', compact('schedule'));
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
            'slug' => 'required',
            'time_in' => 'required|date_format:H:i',
            'time_out' => 'required|date_format:H:i'

        ]);
        $schedule = Schedule::find($id);
        $schedule->update($request->all());
        session()->flash('success', 'Schedule Edited Successfully');
        return redirect()->route('dashboard.schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $schedule = Schedule::find($id);
       $schedule->delete();
        session()->flash('success', 'Schedule Deleted Successfully');
        return redirect()->route('dashboard.schedule.index');
    }
}
