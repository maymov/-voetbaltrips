@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Coupons List
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/extensions/bootstrap/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Discount</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Discount</li>
        <li class="active">Discount</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="glyphicon glyphicon-gift" data-name="discount" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Coupons List
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($coupons as $coupon)
                    	<tr>
                            <td>{!! $coupon->id !!}</td>
                    		<td>{!! $coupon->code !!}</td>
            				<td>{!! $coupon->value !!}</td>
            				<td>
            					@if($coupon->is_used)
            						Used
            					@else
            						Not Used
            					@endif
            				</td>
            				<td>{!! $coupon->created_at !!}</td>
            				<td>
                                <a href="{{ route('admin.discount.edit', $coupon->id) }}"><i class="livicon" data-name="edit"
                                                                                        data-size="18" data-loop="true"
                                                                                        data-c="#428BCA"
                                                                                        data-hc="#428BCA"
                                                                                        title="update coupon"></i></a>

                                <a class="jquery-coupon-delete" href="{{ route('admin.discount.destroy', $coupon->id) }}" data-method="delete"><i class="livicon" data-name="coupon-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete coupon"></i></a>
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

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/extensions/bootstrap/dataTables.bootstrap.js') }}"></script>

<script>
$(document).ready(function() {
	$('#table').DataTable();
});
</script>

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content"></div>
  </div>
</div>
<script>
$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
});
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', 'a.jquery-coupon-delete', function(e) {
        e.preventDefault(); // does not go through with the link.

        var t = $(this).attr("href");

        $.ajax({
            url: t,
            type: 'DELETE',
            success: function() {
                location.reload();
            }
        });
    });
</script>
@stop