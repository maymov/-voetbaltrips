@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a mail
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Mails</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>mails</li>
        <li class="active">Create New mail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit mail
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

                    {!! Form::model($mail, ['method' => 'PATCH', 'action' => ['MailsController@update', $mail->id]]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name: ') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                         @foreach ($languages as $lang)
		                     <?php $title_l = ''; $text_l = ''; ?>
                             <div class="form-group">
                                 {!! Form::label('title_'.$lang->code, 'Title '.$lang->code.': ') !!}
                                 @foreach ($mail->getTranslate as $trans)
                                     @if ($lang->code == $trans->lang_code)
			                             <?php $title_l = $trans->title;
                                               $text_l = $trans->text; ?>
                                     @endif
                                 @endforeach
                                 {!! Form::textarea('title_'.$lang->code, $title_l, ['class' => 'form-control', 'required' => 'required']) !!}

                                 {!! Form::label($lang->code, 'Message '.$lang->code.': ') !!}
                                 {!! Form::textarea($lang->code, $text_l, ['class' => 'form-control', 'required' => 'required']) !!}

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
        <<script src="{{ asset('assets/js/pages/clubs.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>
@stop