@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
countries List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Countries</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>countries</li>
        <li class="active">countries</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Countries List
                </h4>
                <div class="pull-right">
                    <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#country_upload">Import Countries</button>
                    <a href="{{ route('admin.countries.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Code</th>
							<th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td>{!! $country->id !!}</td>
                            <td>{!! $country->code !!}</td>
							<td>{!! $country->name !!}</td>
                            <td>
                                <a href="{{ route('admin.countries.show', $country->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view country"></i>
                                </a>
                                <a href="{{ route('admin.countries.edit', $country->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit country"></i>
                                </a>
                                <a href="{{ route('admin.countries.confirm-delete', $country->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete country"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="pagination"> {!! $countries->render() !!} </div>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
    <link rel="stylesheet" href="{{ asset('assets/css/fileinput.min.css') }}"></link>
    <script src="{{ asset('assets/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/countriesupload.js') }}" type="text/javascript"></script>
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<div id="country_upload" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload country data</h4>
            </div>
            <div class="modal-body">
                <form name="formCsvUpload" id="formCsvUpload" enctype="multipart/form-data" novalidate>
                    {!! csrf_field() !!}
                    <label class="control-label">Select File</label>
                    <input id="input-1a" type="file" name="csvfile" class="file" data-allowed-file-extensions='["csv"]' data-show-preview="false">
                </form>
                <br>
                <p class="alert-info" style="padding: 10px;text-align: center;">
                    CSV Format should be code and name
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closemodel">Close</button>
            </div>
        </div>


    </div>
</div>
@stop
