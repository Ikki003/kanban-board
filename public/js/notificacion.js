
function manageRequest(notification, mode) {

    let url = $("#manage_request").val();
    let token = $("#manage_request_token").val();

    $.ajax({
        type: "POST",
        url: url,
        data: {
            '_token': token,
            'data': notification,
            'mode':mode
        },
        success: function(data){

            if(data['mode'] == 'decline') {
                setTimeout(function() {
                    $("#alert2").removeClass('hidden');
                    $("#message1").texy(data['message']);
                }, 4000);
                
            }

            location.reload();

        },
    });
}

$("[name=filter_state]").click((event) => {
    let value = $(event.target).data('id');
    $("[name=filter_state_input]").val(value);
    $form = $("#search_notification");
    $form.submit();
}) 