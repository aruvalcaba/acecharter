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
                        $("#forgotPasswordModal").modal('hide');
                        dialog.html("<?php echo $h('Please fill in email') ?>");
                        dialog.dialog('open');
            return;
        }
        
        var dataString = 'email='+email;

        $.ajax({
                url: "pwd/reset",
                type: "post",
                data: dataString,
                dataType: "json",
                processData: false,
                success: function(data)
                {   
                    var success = data.success;

                    if( success == 1)
                    {
                        $('#forgotPasswordModal').modal('hide');
                        $('#forgotPasswordSuccessModal').modal('show');
                    }

                    else
                    {
                        $("#forgotPasswordModal #errorText").html('Wrong email or email does not exist.');
                        $("#forgotPasswordModal #errorText").parent().removeClass('hidden');
                    }
                },
                error: function(data) 
                {
                    alert('Oops something went went on the server. Contact the admin.');
                }
        });

    });    

    $("#login").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
        
        if( !$.trim(email).length || !$.trim(password).length ) {
            var dialog = $('<div></div>').dialog({modal:true,height:'auto',title:'Alert',buttons: { Ok: function() { dialog.dialog('close'); }}});
                        dialog.html("<?php echo $h('Please fill in email and password') ?>");
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
                        if( $.isArray(messages[0]) ) {
                            message = messages[0][0];
                        }

                        else {
                            message = messages[0];
                        }

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
                url: "parent",
                type: "post",
                data: dataString,
                dataType: "json",
                processData: false,
                success: function(data)
                {   
                    var success = data.success;

                    if( success == 1)
                    {
                        $('#signupModal').modal('hide');
                        $('#signupSuccessModal').modal('show');
                    }

                    else
                    {
                        var errors = data.errors;
                        
                        if(errors)
                        {
                            $.each(errors, function(key, value)
                            {
                                $('#signup_errors').append('<li>'+value+'</li>');
                            });

                            $("#signup_alert").removeClass('hidden');
                        }
                    }
                },
                error: function(data) 
                {
                    alert('Oops something went went on the server. Contact the admin.');
                }
        });
    });
</script>
