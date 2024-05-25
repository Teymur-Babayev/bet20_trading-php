// setInterval(function () {  
//     $.ajax({
//         url: "refresh.php",
//         success: function (data) {
//             if (data === "1") {
//                 // $("#liveContent").load('contact.php');
//                 $("#upcomingContent").load('upcomingMatch.php');
//             }
//         }  
//     });
// }, 2000);

$(document).ready(function () {
    $.ajax({
        url: "refresh.php",
        success: function (data) {
            if (data === "1") {
                $("#liveContent").load('liveContent.php');
                $("#upcomingContent").load('upcomingMatch.php');
            }
        }
    });
});
$("#all").on("click", function () {

    $("#liveContent").load('contact.php');
    $("#upcomingContent").load('upcomingMatch.php');
});
$("#football").on("click", function () {

    $("#liveContent").load('football.php');
     $("#upcomingContent").load('upcomingFootball.php');
});
$("#cricket").on("click", function () {

    $("#liveContent").load('cricket.php');
     $("#upcomingContent").load('upcomingCricket.php');
});
$("#basketball").on("click", function () {

    $("#liveContent").load('basketball.php');
   $("#upcomingContent").load('upcomingBasket.php');
});