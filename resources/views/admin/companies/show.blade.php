@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
company
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Companies</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>companies</li>
        <li class="active">companies</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    company {{ $company->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $company->id }}</td></tr>
                     <tr><td>admin_user_id</td><td>{{ $company['admin_user_id'] }}</td></tr>
					<tr><td>name</td><td>{{ $company['name'] }}</td></tr>
					<tr><td>active</td><td>{{ $company['active'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop