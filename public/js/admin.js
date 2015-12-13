function destroy(id,entity,name)
{
    var token = $(this).data('token');
    if ( confirm("Delete "+name+"?") )
    {
        $.ajax({
                type:"post",
                url: '/'+entity+'/'+id,
                data: {_method: 'delete',_token:token},
                success: function()
                {
                    window.location.href = '/admin/home';
                },
                error: function()
                {
                    alert('Oops something went wrong on the server. Contact the admin.');
                }
                
            });
    }
}
