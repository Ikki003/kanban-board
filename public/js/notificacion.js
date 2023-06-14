
function acceptRequest(este) {

    let url = $("#accept_request").val();
    let token = $("#accept_request_token").val();
    let data = $("[name=notification_data]").val();

    $.ajax({
        type: "POST",
        url: url,
        data: {
            '_token': token,
            'data': data,
        },
        success: function(data){
        
            if(data['ok'] == true) {
                location.reload();
            }

        },
    });
}