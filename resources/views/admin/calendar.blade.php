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

            <script>

        $(document).ready(function() {

            function ini_events(ele) {
                ele.each(function() {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    //$(this).draggable({
                      //  zIndex: 1070,
                        //revert: true, // will cause the event to go back to its
                        //revertDuration: 0 //  original position after the drag
                    //});//

                });
            }
                ini_events($('#external-events div.external-event'));

                var event, matches = [];

                    <?php foreach($matches as $match) {?>
                        event: {
                            title: <?php echo "'" . $match->getHomeClub->name . ' - ' . $match->getAwayClub->name . "'"; ?>,
                            start: new Date(<?php echo "'" . $match->match_date . "'"; ?>
                        };
                        matches.push(event);
                    <?php }?>


                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear();
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: matches,
                    editable: false,
                    droppable: false, 
                });
            });
    </script>
        
@stop