$(document).ready(function () {
	$('[data-toggle="popover"]').popover();
	$('.number_only').keyup(function () { 
    	this.value = this.value.replace(/[^0-9.]/g,'');
	});
	$(".addoption").click(function () {
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

                    $('#modalheader2').text(resp.status_translate);
                    $('#modaltext2').text(resp.message);
                    $('#myModal2').modal('show');
                    $('#i-question').hide();
                    $('#i-inform').show();
                    $('#modal2-confirm').hide();
                    $('#modal2-no').hide();
                    $('#modal2-ok').show();
                    showCartPrice();
                },
                error : function (er) {
                    Lobibox.alert("error", {
                        msg : "Unable to add options to the cart. Please try again later!!!"
                    });
                }
            })
        } else {
            var data = {'title': 'information', 'page': ''};
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
                    }
                }
            });
            $("#txt_"+identity).focus()
        }
    });
    $(".removeoption").click(function() {
        var identity = $(this).data("know");
        var q        = $("#txt_"+identity).val();
        if (q.length > 0) {
            var data = {'title': 'quest', 'page': 'delete-this-option'};
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
                        $('#i-question').show();
                        $('#i-inform').hide();
                        $('#modal2-confirm').show();
                        $('#modal2-no').show();
                        $('#modal2-ok').hide();
                        $('#modal2-confirm').on("click", function () {
                            $.ajax({
                                url: window.location.protocol + "//" + window.location.hostname + "/removeoptions",
                                data: {
                                    "_token": $("[name=_token]").val(),
                                    "identity": identity
                                },
                                method: "POST",
                                dataType: "json",
                                beforeSend: function () {
                                    $('body').loadingModal({text: 'Please Wait...'});
                                },
                                complete: function () {
                                    $('body').loadingModal('destroy');
                                },
                                success: function (res) {
                                    $('#modalheader2').text(res.status_translate);
                                    $('#modaltext2').text(res.message);
                                    $('#myModal2').modal('show');
                                    $('#i-question').hide();
                                    $('#i-inform').show();
                                    $('#modal2-confirm').hide();
                                    $('#modal2-no').hide();
                                    $('#modal2-ok').show();

                                    $('#myModal2').on('hidden.bs.modal', function () {
                                        window.location.href = window.location.href;
                                    });
                                },
                                error: function (er) {
                                    Lobibox.alert("error", {
                                        msg: "Unable to Remove option from the cart. Please try again later!!!"
                                    });
                                }
                            });
                        });
                    }
                }
            });
        }
    });
});