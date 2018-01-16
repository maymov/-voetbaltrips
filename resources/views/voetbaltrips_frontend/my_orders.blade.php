@extends('newtemplate/layout')

{{-- Page title --}}
@section('title')
    {{Translater::getValue('title-user-account')}}
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/skins/minimal/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@stop

{{-- Page content --}}
@section('content')
    @if (session('mail'))
        <input class="hide" id="mess-mail" value="{{session('mail')}}" title="{{Translater::getValue('form-label-information')}}" text="{{Translater::getValue('mail-message-we-sent-the-letter-on-your-email')}}">
    @endif

    <div class="container">
        <div class="welcome">
            <h3>{{Translater::getValue('label-my-orders')}}</h3>
        </div>
        <div class="row">
            <div class="row">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <!--main content-->
                    <div class="position-center">
                        <!-- Notifications -->
                        @include('notifications')

                        <div>
                            <h3 class="text-primary">{{Translater::getValue('title-orders-information')}}</h3>
                        </div>
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{Translater::getValue('label-match')}}</th>
                                <th>{{Translater::getValue('label-seating-category')}}</th>
                                <th>{{Translater::getValue('label-amount')}}</th>
                                <th>{{Translater::getValue('label-created-at')}}</th>
                                <th>{{Translater::getValue('label-action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key=>$order)
                            <tr>
                                <td>
                                    {!! ($key+1) !!}
                                </td>
                                <td>
@if($order->getMatchesOrder)
                                    @if ($order->getMatchesOrder->home_club && $order->getMatchesOrder->away_club)
                                        {!! $order->getMatchesOrder->home_club !!} - {!! $order->getMatchesOrder->away_club !!}
				    @endif
@endif
                                </td>
                                <td>
@if($order->getMatchesOrder)
                                    @if($order->getMatchesOrder->seating_type)
                                        {!! $order->getMatchesOrder->seating_type !!}
                                    @endif
@endif
                                </td>
                                <td>
                                    @if($order->order_total)
                                        {!! $order->order_total !!}
                                    @endif
                                </td>
                                <td>
                                    @if($order->created_at)
                                        {!! $order->created_at !!}
                                    @endif
                                </td>
                                <td><a href="{!! url("my-orders/view/".$order->id) !!}">{{Translater::getValue('label-view')}}</a> </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $orders->render() !!}
                </div>
            </div>
        </div>
    </div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/select2.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
    <script>
        $(document).ready(function(){
            var title   = $('#mess-mail').attr('title')
            var text    = $('#mess-mail').attr('text');
            if (title && text) {
                $('#modalheader2').text(title);
                $('#modaltext2').text(text);
                $('#myModal2').modal('show');
                $('#i-question').hide();
                $('#i-inform').show();
                $('#modal2-confirm').hide();
                $('#modal2-no').hide();
                $('#modal2-ok').show();
            }
        });
    </script>
@stop
