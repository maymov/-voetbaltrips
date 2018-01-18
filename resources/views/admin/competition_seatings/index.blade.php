@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Tickets List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Tickets</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>tickets</li>
        <li class="active">Tickets</li>
    </ol>
</section>



<section class="content paddingleft_right15">

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <span class="">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        &nbsp;
                    </span>
                    <span class="">
                            Here you can see the tickets that are available for purchase.
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Tickets List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.competition_seatings.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
                <!-- <div class="pull-right">
                    <a href="" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span> @lang('button.empty')</a>
                </div> -->

            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Match Date</th>
                            <th>Match</th>
							<th>Seating Category</th>
							<th>Price</th>
							<th>Quantity Available</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($competition_seatings as $competition_seating)
                        <tr>
                            <td>{!! $competition_seating->id !!}</td>
                            <td>{!! $competition_seating->getMatch->match_date !!} </td>
							<td>{!! $competition_seating->getMatch->getHomeClub->name !!} - {!! $competition_seating->getMatch->getAwayClub->name !!}</td>
                            <td>{!! $competition_seating->seatingCategory->name !!}</td>
							<td>{!! $competition_seating->price !!}</td>
							<td>{!! $competition_seating->quantity_available !!}</td>
                            <td>
                                <a href="{{ route('admin.competition_seatings.show', $competition_seating->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view competition_seating"></i>
                                </a>
                                <a href="{{ route('admin.competition_seatings.edit', $competition_seating->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit competition_seating"></i>
                                </a>
                                <a href="{{ route('admin.competition_seatings.confirm-delete', $competition_seating->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete competition_seating"></i>
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
@stop
