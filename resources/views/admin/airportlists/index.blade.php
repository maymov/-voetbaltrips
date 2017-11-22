@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
airportlists List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Airportlists</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Airports</li>
        <li class="active">Airports</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Airports List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.airportlists.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Country</th>
							<th>City</th>
							<th>Title</th>
							<th>Airport Code</th>
                            <th>Show in Flight Search</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($airportlists as $airportlist)
                        <tr>
                            <td>{!! $airportlist->id !!}</td>
                            <td>{!! $airportlist->getCountry->name !!}</td>
							<td>{!! $airportlist->getCity->name !!}</td>
							<td>{!! $airportlist->title !!}</td>
							<td>{!! $airportlist->iata_code !!}</td>
                            <td>{!! (($airportlist->showinsearch == "1")? "Yes": "No") !!}</td>
                            <td>
                                <a href="{{ route('admin.airportlists.show', $airportlist->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view airportlist"></i>
                                </a>
                                <a href="{{ route('admin.airportlists.edit', $airportlist->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit airportlist"></i>
                                </a>
                                <a href="{{ route('admin.airportlists.confirm-delete', $airportlist->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete airportlist"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="pagination"> {!! $airportlists->render() !!} </div>
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
@stop
