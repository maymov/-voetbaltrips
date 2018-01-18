$(document).ready(function(){
	$("#country_id").on("change", function(){
        var formdata = $.param({"country_id" : this.value, "_token" : $("[name='_token']").val()});
        $.ajax({
            url : window.location.protocol + "//" + window.location.hostname+"/ajax/loadcities",
            method : "POST",
            dataType : "json",
            data     : formdata,
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
});