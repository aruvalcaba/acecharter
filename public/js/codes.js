$("#print_codes").click(function() {
        var count = $("#student_count").val();

        var dataString = 'count='+count;

        $.ajax({
                url: "/print-codes",
                type: "post",
                data: dataString,
                processData: false,
                success: function(data) {

                    var response = $.parseJSON(data);
                    var path = response.path;

                    if( path !== undefined ) {
                        window.location.href = path;
                    }
                },
                error: function(x,status,error) {
                    if( x.status == 403 )
                        window.location.href = '/login';
                    else
                        alert('Oops something went wrong on the server. Contact the admin.');
                }
        });
});
