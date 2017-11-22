@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
hotel-option
@parent
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
        <li class="active">hotel-options</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    hotel-option {{ $option->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>Id</td><td>{{ $option->id }}</td></tr>
                    <tr><td>Hotel Option Name</td><td>{{ $option->name }}</td></tr>
                    <tr><td><h4>Name for different languages:</h4></td><td></td></tr>
                    @foreach ($option->getTranslate as $trans)
                        <tr><td>{{$trans->lang_code}}</td><td>{{$trans->trans_name}}</td></tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop