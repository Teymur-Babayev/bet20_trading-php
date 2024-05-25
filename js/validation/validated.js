$("#userId").keyup(function () {
    var userId = $(this).val();
    $.ajax({
        method: "POST",
        url: "signUpValidation.php",
        dataType: 'text',
        data: {userId: userId},
        success: function (data) {
            $("#userIdError").html(data);

        }
    });

});

$("#sponsor").blur(function () {
    var sponsor = $(this).val();
    var club = $("#club").val();
    if (sponsor !== '') {


        $.ajax({
            method: "POST",
            url: "signUpValidation.php",
            dataType: 'text',
            data: {sponsor: sponsor, club: club},
            success: function (data) {
                $("#sponsorError").html(data);

            }
        });

    }

});

$("#mobileNumber").keyup(function () {
    var Number = $(this).val();

    var IndNum = /^[0]?(1)[56789]\d{8}$/;

    if (IndNum.test(Number)) {
        $('#mobileError').text('');
    }
    else {
        $('#mobileError').text('please enter valid mobile number');
    }

});
$("#userSignUp").on("click", function () {
    var userId = $("#userId").val();
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var club = $("#club").val();
    var mobileNumber = $("#mobileNumber").val();
    var sponsor = $("#sponsor").val();
      var confirmPassword = $("#confirmPassword").val();
    
    $.ajax({
        method: "POST",
        url: "userSignUp.php",
        data: {name: name, userId: userId, email: email,
            password: password,confirmPassword:confirmPassword, mobileNumber: mobileNumber, sponsor: sponsor, club: club},
        success: function (data) {

            if (data!== "") {
                $("#error").removeClass("error");
                $("#signuperrorText").text(data);
            } else {
                $("#SignUp").hide();
                location.reload();
            }




        }
    });



});
$("#userSignInForm").on("click", function () {

    var userIdOfuser = $("#userIdOfuser").val();
    var passwordOfuser = $("#passwordOfuser").val();

    $.ajax({
        method: "POST",
        url: "userLogin.php",
        data: {userId: userIdOfuser,
            password: passwordOfuser},
        success: function (data) {
         
            if (data === "no") {
                $("#errorSignIn").removeClass("errorSignIn");
            } else {
                $("#SignIn").hide();
                location.reload();
            }




        }
    });



});

