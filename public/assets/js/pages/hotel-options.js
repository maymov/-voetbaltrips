$('#option_select').on('change', function (){
    var str = $('#option_select option:selected').text();
    $('#options').tagsinput('add', str);
});
