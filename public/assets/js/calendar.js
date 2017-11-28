
        $(document).ready(function() {

            $( "#add-new-event" ).click(function() {    
                var name = $('#name').val();
                var decription = $('#description').val();
                var deadLine = $('#deadLine').val();
                formdata   = $("#taskForm").serialize();

                    $.ajax({
                        url      : "task/create",
                        method   : "POST",
                        dataType : "json",
                        data     : formdata,
                        error : function(resp){
                            console.log(resp);
                        },
                        success  : function (resp) { 
                            alert("Task: "+ resp.task_name+" has been created successfully at "+resp.task_deadline);
                            var event =
                                {
                                    title: resp.task_name,
                                    start: resp.task_deadline,
                                    url: '/admin/task/'+resp.id,
                                    backgroundColor: "#418BCA"
                                };
                             $('#calendar').fullCalendar( 'renderEvent', event ,[true] )
                            console.log(resp)
                        }
                    });
            });
        });