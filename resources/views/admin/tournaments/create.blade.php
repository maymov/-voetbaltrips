@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New tournament
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Tournaments</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>tournaments</li>
        <li class="active">Create New tournament</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new tournament
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

                    {!! Form::open(['url' => 'admin/tournaments']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', "required" => "required"]) !!}
                    </div>
                    @foreach ($languages as $lang)
                        <div class="form-group">
                            {!! Form::label($lang->code, 'Story '.$lang->code.' : ') !!}
                            {!! Form::textarea($lang->code, null, ['class' => 'form-control', "required" => "required"]) !!}
                        </div>
                     @endforeach
                     <div class="form-group">
                         {!! Form::label('start_date', 'Start Date: ') !!}
                         <div class="controls input-append date form_start_date" data-date=""  data-date-format="dd MM yyyy" data-link-field="start_date">
                             <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select a Date" required="required">
                             <span class="add-on"><i class="icon-remove"></i></span>
                             <span class="add-on"><i class="icon-th"></i></span>
                         </div>
                         <input type="hidden" id="start_date" name="start_date" value="" />
                     </div>
                     <div class="form-group">
                         {!! Form::label('end_date', 'End Date: ') !!}
                         <div class="controls input-append date form_end_date" data-date=""  data-date-format="dd MM yyyy" data-link-field="end_date">
                             <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select a Date" required="required">
                             <span class="add-on"><i class="icon-remove"></i></span>
                             <span class="add-on"><i class="icon-th"></i></span>
                         </div>
                         <input type="hidden" id="end_date" name="end_date" value="" />
                     </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.tournaments.index') }}">
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
        <script type="text/javascript" src="{{ asset('assets/js/pages/tournaments.js')}}"></script>
    @stop
</section>

@stop