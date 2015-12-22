<?php
    $helper->scripts()->add('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
    $helper->scripts()->add('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js');
	    
    echo $helper->scripts();
?>
<script>
	$("#daily_attendance").click(function(){
		 $('#dailyAttendnceModal').modal('show');
	});
        
	$("#behavior").click(function(){
		 $('#behaviorModal').modal('show');
	});

	$("#daily_homework").click(function(){
		 $('#dailyHomeworkModal').modal('show');
	});
        
	$("#academic_success").click(function(){
		 $('#academicSuccessModal').modal('show');
	});


</script>
