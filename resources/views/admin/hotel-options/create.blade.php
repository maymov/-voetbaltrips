@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New hotel-option
@parent
@stop
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet"  media="all" href="{{ asset('assets/css/star-rating.min.css')}}">
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Hotel-option</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>hotel-options</li>
        <li class="active">Create New hotel-option</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new hotel-option
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => 'admin/hotel-options']) !!}
                    <div class="form-group">
                         {!! Form::label($lang->code, 'Option Name : ') !!}
                         {!! Form::text('name', null, ["class"=>"form-control", "required"=>"required"]) !!}
                    </div>
                    @foreach ($languages as $lang)
                         <div class="form-group">
                             {!! Form::label($lang->code, 'Hotel Option Name '.$lang->code.': ') !!}
                             {!! Form::text($lang->code, null, ["class"=>"form-control", "required"=>"required"]) !!}
                         </div>
                    @endforeach
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.hotel-options.index') }}">
                                @lang('button.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
                                @lang('button.save')
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
    @section('footer_scripts')
        <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/star-rating.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/stadium.js')}}" type="text/javascript"></script>
    @stop
</section>
@stop