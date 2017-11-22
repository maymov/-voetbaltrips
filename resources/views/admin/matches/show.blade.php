@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
match
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Matches</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>matches</li>
        <li class="active">matches</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    match {{ $matchInfo['id'] }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $matchInfo['id'] }}</td></tr>
					<tr><td>Tournament</td><td>{!! $matchInfo['tournament'] !!}</td></tr>
					<tr><td>Stadium</td><td>{!! $matchInfo['stadium'] !!}</td></tr>
					<tr><td>Home Club</td><td>{!! $matchInfo['home_club'] !!}</td></tr>
					<tr><td>Away Club</td><td>{!! $matchInfo['away_club'] !!}</td></tr>
                    <tr>
                        <td>Data Fixed</td>
                        @if ($matchInfo['fixed_data'])
                            <td><i class="livicon" data-name="check" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view language"></i></td>
                        @else
                            <td><i class="livicon" data-name="circle" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view language"></i></td>
                        @endif
                    </tr>
					<tr><td>Match Date</td><td>{{ $matchInfo['date'] }}</td></tr>
                    <tr><td>Match Image</td><td><img src="{{ url("uploads/matches/".$matchInfo['image']) }}" width="100%"></td></tr>
                </table>

                <table class="table table-bordered">
                    <thead><h4>Ticket Price</h4></thead>
                    <tr>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Sold</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>
                    @if($matchInfo['cat1_price'] != 0)
                    <tr>
                        <td>{{ $matchInfo['cat1_name'] }}</td>
                        <td>{{ $matchInfo['cat1_count'] }}</td>
                        <td>{{ $matchInfo['cat1_sold'] }}</td>
                        <td>{{ $matchInfo['discount'] }}</td>
                        <td>{{ $matchInfo['cat1_price'] }}</td>
                        <td>{!! $matchInfo['cat1_price'] - $matchInfo['discount']  !!}</td>
                    </tr>
                    @endif
                    @if($matchInfo['cat2_price'] != 0)
                    <tr>
                        <td>{{ $matchInfo['cat2_name'] }}</td>
                        <td>{{ $matchInfo['cat2_count'] }}</td>
                        <td>{{ $matchInfo['cat2_sold'] }}</td>
                        <td>{{ $matchInfo['discount'] }}</td>
                        <td>{{ $matchInfo['cat2_price'] }}</td>
                        <td>{!! $matchInfo['cat2_price'] - $matchInfo['discount']  !!}</td>
                    </tr>
                    @endif
                    @if($matchInfo['cat3_price'] != 0)
                    <tr>
                        <td>{{ $matchInfo['cat3_name'] }}</td>
                        <td>{{ $matchInfo['cat3_count'] }}</td>
                        <td>{{ $matchInfo['cat3_sold'] }}</td>
                        <td>{{ $matchInfo['discount'] }}</td>
                        <td>{{ $matchInfo['cat3_price'] }}</td>
                        <td>{!! $matchInfo['cat3_price'] - $matchInfo['discount']  !!}</td>
                    </tr>
                    @endif
                    <tr></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop