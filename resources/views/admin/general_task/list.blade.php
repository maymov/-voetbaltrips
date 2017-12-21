@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    General tasks List
    @parent
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>General tasks</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>General tasks</li>
            <li class="active">General tasks</li>
        </ol>
    </section>

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        General tasks List
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Datetime</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($generalTasks as $generalTask)
                            <tr>
                                <td>{!! $generalTask->id !!}</td>
                                <td>{!! $generalTask->name !!}</td>
                                <td>{!! $generalTask->date_time !!}</td>
                                <td><a href="{{ route('admin.generalTask.setDate', $generalTask->id )}}" class="btn btn-primary">Done</a</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>    <!-- row-->
    </section>
@stop