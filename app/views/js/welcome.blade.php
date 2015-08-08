<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.1/jquery.scrollTo.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="https://s3.amazonaws.com/teachtogether.co/assets/js/custom.js"></script>
<script>

$("#invite_submit").click(function()
{
    var email = $("#invite_email").val();
    var dataString = 'email='+email;

    $.ajax({
                url: "/invite",
                type: "post",
                data: dataString,
                processData: false,
                success: function(data)
                {
                    window.location.href = "/";
                },
                error: function(x,status,error) 
                {
                    alert('Oops something went wrong on the server. Contact the admin.');
                }
        });

});

</script>
