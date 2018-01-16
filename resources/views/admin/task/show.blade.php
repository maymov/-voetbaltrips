@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Tasks
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Tasks</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Tasks</li>
        <li class="active">Tasks</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Task {{ $task->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body" style="align-content: center">
                <table class="table">
                    <tr><td>Id</td><td>{{ $task->id }}</td></tr>
                     <tr><td>Name</td><td>{{ $task->task_name }}</td></tr>
                     <tr><td>Description</td><td>{{ $task->task_description }}</td></tr>
					<tr><td>Deadline</td><td>{{ $task->task_deadline }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop