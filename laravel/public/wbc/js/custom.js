// ログインパスワードのmd5化
$("#siireuser_passwd_bemd5").on("input", function() {
    var input = $(this).val();
    var md5 = $.md5(input);
    $("#siireuser_passwd").attr("value", md5);
}).on('keypress', function(event) {
    if (event.which === 13) {
        $('#login-btn').click();
    }
});

$("#siireuser_id_besend").on("input", function() {
    var input2 = $(this).val();
    $("#siireuser_id").attr("value", input2);
}).on('keypress', function(event) {
    if (event.which === 13) {
        $('#login-btn').click();
    }
});

$("#user_passwd_bemd5").on("input", function() {
    var input3 = $(this).val();
    var md5 = $.md5(input3);
    $("#user_passwd").attr("value", md5);
}).on('keypress', function(event) {
    if (event.which === 13) {
        $('#login-btn').click();
    }
});

$("#user_id_besend").on("input", function() {
    var input4 = $(this).val();
    $("#user_id").attr("value", input4);
}).on('keypress', function(event) {
    if (event.which === 13) {
        $('#login-btn').click();
    }
});

// bootstrap tooltip
$('[data-toggle="tooltip"]').tooltip()
