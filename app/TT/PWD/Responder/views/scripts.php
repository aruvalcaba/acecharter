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

    $("#change_password").click(function() {
        
		var oldPassword = $("#old_password").val();
        var password = $("#password").val();
        var password_confirm = $("#password_confirmation").val();
        
        
        
        var dataString = 'old_password='+oldPassword+
                         '&password='+password+
						 '&password_confirmation='+password_confirm;

        $.ajax({
                url: "/pwd/change",
                type: "post",
                data: dataString,
                dataType: "json",
                processData: false,
                success: function(data)
                {   
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
