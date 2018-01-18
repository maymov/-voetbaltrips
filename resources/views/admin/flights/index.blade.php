@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
flights List
@parent
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
    <h1>Flights</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>flights</li>
        <li class="active">flights</li>
    </ol>
</section>
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Flights List
                </h4>
                <div class="pull-right">
                    <button id="open_btn" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal">Upload CSV</button>
                </div>
                <div class="pull-right">
                    <a href="{{ route('admin.flights.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
                <div class="pull-right">
                    
                <a href="{{ route('admin.flights.confirm-empty')}}" class="btn btn-sm btn-default" data-toggle="modal" data-target="#empty_confirm"><span class="glyphicon glyphicon-trash"></span> @lang('button.empty')</a>
                 
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Flight Mode</th>
                            <th>Airline</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Departure Date</th>
                            <th>Departure Time</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($flights as $flight)
                        <tr>
                            <td>{!! $flight->id !!}</td>
                            <td>{!! (($flight->flightmode ==1)?'Outbound':"Return") !!}</td>
                            <td>{!! $flight->airline->name !!}</td>
                            <td>{!! $flight->source_airport->title !!}</td>
                            <td>{!! $flight->destination_airport->title !!}</td>
                            <td>{!! $flight->departure_date !!}</td>
                            <td>{!! $flight->departure_time !!}</td>
                            <td>{!! $flight->price !!}</td>
                            <td>
                                <a href="{{ route('admin.flights.show', $flight->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view flight"></i>
                                </a>
                                <a href="{{ route('admin.flights.edit', $flight->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit flight"></i>
                                </a>
                                <a href="{{ route('admin.flights.confirm-delete', $flight->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete flight"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {!! $flights->render() !!} 
            </div>
        </div>
    </div>    <!-- row-->
</section>

@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<div class="modal fade" id="empty_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<link rel="stylesheet" href="{{ asset('assets/css/fileinput.min.css') }}"></link>
<script src="{{ asset('assets/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/flightcsvupload.js') }}" type="text/javascript"></script>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Flight CSV</h4>
            </div>
            <div class="modal-body">
                <form name="formCsvUpload" id="formCsvUpload" enctype="multipart/form-data" novalidate>
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="control-label">Select File</label>
                        <input id="input-1a" type="file" name="csvfile" class="file" data-allowed-file-extensions='["csv"]' data-show-preview="false">
                    </div>

                    <label for="optradio">Flight Import Type : </label>
                    <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" checked name="flighttype" value="1">Outbound
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="flighttype" value="2">Inbound
                    </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closemodel">Close</button>
            </div>
        </div>

    </div>
</div>
@stop