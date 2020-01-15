@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.useers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard/index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.employee.index') }}"> @lang('site.employee')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">
                    <!-- check all field filled -->
                    @include('partials._errors')

                    <form action="{{ route('dashboard.employee.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>


                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>PinCode </label>
                            <input type="text" name="pin_code" class="form-control"  maxlength="4" placeholder="4 Digits" id="pincode">
                        </div>
                        <div class="form-group">
                            <label for="schedule" class="col-sm-3 control-label">Schedule</label>

                            <div class="form-group">
                                <select class="form-control" id="schedule" name="schedule" required>
                                    <option value="" selected>- Select -</option>
                                    @foreach($schedules as $schedule)
                                        <option value="{{$schedule->slug}}">{{$schedule->slug}} -> from {{$schedule->time_in}} to {{$schedule->time_out}} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Edit</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
