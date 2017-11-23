@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Calendar
@parent
@stop


{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.print.css') }}" rel="stylesheet"  media='print' type="text/css">
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css" />
    <!--page level styles ends-->
@stop

{{-- Page content --}}
@section('content')

                <section class="content-header">
                    <h1>Calendar</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>Calendar</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            <!-- /.box --> </div>
                        <!-- /.col --> </div>
                    <!-- Modal -->
                    </div>
                </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
        
        <script src="{{ asset('assets/vendors/fullcalendar/moment.min.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('assets/vendors/fullcalendar/fullcalendar.min.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/calendar.js') }}"  type="text/javascript"></script>
@stop