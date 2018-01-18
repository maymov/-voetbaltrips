$(document).ready(function(){

    var getCities = function(dat){
        var country = $("#country").val();
        var formdata = $.param({"country_id" : country, "_token" : $("[name='_token']").val()});
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
    };

	$("#country").on("change", function(){
        getCities();
    });
    /**
     * When the user simply refresh the window after select the country then the city drop down will be empty
     * so checking that if already any country is selected then fill the city field
     */
    var country   = $("#country").val();
    var citycount = $('#city').val();
    if(country !="" && citycount == "") {
        getCities();
    }
});