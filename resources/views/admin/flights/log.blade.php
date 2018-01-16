@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Flight CSV Log
    @parent
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Flight CSV Log</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>flights</li>
            <li class="active">log</li>
        </ol>
    </section>

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Log List
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Success Entry</th>
                            <th>Failed Entry</th>
                            <th>Message</th>
                            <th>Date and Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($log as $value)
                            <tr>
                                <td>{!! $value->id !!}</td>
                                <td>{!! $value->success_entry !!}</td>
                                <td>{!! $value->fail_entry !!}</td>
                                <td>{!! $value->message !!}</td>
                                <td>{!! $value->created_at !!}</td>
                            </tr>
                        @endforeach
                        @if($log->count() == 0)
                        <tr>
                            <td colspan="5" align="center"><p>There is no csv upload done.</p></td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    {!! $log->render() !!}
                </div>
            </div>
        </div>    <!-- row-->
    </section>

@stop
