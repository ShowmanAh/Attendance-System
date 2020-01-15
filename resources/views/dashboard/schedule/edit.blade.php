@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.useers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard/index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.schedule.index') }}"> @lang('site.employee')</a></li>
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

                    <form action="{{ route('dashboard.schedule.update', $schedule->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>slug</label>
                            <input type="text" class="form-control timepicker" id="name" name="slug" value="{{ $schedule->slug }}">
                        </div>

                        <div class="form-group">
                            <label>Time in</label>
                            <input type="time" class="form-control timepicker" id="time_in" name="time_in" required value="{{ $schedule->time_in }}">
                        </div>


                        <div class="form-group">
                            <label>Time out</label>
                            <input type="time" class="form-control timepicker" id="time_in" name="time_out" required value="{{ $schedule->time_out }}">

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
