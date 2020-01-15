@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Schedules

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard/index') }}"><i class="fa fa-dashboard"></i>  </a></li>
                <li class="active">Schedules</li>
            </ol>
        </section>

        <!-- Main content -->

        <!-- /.content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 20px"> <small>{{ $schedules->total() }}</small></h3>
                    <!-- search data -->
                    <form action="{{ route('dashboard.employee.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                    <!-- check  create user permission -->

                                @if (auth()->user()->hasPermission('create_schedules'))
                                    <a href="{{ route('dashboard.schedule.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add Schedule</a>
                                @else
                                    <a href="#" class="btn btn-primary"><i class="fa fa-plus disabled"></i>Add Schedule</a>
                                @endif


                            </div>
                        </div>
                    </form>


                </div><!-- end of box header -->
                <div class="box-body">
                    <!-- check user counts-->
                    @if($schedules->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>

                                <th>Slug</th>
                                <th>Time on</th>
                                <th>Time Out</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $index=>$schedule)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>{{ $schedule->slug }}</td>
                                    <td>{{ $schedule->time_in }}</td>
                                    <td>{{ $schedule->time_out }}</td>

                                    <td>
                                        <!-- check  update user permission -->
                                        @if (auth()->user()->hasPermission('update_schedules'))
                                            <a class="btn btn-info sm" href=" {{ route('dashboard.schedule.edit', $schedule->id) }}" > <i class="fa fa-edit"></i>Edit</a>
                                        @else
                                            <a class="btn btn-info sm disabled" href=" #" >Edit</a>
                                        @endif
                                    <!-- check  delete user permission -->

                                        @if (auth()->user()->hasPermission('delete_schedules'))
                                            <form  action="{{ route('dashboard.schedule.destroy',$schedule->id) }}" method="post" style="display: inline-block">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i>Delete</button>

                                            </form><!-- end form -->
                                        @else
                                            <button type="submit" class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>Delete</button>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                            </tbody><!-- end tbody -->

                        </table><!-- end of table -->
                        <!--pagination link -->
                        <!--appends prevent guery search deleted from url -->

                        {{ $schedules->appends(request()->query())->links() }}

                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif
                </div><!-- end of box body -->
            </div><!-- end of box  -->

        </section>
    </div>


@endsection
