$(document).ready(function(){
    $("form#formCsvUpload").submit(function(){
        var formData = new FormData($(this)[0]);
        $.ajax({
            url          : 'countries/importcsv',  //server script to process data
            type         : 'POST',
            data         : formData,
            dataType     : "json",
            cache        : false,
            contentType  : false,
            processData  : false,
            headers      : {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            success      : function(resp){
                alert(resp.message);
                if(resp.status == "success") {
                    $("#closemodel").trigger("click");
                    window.location.href = window.location.href;
                }
            }
        });
        return false;
    });
});