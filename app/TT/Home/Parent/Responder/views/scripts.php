<?php
    $helper->scripts()->add('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
    $helper->scripts()->add('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js');
	$helper->scripts()->add('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js');
    $helper->scripts()->add('https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.1/jquery.scrollTo.min.js');
    $helper->scripts()->add('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js');
    $helper->scripts()->add('https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js');	    
    echo $helper->scripts();
?>
<script>

	$('#addChildModal').on('show.bs.modal', function () {
        $('.modal .modal-body').css('overflow-y', 'auto'); 
        $('.modal .modal-body').css('height', $(window).height() * 0.7);
    });

	
    
	$("#daily_homework").click(function(){
		 $('#dailyHomeworkModal').modal('show');
	});

	$("#daily_attendance").click(function(){
		 $('#dailyAttendnceModal').modal('show');
	});
        
	$("#behavior").click(function(){
		 $('#behaviorModal').modal('show');
	});	
        
	$("#academic_success").click(function(){
		 $('#academicSuccessModal').modal('show');
	});

	$("#add_child").click(function(){
        
        $('#addChild_errors').empty();
        $("#addChild_alert").addClass('hidden');
    
        var code = $("#student_code").val();
        

        var dataString = 'student_code='+code;
        $.ajax({
                url: "/addchild",
                type: "post",
                data: dataString,
                dataType: "json",
                processData: false,
                success: function(data)
                {   
                    $('#addChildModal').modal('hide'); 
					var messages = data.messages;
                    var message;
					message = messages[0];                        

                	var dialog = $('<div></div>').dialog({modal:true,height:'auto',title:'Alert',buttons: { Ok: function() { window.location.href = '/home'; }}});
                    dialog.html(message);
                    dialog.dialog('open');  
					                

                },
                error: function(xhr,status,error) {
                    var data = $.parseJSON(xhr.responseText);
                    var messages = data.messages;
                    var message;

                    if( messages != undefined ) {
                        
                        message = messages[0];                        
						
 						var dialog = $('<div></div>').dialog({modal:true,height:'auto',title:'Alert',buttons: { Ok: function() { dialog.dialog('close'); }}});
                        dialog.html(message);
                        dialog.dialog('open'); 
	                  }
                }
        });
    });




</script>
