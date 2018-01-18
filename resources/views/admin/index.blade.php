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
                        Matches
                    </div>
                </div>
            </div>
              <div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Home club</th>
                        <th>Away club</th>
                        <th>Date</th>
                        <th>Seats Available</th>
                        <th>Seats Ordered</th>
                        <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($matches as $m)
                     <?php $available = 0;
                           $ordered = 0; ?>
                    @foreach($seatsAvailable[$m->id] as $key => $value)
                        <?php $available += $value;?>
                    @endforeach
                    @foreach($seatsOrdered[$m->id] as $key => $value)
                        <?php $ordered += $value;?>
                    @endforeach

                    <tr @if($available != $ordered)  class="danger"  @elseif($available == $ordered && 
                    count(array_diff_assoc($seatsAvailable[$m->id],$seatsOrdered[$m->id])) == 0 )  class="success"  @else  class="warning"  @endif>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->getHomeClub->name }}</td>
                        <td>{{ $m->getAwayClub->name }}</td>
                        <td>{{ $m->match_date }}</td>
                        <td>
                            <table>
                                @foreach($seatsAvailable[$m->id] as $key => $value)
                                    <tr>
                                        <td>
                                            {{ $key .': ' }}
                                            <span class="badge badge-pill badge-secondary">{{ $value }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td>
                            <table>
                                @foreach($seatsOrdered[$m->id] as $key => $value)
                                    <tr>
                                        <td>
                                            {{ $key .': ' }}
                                            <span class="badge badge-pill badge-secondary">{{ $value }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td>                        
                            <a href="{{ route('admin.matches.show', $m->id) }}">
                                <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view match"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="text-center">
                <?php echo $matches->render(); ?>
            </div>
        </div>
    </div>

    <div class="clearfix visible-xs-block"></div>

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
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Match</th>
                        <th>Match date</th>
                        <th>Total</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{!! $order->id !!}</td>
                        <td>{!! $order->customerName !!}</td>
                        <td>{!! $order->home_club !!} - {!! $order->away_club !!}</td>
                        <td>{!! $order->match_date !!}</td>
                        <td>{!! $order->total !!}</td>
                        <td>{!! $order->created_at !!}</td>
                        <td>
                            @if($order->status == 'Pending')
                                <span class="label label-danger">Pending</span>
                            @elseif($order->status == 'Processing')
                                <span class="label label-warning">Processing</span>
                            @elseif($order->status == 'Completed')
                                <span class="label label-success">Completed</span>
                            @else
                                <span class="label label-default">{!! $order->status !!}</span>
                            @endif

                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view order"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
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

    <!--  todolist-->
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
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
