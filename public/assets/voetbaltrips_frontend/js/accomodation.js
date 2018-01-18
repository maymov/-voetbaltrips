$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $("body").on("click", "#addroomtocart", function() {
        window.location.href = window.location.protocol + "//" + window.location.hostname + "/match/"+ $("#match_id").val() + "/extras";
    });
    $('#rating-system').rating({
        displayOnly  : true,
        step         : 1,
        showClear    : false,
        size         : 'sm'
    });
    var oldhotel = $("input[name='accomo']:checked").val();
    var currenhotel ;
    console.log(oldhotel);
    console.log(currenhotel);
    $("input[name='accomo']").change(function () {
        currenhotel = this.value;
        console.log(currenhotel);
        var data = {'title': 'quest', 'page': 'change-accomodation'};
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
                    $('#myModal2').modal({
                        backdrop: 'static',
                        keyboard: false});
                    $('#modal2-confirm').on("click", function () {
                        oldhotel = currenhotel;
                        showHotelDetails();
                    });
                    $('#modal2-no').on("click", function () {
                        $('input[name="accomo"]').filter('[value="'+oldhotel+'"]').prop('checked', true);
                    });
                } else {
                    Lobibox.notify(resp.status, {
                        msg: resp.message,
                    });
                }
            }
        });
    });
    var showHotelDetails = function() {
        console.log($("#frmroomdetails").serialize());
        $.ajax({
            url      : window.location.protocol+"//"+window.location.hostname+"/gethoteldetails",
            method   : "POST",
            data     : $("#frmroomdetails").serialize(),
            dataType : "json",
            beforeSend : function () {
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete : function(){
                $('body').loadingModal('destroy');
            },
            success : function(resp) {
                if(resp.status == "success") {
                    $('#rating-system').rating({
                        displayOnly  : true,
                        step         : 1,
                        showClear    : false,
                        size         : 'sm'
                    });
                    $.when(showCartPrice()).then(window.location.reload());
                }
            },
            error : function (err) {
                Lobibox.alert("error", {
                    msg : "Something went wrong please try again later",
                });
            }
        });
    };
    $("input[name='include_breakfast']").change(function () {
       showHotelDetails();
    });
    $('#input-1').checkboxpicker({
        html     : true,
        /*offLabel : '<span class="glyphicon glyphicon-thumbs-down">',
        onLabel  : '<span class="glyphicon glyphicon-thumbs-up">'*/
        /*offLabel: '<span class="glyphicon glyphicon-remove">',
        onLabel: '<span class="glyphicon glyphicon-ok">'*/
    });
});
