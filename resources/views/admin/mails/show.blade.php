@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
mail
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
        <li class="active">mails</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    club {{ $mail->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body" style="align-content: center">
                <table class="table">
                    <tr><td>Id</td><td>{{ $mail->id }}</td></tr>
                     <tr><td>Name</td><td>{{ $mail->name }}</td></tr>
                    <tr><td><h4>Mail for different languages:</h4></td><td></td></tr>
                    @foreach ($languages as $lang)
                        @foreach ($mail->getTranslate as $trans)
                            @if($lang->code == $trans->lang_code)
                                <tr><td>Title {{$trans->lang_code}}</td> <td>{{$trans->title}}</td></tr>
                                <tr><td>Message {{$trans->lang_code}}</td> <td>{{$trans->text}}</td></tr>
                            @endif
                        @endforeach
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
@stop