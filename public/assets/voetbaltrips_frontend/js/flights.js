$(document).ready(function () {

    if (showText == 1) {
        Lobibox.alert("info", {
            msg : "This is a sample message."
        });
    }

    $("body").on("click", "tr[name=dept_flight_td]", function(){
        var dept    = $(this).find("input");
        var befdep  = $(".checktddepart");
        var bef     = befdep.find("input");

        if (bef.is(":checked")) {
            bef.click();
        }
        dept.click();
        befdep.attr("class", "");
        $(this).attr("class", "checktddepart");
    });

    $("body").on("click", "tr[name=return_flight_td]", function(event){
        var inp = $(this).find("input");
        var beftr = $(".checktdrett");
        var b = beftr.find("input")

        if (b.is(":checked")) {
            b.click();
        }
        inp.click();
        beftr.attr("class", "");
        $(this).attr("class", "checktdrett");
    });

    $('[data-toggle="popover"]').popover();

    $("body").on("click", "#addflighttocart", function(){

        if (!$("input[name=dept_flight]").is(":checked")) {
            var data = {'title': 'information', 'page': 'outgoing-flight'};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="modal_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajax/modal",
                dataType: "json",
                data: data,
                method: "POST",
                success: function (resp) {
                    if (resp.status == "success") {
                        $('#modalheader2').text(resp.title);
                        $('#modaltext2').text(resp.quest);
                        $('#myModal2').modal('show');
                        $('#i-question').hide();
                        $('#i-inform').show();
                        $('#modal2-confirm').hide();
                        $('#modal2-no').hide();
                        $('#modal2-ok').show();
                    } else {
                        Lobibox.notify(resp.status, {
                            msg: resp.message,
                        });
                    }
                }
            });
            return false;
        } else if(!$("input[name=return_flight]").is(":checked")) {
            var data = {'title': 'information', 'page': 'return-flight'};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="modal_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajax/modal",
                dataType: "json",
                data: data,
                method: "POST",
                success: function (resp) {
                    if (resp.status == "success") {
                        $('#modalheader2').text(resp.title);
                        $('#modaltext2').text(resp.quest);
                        $('#myModal2').modal('show');
                        $('#i-question').hide();
                        $('#i-inform').show();
                        $('#modal2-confirm').hide();
                        $('#modal2-no').hide();
                        $('#modal2-ok').show();
                    } else {
                        Lobibox.notify(resp.status, {
                            msg: resp.message,
                        });
                    }
                }
            });
            return false;
        } else {
            $.ajax({
                url      : window.location.protocol + "//" + window.location.hostname+"/flightsave/"+$("#match_id").val(),
                dataType : "json",
                data     : $("#frmflightdetails").serialize(),
                method   : "POST",
                success  : function(resp) {
                    if(resp.status == "success") {
                        window.location.href = resp.nextpage;
                    } else
                        alert(resp.message);
                },
                error : function(er){
                    Lobibox.notify("error",
                        {
                            msg : "Something went wrong. Please try again later."
                        }
                    );
                }
            });
        }
    });

    var filterAirport = function () {
        var favorite = [];
        $.each($(".checkbox-custom:checked"), function () {
            favorite.push($(this).val());
        });
        $('#airports').val(favorite);
        SearchFlights()
    }

    $(".checkbox-custom").on("click", function(event) {
       filterAirport();
    });

    function SearchFlights(m, d) {
        var v;
        if (m == "return") {
            v = $("input[name=dept_flight]:checked");
        }
        if (m == "outfliy") {
            v = $("input[name=return_flight]:checked");
        }
//        var data = $("#searchform").serializeArray();
        var data = $("#searchform").serializeArray();
        data[data.length] = { name: "button_direction", value: d };
        $.ajax({
            url        : window.location.protocol + "//" + window.location.hostname+"/searchflights",
            method     : "POST",
            dataType   : "json",
            data       : data,
            beforeSend : function () {
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete   : function(){
                $('body').loadingModal('destroy');
            },
            success    : function (resp) {
                if(resp.out_count > 0){
                    $("#outgoing_Data").html(resp.from_flight);
                } else {
                    $("#outgoing_Data").html("<div class='alert alert-danger' align='center'>There is no outgoing flights.</div>");
                }
                if(resp.to_count > 0) {
                    $("#to_data").html(resp.return_flight);
                } else {
                    $("#to_data").html("<div class='alert alert-danger' align='center'>There is no return flights.</div>");
                }
                $('[data-toggle="popover"]').popover();
            },
            error      : function( jqXhr, textStatus, errorThrown ){
                Lobibox.notify("error",
                    {
                        msg : "Something went wrong. Please try again later."
                    }
                );
            }
        });
    };

    SearchFlights();

    $("body").on("click", "#returnsort", function(){
        var o = $(this).hasClass('glyphicon-triangle-bottom') ? 'glyphicon-triangle-top' : 'glyphicon-triangle-bottom';
        $('#returnsort').removeClass('glyphicon-triangle-bottom').removeClass('glyphicon-triangle-top');
        $(this).addClass(o);
        $("#sorttype").val("returnprice");
        if(o == "glyphicon-triangle-bottom") {
            $("#sortorder").val("asc");
        } else {
            $("#sortorder").val("desc");
        }
        SearchFlights();
    });
    $("body").on("click", "#outsort", function(){
        var o = $(this).hasClass('glyphicon-triangle-bottom') ? 'glyphicon-triangle-top' : 'glyphicon-triangle-bottom';
        $('#outsort').removeClass('glyphicon-triangle-bottom').removeClass('glyphicon-triangle-top');
        $(this).addClass(o);
        $("#sorttype").val("outprice");
        if(o == "glyphicon-triangle-bottom") {
            $("#sortorder").val("asc");
        } else {
            $("#sortorder").val("desc");
        }
        SearchFlights();
    });

    $("body").on("click", ".day-earl", function(e){
        var elem = $(this);
        var val = '-1 day';
        var name = elem.prop('name');
        var ret = $('#date_now_in_form_return').text();
        var out =$('#date_now_in_form').text();
        var m = "";

        if (name == 'earl_day_outfliy') {
            $('#day_mode').val("outfliy");
            m = "outfliy";
        } else if (name == 'earl_day_return') {
            $('#day_mode').val("return");
            m = "return";
        }
        $('#day_val').val(val);
        $('#day_form_ret').val(ret);
        $('#day_form_out').val(out);

        SearchFlights(m);
    });

    $("body").on("click", ".day-latter", function(e){
        var elem = $(this);
        var val = '+1 day';
        var name = elem.prop('name');
        var ret = $('#date_now_in_form_return').text();
        var out =$('#date_now_in_form').text();
        var m ="";
        var d ="";

        if (name == 'latt_day_outfliy') {
            $('#day_mode').val("outfliy");
            m = "outfliy";
            d = "latt_day_outfliy";
        } else if (name == 'latt_day_return') {
            $('#day_mode').val("return");
            m = "return";
        }
        $('#day_val').val(val);
        $('#day_form_ret').val(ret);
        $('#day_form_out').val(out);

        SearchFlights(m, d);
    });
});