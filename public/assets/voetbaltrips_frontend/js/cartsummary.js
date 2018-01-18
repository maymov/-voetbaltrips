$(document).ready(function(){
    if ($('#hometeamforticket').attr('text').length > 1) {
        postTickets();
    }
    function postTickets(){
        var text = $('#hometeamforticket').attr('text');
        var title = $('#hometeamforticket').attr('title');

        $('#modalheader2').text(title);
        $('#modaltext2').text(text);
        $('#myModal2').modal('show');
        $('#i-question').hide();
        $('#i-inform').show();
        $('#modal2-confirm').hide();
        $('#modal2-no').hide();
        $('#modal2-ok').show();
    };

    $('.number_only').keyup(function () {
        this.value = this.value.replace(/[^0-9.]/g,'');
    });
    if ($)
    $(".updateoption").click(function () {
        var identity = $(this).data("know");
        var qty      = $("#txt_"+identity).val();
        if(!isNaN(qty) && qty > 0) {
            $.ajax({
                url : window.location.protocol+"//"+window.location.hostname+"/addoptions",
                data : {
                    "_token"   : $("[name=_token]").val(),
                    "qty"      : qty,
                    "identity" : identity
                },
                method : "POST",
                dataType : "json",
                beforeSend : function() {
                    $('body').loadingModal({text: 'Please Wait...'});
                },
                complete: function() {
                    $('body').loadingModal('destroy');
                },
                success : function (resp) {
                    Lobibox.alert(resp.status, {
                        msg       : resp.message,
                        callback  : function(lobibox, type){
                            if(resp.status == "success") {
                                window.location.href = window.location.href;
                            }
                        }
                    });
                },
                error : function (er) {
                    Lobibox.alert("error", {
                        msg : "Unable to add options to the cart. Please try again later!!!"
                    });
                }
            });
        } else {
            Lobibox.alert("error", {
                msg : "Please enter valid quantity!!!"
            });
            $("#txt_"+identity).focus()
        }
    });
    $(".removeoption").click(function() {
        var identity = $(this).data("know");
        Lobibox.confirm({
            msg: "Are you sure you want to delete this option?",
            callback: function ($this, type, ev) {
                if(type == "yes") {
                    $.ajax({
                        url : window.location.protocol+"//"+window.location.hostname+"/removeoptions",
                        data : {
                            "_token"   : $("[name=_token]").val(),
                            "identity" : identity
                        },
                        method : "POST",
                        dataType : "json",
                        beforeSend : function() {
                            $('body').loadingModal({text: 'Please Wait...'});
                        },
                        complete: function() {
                            $('body').loadingModal('destroy');
                        },
                        success : function (resp) {
                            Lobibox.alert(resp.status, {
                                msg       : resp.message,
                                callback  : function(lobibox, type){
                                    if(resp.status == "success") {
                                        window.location.href = window.location.href;
                                    }
                                }
                            });
                        },
                        error : function (er) {
                            Lobibox.alert("error", {
                                msg : "Unable to Remove option from the cart. Please try again later!!!"
                            });
                        }
                    });
                }
            }
        });
    });
    $("#proceedtopayment").click(function(){

        var coupon_code = $('#coupon_code').val();

        $.ajax({
            url      : window.location.protocol + "//" + window.location.hostname + "/cart/confirm",
            method   : "GET",
            dataType : "json",
            data: {coupon_code: coupon_code},
            success  : function (resp) {
                if(resp.status == "success") {
                    window.location.href = window.location.protocol + "//" + window.location.hostname + "/cart/proceed";
                } else {
                    Lobibox.alert("error", {
                        msg : resp.message
                    });
                }
            }
        })
    });
});

function coupon_check() {
    var coupon_code = $('#coupon_code').val();
    
    $.ajax({
            url      : window.location.protocol + "//" + window.location.hostname + "/coupon_check_code",
            method   : "GET",
            dataType : "json",
            data: {coupon_code: coupon_code},
            success  : function (resp) {
                if(resp.status == "success") {
                    if (resp.coupon == 'valid') {
                        Lobibox.alert("success", {
                        msg : resp.message
                    });
                    }
                    if (resp.coupon == 'not_valid') {
                        Lobibox.alert("error", {
                        msg : resp.message
                    });
                    }
                    
                } else {
                    Lobibox.alert("error", {
                        msg : resp.message
                    });
                }
            }
        })
}