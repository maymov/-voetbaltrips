$(document).ready(function(){
   $("form#formCsvUpload").submit(function(){
        var formData = new FormData($(this)[0]);
        $.ajax({
            url          : 'flights/importmatches',  //server script to process data
            type         : 'POST',
            data         : formData,
            dataType     : "json",
            cache        : false,
            contentType  : false,
            processData  : false,
            headers      : {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            },
            beforeSend   : function(){
                $('body').loadingModal({
                    position: 'auto',
                    text: 'Please Wait...',
                    color: '#fff',
                    opacity: '0.7',
                    backgroundColor: 'rgb(0,0,0)',
                    animation: 'doubleBounce'
                });
            },
            complete     : function () {
                $('body').loadingModal('destroy');
            },
            success      : function(resp){

                if(resp.status == "success") {
                    $("#closemodel").trigger("click");
                    Lobibox.alert(resp.status,
                        {
                            title : "Matches CSV Upload",
                            msg: resp.message,
                            beforeClose : function ($this) {
                                window.location.href = window.location.href;
                            }
                        });

                } else {
                    Lobibox.notify(resp.status, {
                        /*title     : 'Voetbaltrips',*/
                        showClass : 'fadeInDown',
                        hideClass : 'fadeUpDown',
                        msg       : resp.message,
                        delay     : 15000
                    });
                }
            }
        });
        return false;
    });
});