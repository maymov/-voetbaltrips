@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a tournament
@parent
@stop


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
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit tournament
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

                    {!! Form::model($tournament, ['method' => 'PATCH', 'action' => ['TournamentsController@update', $tournament->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
                    </div>
                    <?php $l = ''; ?>
                    @foreach ($languages as $lang)
                         <div class="form-group">
                             {!! Form::label($lang->code, 'Story '.$lang->code.' : ') !!}
                             @foreach ($tournament->getTranslate as $trans)
                                 @if ($trans->lang_code == $lang->code)
                                    <?php $l = $trans->story ;?>
                                 @endif
                             @endforeach
                             {!! Form::textarea($lang->code, $l, ['class' => 'form-control', 'required'=>'required']) !!}
                         </div>
                    @endforeach

                         <div class="form-group">
                             {!! Form::label('start_date', 'Start Date: ') !!}
                             <div class="controls input-append date form_start_date" data-date=""  data-date-format="dd MM yyyy" data-link-field="start_date">
                                 <input size="16" type="text" value="{{ $tournament->start_date }}" readonly class="form-control" placeholder="Please select a Date" required="required">
                                 <span class="add-on"><i class="icon-remove"></i></span>
                                 <span class="add-on"><i class="icon-th"></i></span>
                             </div>
                             <input type="hidden" id="start_date" name="start_date" value="{{ $tournament->start_date }}" />
                         </div>
                         <div class="form-group">
                             {!! Form::label('end_date', 'End Date: ') !!}
                             <div class="controls input-append date form_end_date" data-date=""  data-date-format="dd MM yyyy" data-link-field="end_date">
                                 <input size="16" type="text" value="{{ $tournament->end_date }}" readonly class="form-control" placeholder="Please select a Date" required="required">
                                 <span class="add-on"><i class="icon-remove"></i></span>
                                 <span class="add-on"><i class="icon-th"></i></span>
                             </div>
                             <input type="hidden" id="end_date" name="end_date" value="{{ $tournament->end_date }}" />
                         </div>

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    @section('footer_scripts')
        <script type="text/javascript" src="{{ asset('assets/js/pages/tournaments.js')}}"></script>
    @stop
</section>
@stop