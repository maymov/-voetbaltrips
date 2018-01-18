@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
product
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Products</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>products</li>
        <li class="active">products</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    product {{ $product->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $product->id }}</td></tr>
                     <tr><td>name</td><td>{{ $product['name'] }}</td></tr>
					<tr><td>code</td><td>{{ $product['code'] }}</td></tr>
					<tr><td>category</td><td>{{ $product['category'] }}</td></tr>
					<tr><td>price</td><td>{{ $product['price'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop