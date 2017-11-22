$(function(){
   var saveSeatingTicket = function(val) {
       var ticket = $("input[name='ticket']:checked").val();
       if(typeof ticket == "undefined") {
           Lobibox.alert("info", {
               msg : "Please select a Ticket you want to book!",
           });
           return false;
       } else {
           $.ajax({
               url      : window.location.protocol + "//" + window.location.hostname+"/matchsave/"+$("#match_id").val(),
               dataType : "json",
               data     : $("#frmmatchdetails").serialize(),
               method   : "POST",
               beforeSend : function() {
                  $('body').loadingModal({text: 'Please Wait...'});
               },
               complete : function(){
                  $('body').loadingModal('hide');
               },
               success  : function(resp) {
                   if(resp.status == "success") {
                       showCartPrice();
                   }
                   Lobibox.notify(resp.status, {
                      msg       : resp.message,
                   });
                   window.location.reload();
               },
               error: function( jqXhr, textStatus, errorThrown ){
                    Lobibox.notify("error", { msg : "Something went wrong. Please try again later."})
               }
           });
       }
   };
   $("body").on("click", "#addtocart", function(){
       window.location.href = window.location.protocol + "//" + window.location.hostname+'/match/'+$("#match_id").val()+'/flight';
   });
   $('[data-toggle="popover"]').popover();
   var showTicketPrice = function () {
       var match_ticket = $("input[name='ticket']:checked").val();
       if(match_ticket != "undefined" || match_ticket !="") {
           var priceget = $("input[name='ticket']:checked").data("price");
           $("#tprice").html(priceget);
           var t_qty = $("#ticket_quantity").val();
           $("#tqty").html(t_qty);
           $("#totprice").html((t_qty*priceget));
       }
   };

   showTicketPrice();

    var ticket_old;
    var previous;
    var fix = $('#fixed');
    if (fix.val() == 0) {
        var title = fix.attr('name');
        var text = fix.attr('text');
        $('#modalheader2').text(title);
        $('#modaltext2').text(text);
        $('#i-question').hide();
        $('#i-inform').show();
        $('#modal2-confirm').hide();
        $('#modal2-no').hide();
        $('#modal2-ok').show();
        $('#myModal2').modal('show');
    }
    ticket_old = $("input[name='ticket']:checked").val();

    $(".rdticket").change(function (e) {
        var currentticket = this.value;
        data = {'title': 'quest', 'page': 'seats'};
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
                    $('#i-question').show();
                    $('#i-inform').hide();
                    $('#modal2-confirm').show();
                    $('#modal2-no').show();
                    $('#modal2-ok').hide();

                    $('#myModal2').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modal2-confirm').on("click", function () {
                        saveSeatingTicket();
                        ticket_old = currentticket;
                        showTicketPrice();
                    });
                    $('#modal2-no').on("click", function () {
                        $('.rdticket').filter('[value="'+ticket_old+'"]').prop('checked', true);
                    });
                } else {
                    Lobibox.notify(resp.status, {
                        msg: resp.message,
                    });
                }
            }
        });
    });

    $("#ticket_quantity").focus(function () {
        previous = this.value;
    }).change(function () {
        var data = {'title': 'quest', 'page': 'seats-change'};
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
                    $('#i-question').show();
                    $('#i-inform').hide();
                    $('#modal2-confirm').show();
                    $('#modal2-no').show();
                    $('#modal2-ok').hide();
                    $('#myModal2').modal('show');
                    $('#modal2-confirm').on("click", function () {
                        saveSeatingTicket();
                        previous = this.value;
                        showTicketPrice();
                    });
                    $('#modal2-no').on("click", function () {
                        $('#ticket_quantity').val(previous);
                    });
                }
            }
        });
    });
});