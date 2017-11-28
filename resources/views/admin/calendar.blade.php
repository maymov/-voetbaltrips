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
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        <i class="fa fa-plus"></i>
                                        Create Event
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <form id="taskForm">
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                         <div class="form-group">
                                             {!! Form::label('task_name', 'Name: ') !!}
                                             {!! Form::text('task_name', null, ['class' => 'form-control']) !!}
                                         </div>


                                        <div class="form-group">
                                            {!! Form::label('task_deadline', 'Date: ') !!}
                                            <div class="controls input-append date form_datetime" data-date=""  data-date-format="dd MM yyyy hh:ii" data-link-field="task_deadline">
                                                    <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select a Date" required="required">
                                                    <span class="add-on"><i class="icon-remove"></i></span>
                                                    <span class="add-on"><i class="icon-th"></i></span>
                                                </div>
                                                <input type="hidden" id="task_deadline" name="task_deadline" value="" />
                                        </div>    
                                        <div class="form-group">
                                             {!! Form::label('task_description', 'Description: ') !!}
                                             {!! Form::textarea('task_description', null, ['class' => 'form-control']) !!}
                                         </div>
                                     </form>
                                    <!-- /input-group --> </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-right"  data-dismiss="modal">
                                        Close
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">
                                        <i class="fa fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

        <script src="{{ asset('assets/vendors/fullcalendar/moment.min.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('assets/vendors/fullcalendar/fullcalendar.min.js') }}"  type="text/javascript"></script>

            <script>

        $(document).ready(function() {

    $('.form_datetime').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 0,
        forceParse: 0
    });

            function ini_events(ele) {
                ele.each(function() {
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };
                    $(this).data('eventObject', eventObject);

                });
            }

            $( "#add-new-event" ).click(function() {    
                var name = $('#name').val();
                var decription = $('#description').val();
                var deadLine = $('#deadLine').val();
                formdata   = $("#taskForm").serialize();

                    $.ajax({
                        url      : "task/create",
                        method   : "POST",
                        dataType : "json",
                        data     : formdata,
                        error : function(resp){
                            console.log(resp);
                        },
                        success  : function (resp) { 
                            console.log(resp)
                        }
                    });
            });

            function setDate(date) {
                $(".form_datetime").datetimepicker("setDate", new Date(date.format()));
            }

                ini_events($('#external-events div.external-event'));

                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: [
                    <?php foreach($matches as $match) {?>
                         {
                            title: <?php echo "'" . $match->getHomeClub->name . ' - ' . $match->getAwayClub->name . "'"; ?>,
                            start: new Date("<?php echo $match->match_date; ?>"),
                            url: '/admin/matches/<?php echo $match->id; ?>',
                            backgroundColor: "#418BCA"
                        },
                    <?php }?>
                    ],
                    editable: false,
                    droppable: false, 
                    contentHeight: "auto",
                    height: "auto",
                    eventClick: function(event) {
                        if (event.url) {
                            window.open(event.url);
                            return false;
                        }
                    },    
                    dayClick: function(date, jsEvent, view) {
                        $('#myModal').modal('show');
                        setDate(date);

                        //alert('Clicked on: ' + date.format());

                        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                        //alert('Current view: ' + view.name);

                        // change the day's background color just for fun
                        //$(this).css('background-color', 'red');

                    }
                });
            });
    </script>
        
@stop