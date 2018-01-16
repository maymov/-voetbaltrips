$(document).ready(function(){
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
    });
    $(".form_passport_date").datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $("#country").on("change", function(){
        var formdata = $.param({"country_id" : this.value, "_token" : $("[name='_token']").val()});
        $.ajax({
            url : window.location.protocol + "//" + window.location.hostname+"/ajax/loadcities",
            method : "POST",
            dataType : "json",
            data     : formdata,
            beforeSend : function () {
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete : function () {
                $('body').loadingModal('destroy');
            },
            success  : function(resp) {
                var cityoptions = "<option value='' disabled selected>Pick a City</option>option>";
                if(resp.cities.length > 0) {
                    $.each(resp.cities, function (index, value) {
                        cityoptions = cityoptions + "<option value='" + value.id + "'>" + value.name +"</option>";
                    });
                }
                $("#city").html(cityoptions);
            }
        });
    });
    $("#change_data").change(function(){
        if(this.value == "") {
            $('#formtravelinfo')[0].reset();
        } else {
            $.ajax({
               url : window.location.protocol+"//"+window.location.hostname+"/order/gettravellerinfo",
                method     : "POST",
                dataType   : "json",
                data       : {"identifier":this.value, "_token": $("input[name='_token']").val()},
                beforeSend : function () {
                    $('body').loadingModal({text: 'Please Wait...'});
                },
                complete : function () {
                    $('body').loadingModal('destroy');
                },
                success : function (resp) {
                    if(resp.status == "success") {
                        $("#traveller_first_name").val(resp.first_name);
                        $("#traveller_last_name").val(resp.last_name);
                        $("#gender option[value='"+resp.gender+"']").attr("selected", true);
                        $("#birth").val(resp.dob);
                        $("#aaa").val(resp.dob);
                        $("#phone").val(resp.phone_number);
                        $("#email").val(resp.email);
                        $("#traveller_country").val(resp.country);
                        $("#traveller_city").val(resp.city);
                        $("#traveller_address").val(resp.address);
                        $("#traveller_postcode").val(resp.postcode);
                        $("#dob_show").val(resp.dob_show);
                    } else {
                        Lobibox.alert("error", {
                            msg : resp.message,
                        });
                    }
                },
                error : function () {
                    Lobibox.alert("error", {
                        msg : "Something went wrong. Please try again later!!!",
                    });
                }
            });
        }
    });
    $("#formtravelinfo").on('submit',(function(e) {
        e.preventDefault();
        console.log(this);
        if($("#change_data").val() != "") {
            var formdata = $("#formtravelinfo").serialize();
            $.ajax({
                url      : window.location.protocol+"//"+window.location.hostname+"/order/updatetravellerinfo",
                method   : "POST",
                dataType : "json",
                contentType: false,
                cache: false,
                processData:false,
                data     : new FormData(this),
                beforeSend : function () {
                    $('body').loadingModal({text: 'Please Wait...'});
                },
                complete   : function () {
                    $('body').loadingModal('destroy');
                },
                success : function (resp) {
                    Lobibox.alert(resp.status, {
                        msg : resp.message
                    });
                    if(resp.status == "success") {
                        window.location.href = window.location.href;
                    }
                },
                error : function () {
                    Lobibox.alert("error", {
                        msg : "Something went wrong. Please try again later!!!"
                    });
                }
            });
        }
    }));
    /*$("#update").click(function () {
        if($("#change_data").val() != "") {
            var formdata = $("#formtravelinfo").serialize();
            formdata = formdata+'&passport_document='+$('#passport_document')[0].files[0];
            $.ajax({
                url      : window.location.protocol+"//"+window.location.hostname+"/order/updatetravellerinfo",
                method   : "POST",
                dataType : "json",
                data     : formdata,
                beforeSend : function () {
                    $('body').loadingModal({text: 'Please Wait...'});
                },
                complete   : function () {
                    $('body').loadingModal('destroy');
                },
                success : function (resp) {
                    console.log(resp);
                    Lobibox.alert(resp.status, {
                            msg : resp.message
                        });
                },
                error : function () {
                    Lobibox.alert("error", {
                        msg : "Something went wrong. Please try again later!!!"
                    });
                }
            });
        }
    });*/
});