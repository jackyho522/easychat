$(document).ready(function () {

    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function (e) {
        console.log("Connection established!"); /* Start connection */
    };

    conn.onmessage = function (e) {
        console.log(e.data);
        /* the messages are fetched here */
        /* parse it into JSON and called it by data.msg */
        var data = JSON.parse(e.data);
        var row_class = '';
        var bg_class = '';
        if (data.from == 'Me') {
            row_class = 'row justify-content-start';
            bg_class = 'text-dark alert-primary';
        } else {
            row_class = 'row justify-content-end';
            bg_class = 'alert-success';
        }
        var htmldata = "<div class='"
            + row_class
            + "'><div class='col-sm-10'><div class='alert "
            + bg_class + "'><b>"
            + data.from
            + ": </b>"
            + data.msg
            + "<br><div class='text-right'><i><small class='text-muted'>"
            + data.dt
            + "</small></i></div></div></div></div>";
        $('#msg_area').append(htmldata);
        $("#chat_msg").val("");
    };

    $('#chat_form').parsley(); /* initialize parsley form validation */
    $('#chat_form').on('submit', function (event) { /* send chat form, when submitted, this block of code will be executed */
        event.preventDefault(); /* stop refresh the web page */
        if ($('#chat_form').parsley().isValid()) {  /* if parsley is invalid */
            var user_id = $('#login_id').val();
            var message = $('#chat_msg').val();
            var data = {
                uuid: user_id,
                msg: message,
                command: 'public'
            };
            conn.send(JSON.stringify(data)); /* send the json string */
        }
    });

    /*send ajax request close connection and logout */
    $('#logout').click(function () {
        user_id = $('#login_id').val();
        $.ajax({
            url: "/chatapp/login/leave", /* leave function in controller, change status */
            method: "POST",
            data: { user_id: user_id, action: 'leave' },
            success: function (data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response.status == 1) {
                    conn.close();
                    location = 'home';
                }
            }
        })
    });
});