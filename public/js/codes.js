$("#print_codes").click(function() {
        $.ajax({
                url: "/print/codes",
                success: function(data) {

                    var response = $.parseJSON(data);
                    var path = response.path;

                    if( path !== undefined ) {
                        window.location.href = path;
                    }
                },
                error: function(x,status,error) {
                    if( x.status == 403 )
                        window.location.href = '/teacher/login';
                    else if( x.status == 406 ) {
                        var data = $.parseJSON(x.responseText);
                        var messages = data.messages;

                        var message = messages[0];

                        alert(message);
                    }
                    else
                        alert('Oops something went wrong on the server. Contact the admin.');
                }
        });
});
