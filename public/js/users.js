$(document).ready(function () {
    $('#pm').click(function () {
        /*private message mode */
        token = $('#private').val();
        $.ajax({
            url: "/chatapp/chatroom/private",
            method: "POST",
            data:{token:token, action:'private'},
            success: function(data) {
                var response = JSON.parse(data);
                if (response.status == 1) {
                    location = 'privatechat'; 
                }
            }
        })
    });
});
