@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Coupon
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/select2/select2-bootstrap.min.css') }}"/>
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Edit Coupon</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Coupons</li>
            <li class="active">Edit Coupon</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-gift" data-name="coupon-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Edit Coupon
                        </h3>
                        <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">

                        <!-- errors -->
                        <div class="has-error">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!--main content-->
                        <div class="col-md-12">

                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('admin.discount.update', $coupon->id) }}" method="POST">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_method" value="PUT"/>

                                <div class="form-group">
                                    <label for="code" class="col-sm-2 control-label">Code *</label>
                                    <div class="col-sm-10">
                                        <input name="code" type="text" placeholder="Code" class="form-control required" value="{!! Input::old('code') ?? $coupon->code !!}" disabled/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="value" class="col-sm-2 control-label">Value *</label>
                                    <div class="col-sm-10">
                                        <input name="value" type="number" step="0.01" placeholder="Discount value" class="form-control required" value="{!! Input::old('value') ?? $coupon->value !!}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <input type="submit" value="Update Coupon" class="btn btn-primary" />
                                    </div>
                                </div>

                            </form>
                            <!-- END FORM WIZARD WITH VALIDATION -->
                        </div>
                        <!--main content end-->
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"></script>
@stop