
function show_ajax_message(mes) {
    $("#ajax_message").html(mes);
    setTimeout(function () {
        $("#ajax_message").html("");
    }, 5000);
}
