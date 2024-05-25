$("#depositSubmit").on("click", function () {

    var dAmount = $("#dAmount").val();
    var dMethodt = $("#dMethodt").val();
    var dFrom = $("#dFrom").val();
    var dReference = $("#dReference").val();
    var dTo = $("#dTo").val();

    $.ajax({
        method: "POST",
        url: "placeBet.php",
        data: {
            dAmount: dAmount,
            dMethodt: dMethodt,
            dFrom: dFrom,
            dReference: dReference,
            dTo: dTo
        },
        success: function (data) {

            if (data !== "") {

                $("#errorDeposit").removeClass("errorDeposit");
                $("#errorDepositText").text(data);

            } else {
                $("#deposit").hide();
                location.reload();
            }
        }
    });

});
$("#withdrawSubmit").on("click", function () {

    var wAmount = $("#wAmount").val();
    var wMethod = $("#wMethod").val();
    var wType = $("#wType").val();
    var wTo = $("#wTo").val();
        var wPassword = $("#wPassword").val();

    $.ajax({
        method: "POST",
        url: "placeBet.php",
        data: {
            wAmount: wAmount,
            wMethod: wMethod,
            wType: wType,
            wTo: wTo,
              wPassword: wPassword
        },
        success: function (data) {

            if (data !== "") {


                $("#errorWithraw").removeClass("errorWithraw");
                $("#errorWithrawText").text(data);

            } else {
                $("#withdraw").hide();
                location.reload();
            }
        }
    });

});

//club
$("#withdrawSubmit-c").on("click", function () {

    var wAmount = $("#wAmount-c").val();
    var password = $("#password-c").val();


    $.ajax({
        method: "POST",
        url: "placeBet.php",
        data: {
            wAmount: wAmount,
            password: password
         
        },
        success: function (data) {

            if (data !== "") {


                $("#errorWithraw").removeClass("errorWithraw");
                $("#errorWithrawText").text(data);

            } else {
                $("#withdraw").hide();
                location.reload();
            }
        }
    });

});
$("#balanceTransferSubmit").on("click", function () {


    var transferAmount = $("#transferAmount").val();
    var to_userId = $("#to_userId").val();
    var notes = $("#notes").val();
     var transferPassword = $("#transferPassword").val();
    
    $.ajax({
        method: "POST",
        url: "placeBet.php",
        data: {
            transferAmount: transferAmount,
            to_userId: to_userId,
            notes: notes,
            transferPassword:transferPassword

        },
        success: function (data) {

            if (data !== "") {


                $("#errorBalanceTransfer").removeClass("errorBalanceTransfer");
                $("#balanceTransferText").text(data);

            } else {
                $("#balanceTransfer").hide();
                location.reload();
            }
        }
    });

});
$("#changePasswordSubmit").on("click", function () {


    var currentPassword = $("#currentPassword").val();
    var newPassword = $("#newPassword").val();
    var confirmPassword=$("#confirmPasswordAgain").val();
        $.ajax({
            method: "POST",
            url: "placeBet.php",
            data: {
                currentPassword: currentPassword,
                newPassword: newPassword,
                confirmPassword:confirmPassword
            },
            success: function (data) {

                if (data !== "") {
                    $("#errorChangePassword").removeClass("errorChangePassword");
                    $("#errorChangePasswordText").text(data);

                } else {
                    $("#changePassword").hide();
                    location.reload();
                }
            }
        });


});

$("#changeClubSubmit").on("click", function () {


    var cClub = $("#cClub").val();
    var PasswordClubChange = $("#PasswordClubChange").val();

        $.ajax({
            method: "POST",
            url: "placeBet.php",
            data: {
                cClub: cClub,
                PasswordClubChange: PasswordClubChange
              
            },
            success: function (data) {

                if (data !== "") {
                    $("#errorchangeClub").removeClass("errorchangeClub");
                    $("#errorchangeClubText").text(data);

                } else {
                    $("#changeClub").hide();
                    location.reload();
                }
            }
        });


});