@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New ticket
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Tickets</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>ticket</li>
        <li class="active">Create New Ticket</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new ticket
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

                    {!! Form::open(['url' => 'admin/competition_seatings']) !!}
					<div class="form-group">
                        {!! Form::label('matches', 'Match: ') !!}
                        <select class="form-control" name="matches" required=""required>
                            <option value="">Pick a match</option>
                            @foreach($matches as $match)
                            <option value="{{$match->id}}">{{ $match->getHomeClub->name." - ".$match->getAwayClub->name }} on {{ $match->match_date }}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group">
                        {!! Form::label('away_club', 'Seating Category: ') !!}
                        {!! Form::select("seating_category", $seating_category, null, ["placeholder" =>"Pick a Seating Category", 'class'=>'form-control', "required"=>"required"]) !!}
                    </div>
					<div class="form-group">
                        {!! Form::label('price', 'Price: ') !!}
                        {!! Form::text('price', null, ['class' => 'form-control', "required"=>"required"]) !!}
                    </div>
					<div class="form-group">
                        {!! Form::label('quantity_available', 'Quantity Available: ') !!}
                        {!! Form::text('quantity_available', null, ['class' => 'form-control', "required"=>"required"]) !!}
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.competition_seatings.index') }}">
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
</section>

@stop