@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
accomodations List
@parent
@stop
@section('header_styles')
    <link rel="stylesheet"  media="all" href="{{ asset('assets/css/star-rating.min.css')}}">
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Accomodations</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>accomodations</li>
        <li class="active">accomodations</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Accomodations List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.accomodations.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>City</th>
							<th>Stars</th>
							<th>High_season_prices</th>
							<th>Low_season_prices</th>
							<th>Breakfast_price</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($accomodations as $x=>$accomodation)
                        <tr>
                            <td>{!! $accomodation->id !!}</td>
                            <td>{!! $accomodation->name !!}</td>
                            <td>{!! $accomodation->country->name !!}</td>
                            <td>{!! $accomodation->cityobj->name !!}</td>
							<td> <input id="rating_{{$x}}" type="number" class="rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $accomodation->stars }}" name="stars{{$x}}"/></td>
							<td>{!! $accomodation->high_season_prices !!}</td>
							<td>{!! $accomodation->low_season_prices !!}</td>
							<td>{!! $accomodation->breakfast_price !!}</td>
                            <td>
                                <a href="{{ route('admin.accomodations.show', $accomodation->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view accomodation"></i>
                                </a>
                                <a href="{{ route('admin.accomodations.edit', $accomodation->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit accomodation"></i>
                                </a>
                                <a href="{{ route('admin.accomodations.confirm-delete', $accomodation->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete accomodation"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script src="{{ asset('assets/js/star-rating.min.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
        @for($x=0; $x<$accomodations->count(); $x++)
        $('#rating_{{$x}}').rating({
            displayOnly  : true,
            step         : 1,
            showClear    : false,
            size         : 'xm'
        });
        @endfor
    });
</script>
@stop
