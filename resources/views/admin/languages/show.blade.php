@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')l
    language
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Language</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>languages</li>
        <li class="active">languages</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    club {{ $language->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body" style="align-content: center">
                <table class="table">
                    <tr><td>Id</td><td>{{ $language->id }}</td></tr>
                    <tr><td>Name</td><td>{{ $language->name }}</td></tr>
                    <tr><td>Code</td><td>{{ $language->code }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop