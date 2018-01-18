@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
clients List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Clients</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>clients</li>
        <li class="active">clients</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Clients List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.clients.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="mydatatable table table-bordered " id="table">
                    <thead>
                        <tr class="filters">

							<th>Client_nr</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Mobile</th>
							<th>City</th>
							<th>Country</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
							<td>{!! $client->client_nr !!}</td>
							<td>{!! $client->name !!}</td>
							<td>{!! $client->email !!}</td>
							<td>{!! $client->phone !!}</td>
							<td>{!! $client->mobile !!}</td>
							<td>{!! $client->city !!}</td>
							<td>{!! $client->country !!}</td>
                            <td>
                                <a href="{{ route('admin.clients.show', $client->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view client"></i>
                                </a>
                                <a href="{{ route('admin.clients.edit', $client->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit client"></i>
                                </a>
                                <a href="{{ route('admin.clients.confirm-delete', $client->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete client"></i>
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


<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.mydatatable').DataTable({
            stateSave: true,
            "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
        });
    } );
</script>

@stop
