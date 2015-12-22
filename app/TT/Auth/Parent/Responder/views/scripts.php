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
    
    //Shitty hack for dialogs to not automatically obtain focus
    $.ui.dialog.prototype._focusTabbable = $.noop;    

    $('#studentSignUpModal').on('show.bs.modal', function () {
        $('.modal .modal-body').css('overflow-y', 'auto'); 
        $('.modal .modal-body').css('height', $(window).height() * 0.7);
    });

	

    $("#reset_password").click(function() {
        var email = $("#forgotPasswordModal #email").val();

        if( !$.trim(email).length ) {
            var dialog = $('<div></div>').dialog({modal:true, height:'auto',title:'Alert',buttons: { Ok: function() { dialog.dialog('close'); }}});
                        
                        dialog.html("<?php echo $data['validation_email']['val'] ?>");
                        dialog.dialog('open');
            return;
        }
        
        var dataString = 'email='+email;

        $.ajax({
                url: "/pwd/reset",
                type: "post",
                data: dataString,
                dataType: "json",
                processData: false,
                success: function(data)
                {  
					$('#forgotPasswordModal').modal('hide');
					$('#forgotPasswordSuccessModal').modal('show');
				},
                error: function(xhr,status,error) {
                    var data = $.parseJSON(xhr.responseText);
                    var messages = data.messages;
                    var message;

                    if( messages != undefined ) {
                        
                        message = messages[0];
                        
						$('#forgotPasswordModal').modal('hide');

                        var dialog = $('<div></div>').dialog({modal:true,height:'auto',title:'Alert',buttons: { Ok: function() { dialog.dialog('close'); }}});
                        dialog.html(message);
                        dialog.dialog('open');
                    }
                }
        });

    });    

    $("#login").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
        
        if( !$.trim(email).length || !$.trim(password).length ) {
            var dialog = $('<div></div>').dialog({modal:true,height:'auto',title:'Alert',buttons: { Ok: function() { dialog.dialog('close'); }}});
                        dialog.html("<?php echo $data['validation_email_password']['val'] ?>");
                        dialog.dialog('open');
            return;
        }

        var dataString = 'email='+email+
                         '&password='+password;
        
        $.ajax({
                url: "/parent/login",
                type: "post",
                data: dataString,
                dataType: "json",
                processData: false,
                success: function(data) {           
                    window.location.href = '/parent/home';
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

    $("#student_signup").click(function(){
        
        $('#signup_errors').empty();
        $("#signup_alert").addClass('hidden');
    
        var parentFullName = $("#parent_fullname").val();
        var studentFullName = $("#student_fullname").val();
        var email = $("#signupModal #email").val();
        var code = $("#student_code").val();
        var relation = $("#relationship").val();

        var dataString = 'parent_fullname='+parentFullName+
                         '&student_fullname='+studentFullName+
                         '&email='+email+
                         '&student_code='+code+
                         '&relationship='+relation;
        $.ajax({
                url: "/parent",
                type: "post",
                data: dataString,
                dataType: "json",
                processData: false,
                success: function(data)
                {   
                    $('#signupModal').modal('hide');
                    $('#signupSuccessModal').modal('show');

                },
                error: function(xhr,status,error) {
                    var data = $.parseJSON(xhr.responseText);
                    var messages = data.messages;
                    var message;

                    if( messages != undefined ) {
                        
                        message = messages[0];
                        
						//$('#signupModal').modal('hide');

                        var dialog = $('<div></div>').dialog({modal:true,height:'auto', title:'Alert',buttons: { Ok: function() { dialog.dialog('close'); }}});
                        dialog.html(message);
						dialog.dialog('open');
                    }
                }
        });
    });
</script>
