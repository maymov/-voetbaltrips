@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
seatingcategory
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Seatingcategories</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>seatingcategories</li>
        <li class="active">seatingcategories</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    seatingcategory {{ $seatingcategory->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>Id</td><td>{{ $seatingcategory->id }}</td></tr>
                    <tr><td>Name</td><td>{{ $seatingcategory['name'] }}</td></tr>
                    <tr><td>Color</td><td><div style="background-color: {{ "#".$seatingcategory['color'] }}; width: 20%">&nbsp;</div></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop