@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
matches List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Matches</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>matches</li>
        <li class="active">matches</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Matches List
                </h4>
                <div class="pull-right">
                    <button id="open_btn" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal">Upload CSV</button>
                </div>
                <div class="pull-right">
                    <a href="{{ route('admin.matches.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
							<th>Tournament</th>
							<th>Stadium</th>
							<th>Home_club</th>
							<th>Away_club</th>
							<th>Match_date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($matches as $match)
                        <tr>
                            <td>{!! $match->id !!}</td>
							<td>{!! $match->getTournament->name !!}</td>
							<td>{!! $match->getStadium->stadium !!}</td>
							<td>{!! $match->getHomeClub->name !!}</td>
							<td>{!! $match->getAwayClub->name !!}</td>
							<td>{!! $match->match_date !!}</td>
                            <td>
                                <a href="{{ route('admin.matches.show', $match->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view match"></i>
                                </a>
                                <a href="{{ route('admin.matches.edit', $match->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit match"></i>
                                </a>
                                <a href="{{ route('admin.matches.confirm-delete', $match->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete match"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
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
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Matches CSV</h4>
            </div>
            <div class="modal-body">
                <form name="formCsvUpload" id="formCsvUpload" enctype="multipart/form-data" novalidate>
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="control-label">Select File</label>
                        <input id="input-1a" type="file" name="csvfile" class="file" data-allowed-file-extensions='["csv"]' data-show-preview="false">
                    </div>

                </form>
                <div class="alert alert-info" role="alert">
                    <i class="glyphicon glyphicon-exclamation-sign"></i> &nbsp;Tournament should be already saved.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closemodel">Close</button>
            </div>
        </div>

    </div>
</div>
<link rel="stylesheet" href="{{ asset('assets/css/fileinput.min.css') }}"></link>
<script src="{{ asset('assets/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/matchcsvupload.js') }}" type="text/javascript"></script>
@stop