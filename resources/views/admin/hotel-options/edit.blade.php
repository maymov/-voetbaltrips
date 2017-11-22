@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit the hotel-option
@parent
@stop

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" media="all" href="{{ asset('assets/css/star-rating.min.css')}}">
@stop
@section('content')
<section class="content-header">
    <h1>Hotel-options</h1>
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
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit hotel-option
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

                    {!! Form::model($option, ['method' => 'PATCH', 'action' => ['HotelOptionsController@update', $option->id]]) !!}

                    <div class="form-group">
                         {!! Form::label('name', 'Hotel Option Name: ') !!}
                         {!! Form::text('name', $option->name , ["class"=>"form-control","required"=>"required"]) !!}
                    </div>

                    @foreach($languages as $lang)
                        <?php $l = ''; ?>
                         <div class="form-group">
                            {!! Form::label($lang->code, 'Translate Option Name '.$lang->code.': ') !!}
                            @foreach ($option->getTranslate as $trans)
                                @if ($trans->lang_code == $lang->code)
                                    <?php $l = $trans->trans_name; ?>
                                @endif
                            @endforeach
                            {!! Form::text($lang->code, $l , ["class"=>"form-control","required"=>"required"]) !!}
                         </div>
                    @endforeach

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    @section('footer_scripts')
        <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
    @stop
</section>
@stop