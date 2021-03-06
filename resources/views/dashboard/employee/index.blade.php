@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Employees

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard/index') }}"><i class="fa fa-dashboard"></i>  </a></li>
                <li class="active">Employees</li>
            </ol>
        </section>

        <!-- Main content -->

        <!-- /.content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 20px"> <small>{{ $users->total() }}</small></h3>
                    <!-- search data -->
                    <form action="{{ route('dashboard.employee.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="input search" value="{{ request()->search }}" >

                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>
                                <!-- check  create user permission -->

                                @if (auth()->user()->hasPermission('create_users'))
                                <a href="{{ route('dashboard.employee.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add Employee</a>
                                @else
                                <a href="#" class="btn btn-primary"><i class="fa fa-plus disabled"></i>@lang('site.add')</a>
                                @endif


                            </div>
                        </div>
                    </form>


                </div><!-- end of box header -->
                <div class="box-body">
                    <!-- check user counts-->
                    @if($users->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Pincode</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index=>$user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->pin_code }}</td>
                                    <td>{{ $user->created_at }}</td>

                                    <td>
                                        <!-- check  update user permission -->
                                        @if (auth()->user()->hasPermission('update_users'))
                                            <a class="btn btn-info sm" href=" {{ route('dashboard.employee.edit', $user->id) }}" > <i class="fa fa-edit"></i>Edit</a>
                                        @else
                                            <a class="btn btn-info sm disabled" href=" #" >Edit</a>
                                        @endif
                                    <!-- check  delete user permission -->

                                        @if (auth()->user()->hasPermission('delete_users'))
                                            <form  action="{{ route('dashboard.employee.destroy',$user->id) }}" method="post" style="display: inline-block">
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

                        {{ $users->appends(request()->query())->links() }}

                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif
                </div><!-- end of box body -->
            </div><!-- end of box  -->

        </section>
    </div>


@endsection
