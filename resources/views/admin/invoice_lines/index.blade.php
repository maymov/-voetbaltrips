@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
invoice_lines List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Invoice_lines</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>invoice_lines</li>
        <li class="active">invoice_lines</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Invoice_lines List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.invoice_lines.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Invoice_id</th>
							<th>Product_id</th>
							<th>Product_title</th>
							<th>Product_amount</th>
							<th>Product_vat</th>
							<th>Product_price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoice_lines as $invoice_line)
                        <tr>
                            <td>{!! $invoice_line->id !!}</td>
                            <td>{!! $invoice_line->invoice_id !!}</td>
							<td>{!! $invoice_line->product_id !!}</td>
							<td>{!! $invoice_line->product_title !!}</td>
							<td>{!! $invoice_line->product_amount !!}</td>
							<td>{!! $invoice_line->product_vat !!}</td>
							<td>{!! $invoice_line->product_price !!}</td>
                            <td>
                                <a href="{{ route('admin.invoice_lines.show', $invoice_line->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view invoice_line"></i>
                                </a>
                                <a href="{{ route('admin.invoice_lines.edit', $invoice_line->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit invoice_line"></i>
                                </a>
                                <a href="{{ route('admin.invoice_lines.confirm-delete', $invoice_line->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete invoice_line"></i>
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
