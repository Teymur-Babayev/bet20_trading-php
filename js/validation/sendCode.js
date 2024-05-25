$(".wDraw").on("click", function () {
    var id = $(this).attr('id');
    $(".showCategoryId").attr({
        'id': id
    });

});
$(".Btrans").on("click", function () {
    var id = $(this).attr('id');
    $(".showCategoryId").attr({
        'id': id
    });

});
$("#sendCode").on("click", function () {
    //alert('ok');
    $(this).text('sending...');
    var sendCode = 1;
    $.ajax({
        method: "POST",
        url: "placeBet.php",
        data: {
            sendCode: sendCode

        },
        success: function (data) {

            if (data == "") {

                $("#confirmCode").show();

                $('#sendCode').text('Send code');
            } else {
                $("#codeError").show();
                $("#codeError").text(data);
                $('#sendCode').text('Send code');
            }
        }
    });
    /*  setTimeout(
     function () {
     
     },1);*/
});

$("#confirmCode").on("click", function () {
    var code = $("#Vcode").val();
    var id = $(".showCategoryId").attr('id');

    var confirmCode = 1;
    $.ajax({
        method: "POST",
        url: "placeBet.php",
        data: {
            confirmCode: confirmCode,
            code: code

        },
        success: function (data) {

            if (data == "") {

                //$("#verifySubmit").show();
                if (id == 1) {
                    $("#numberVerify").modal('hide');
                    $("#withdraw").modal('show');
                } else {
                    $("#numberVerify").modal('hide');
                    $("#balanceTransfer").modal('show');
                }



            } else {
                $("#codeError").show();
                $("#codeError").text(data);
            }
        }
    });
    /*  setTimeout(
     function () {
     
     },1);*/
});