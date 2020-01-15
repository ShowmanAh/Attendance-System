@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Employee_Hours

            </h1>
            <ol class="breadcrumb">

                <li class="active">Employee_Hours</li>
            </ol>
        </section>

        <!-- Main content -->

        <!-- /.content -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                       </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <th>ID</th>

                            <th>Name</th>
                            <th>Total_Hours</th>
                            <th>Month</th>
                            <th>Year</th>
                            </thead>
                            <tbody>
                            @foreach( $totalhours as $total)

                                <tr>

                                    <td>{{$total->user_id}}</td>
                                    <td>{{$total->user->name}}</td>
                                    <td>{{$total->total}}</td>
                                    <td>{{$total->month}} </td>
                                    <td>{{$total->year}}</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
