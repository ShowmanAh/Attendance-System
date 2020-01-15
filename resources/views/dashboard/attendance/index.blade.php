@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Attendances

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard/index') }}"><i class="fa fa-dashboard"></i>  </a></li>
                <li class="active">Attendances</li>
            </ol>
        </section>

        <!-- Main content -->

        <!-- /.content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 20px"> <small>{{ $attendances->total() }}</small></h3>
                    <!-- search data -->
                    <form action="{{ route('dashboard.employee.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="input search" value="{{ request()->search }}" >

                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>
                                <!-- check  create user permission -->

                            </div>
                        </div>
                    </form>


                </div><!-- end of box header -->
                <div class="box-body">
                    <!-- check user counts-->
                    @if($attendances->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Attendance_time</th>
                                <th>Time In</th>
                                <th>Time Out</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendances as $index=>$attendance)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$attendance->checkin_date}}</td>
                                    <td>{{$attendance->user_id}}</td>
                                    <td>{{$attendance->user->name}}</td>
                                    <td>{{$attendance->checkin_time}}

                                    </td>
                                    <td>{{$attendance->user->schedules->first()->time_in}} </td>
                                    <td>{{$attendance->user->schedules->first()->time_out}}</td>




                                </tr>
                            @endforeach
                            </tbody><!-- end tbody -->

                        </table><!-- end of table -->
                        <!--pagination link -->
                        <!--appends prevent guery search deleted from url -->

                        {{ $attendances->appends(request()->query())->links() }}

                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif
                </div><!-- end of box body -->
            </div><!-- end of box  -->

        </section>
    </div>


@endsection
