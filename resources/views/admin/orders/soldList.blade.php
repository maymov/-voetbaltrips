@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')

    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datepicker/css/datepicker.css') }}">

@stop

{{-- Page content --}}
@section('content')

<div class="content">

    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        Orders
                    </div>
                </div>
            </div>
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Total Actual Cost</th>
                        <th>Profit</th>
                        <th>Net Profit</th>
                        <th>BTW</th>
                        <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{!! $order->id !!}</td>
                        <td>{!! $order->customerName !!}</td>
                        <td>{!! $order->total !!}</td>
                        <td>{!! $order->totalActual !!}</td>
                        <td>{!! number_format($order->profit, 2) !!}</td>
                        <td>{!! number_format($order->netProfit, 2) !!}</td>
                        <td>{!! number_format($order->btw, 2) !!}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view order"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
					<tr>
                        <td colspan="8"></td>
                    </tr>		
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Total Profit</b></td>
                        <td><b>Total Net Profit</b></td>
                        <td><b>Total BTW</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{!! number_format($totalProfit, 2) !!}</td>
                        <td>{!! number_format($totalNetProfit, 2) !!}</td>
                        <td>{!! number_format($totalBTW, 2) !!}</td>
                        <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="text-center">
                <?php echo $orders->render(); ?>
            </div>
        </div>
    </div>
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/pages/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script>
        $(function () {
            $(".datepicker").datepicker();
        });

    </script>

    <!-- EASY PIE CHART JS -->
    <script src="{{ asset('assets/vendors/charts/easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/charts/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/charts/jquery.easingpie.js') }}"></script>
    <!--for calendar-->
    <script src="{{ asset('assets/vendors/fullcalendar/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
    <script src="{{ asset('assets/vendors/charts/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/charts/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <!--Sparkline Chart-->
    <script src="{{ asset('assets/vendors/charts/jquery.sparkline.js') }}"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('assets/vendors/countUp/countUp.js') }}"></script>
    <!--   maps -->
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendors/jscharts/Chart.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}" type="text/javascript"></script>


@stop
