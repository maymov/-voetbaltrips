@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
client
@parent
@stop

@section('header_styles')

@stop

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

        <div class="col-md-6">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="livicon" data-name="list-ul" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        client {{ $client->id }}'s details
                    </h4>
                </div>
                <br/>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td><strong>ID</strong></td>
                            <td>{{ $client->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Company</strong></td>
                            <td>{{ $client['company_id'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Client_nr</strong></td>
                            <td>{{ $client['client_nr'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>{{ $client['name'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $client['email'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Phone</strong></td>
                            <td>{{ $client['phone'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Mobile</strong></td>
                            <td>{{ $client['mobile'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">
                        &nbsp;
                        {{--<i class="livicon" data-name="list-ul" data-size="16" data-loop="true"--}}
                                               {{--data-c="#fff" data-hc="white"></i>--}}
                        {{--client {{ $client->id }}'s details--}}
                    </h4>
                </div>
                <br/>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td><strong>Address line 1</strong></td>
                            <td>{{ $client['address_1'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Address line 2</strong></td>
                            <td>{{ $client['address_2'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td>{{ $client['city'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>State</strong></td>
                            <td>{{ $client['state'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Postal code</strong></td>
                            <td>{{ $client['postal_code'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Country</strong></td>
                            <td>{{ $client['country'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Website</strong></td>
                            <td>{{ $client['website'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Notes</strong></td>
                            <td>{{ $client['notes'] }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">
                        Invoices
                        {{--<i class="livicon" data-name="list-ul" data-size="16" data-loop="true"--}}
                        {{--data-c="#fff" data-hc="white"></i>--}}
                        {{--client {{ $client->id }}'s details--}}
                    </h4>
                </div>
                <br/>
                <div class="panel-body">

                    <table id="invoices_table" class="mydatatable table">

                        <thead>
                        <tr>
                            <th>Invoice nr.</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td><strong>1</strong></td>
                            <td>&euro;100</td>
                            <td><span class="label label-success">Paid </span></td>
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
                        <tr>
                            <td><strong>2</strong></td>
                            <td>&euro;150</td>
                            <td><span class="label label-success">Paid </span></td>
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
                        <tr>
                            <td><strong>3</strong></td>
                            <td>&euro;200</td>
                            <td><span class="label label-warning">Unpaid </span></td>
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
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">
                        Estimates
                        {{--<i class="livicon" data-name="list-ul" data-size="16" data-loop="true"--}}
                        {{--data-c="#fff" data-hc="white"></i>--}}
                        {{--client {{ $client->id }}'s details--}}
                    </h4>
                </div>
                <br/>
                <div class="panel-body">

                    <table id="estimates_table" class="mydatatable table">

                        <thead>
                        <tr>
                            <th>Estimate nr.</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td><strong>1</strong></td>
                            <td>&euro;100</td>
                            <td><span class="label label-warning">Draft </span></td>
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
                        <tr>
                            <td><strong>2</strong></td>
                            <td>&euro;150</td>
                            <td><span class="label label-success">Send </span></td>
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
                        <tr>
                            <td><strong>3</strong></td>
                            <td>&euro;200</td>
                            <td><span class="label label-warning">Draft </span></td>
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
                        </tbody>

                    </table>

                </div>
            </div>
        </div>


    </div>
    </div>

</section>
@stop

@section('footer_scripts')
    {{--<script type="text/javascript" src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('assets/vendors/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/pages/table-editable.js') }}" ></script>--}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.mydatatable').DataTable({
            stateSave: true,
            "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
        });
    } );
</script>
@stop