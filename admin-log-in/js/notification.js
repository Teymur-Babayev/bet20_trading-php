
$(document).ready(function () {

    function load_unseen_notification( )
    {

        $.ajax({
            url: "fetchNotification.php",
            method: "POST",
            success: function (data)
            {

                if (data.count > 0)
                {
                    $('#count').html(data.count);
                    $('#notificationList').html(data.list);
                }
            }
        });
    }
    load_unseen_notification();




    setInterval(function () {
        load_unseen_notification();
        
    }, 100000);

});


$(document).ready(function () {

    function load_unseen_notif( )
    {
 
        $.ajax({
            url: "fetchChat.php",
            method: "POST",
            success: function (data)
            {

                if (data.countChat > 0)
                {
                    $('#countChat').html(data.countChat);
                    $('#chatNotificationList').html(data.list);
                }
            }
        });
    }
    load_unseen_notif();




    setInterval(function () {
        load_unseen_notif();
        
    }, 100000);

});

$(document).ready(function () {

    function load_unseen_notifClub( )
    {
    

        $.ajax({
            url: "fetchChatOfClub.php",
            method: "POST",
            success: function (data)
            {

                if (data.countChat > 0)
                {
                    $('#countChatofClub').html(data.countChat);
                    $('#chatNotificationListOfClub').html(data.list);
                }
            }
        });
    }
    load_unseen_notifClub();




    setInterval(function () {
        load_unseen_notifClub();
        
    }, 100000);

});