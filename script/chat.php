<?php include './header.php'; ?>
<?php include './side.php'; ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> Chat Box</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <?php
                if (isset($_GET['userName'])) {
                    $userId = $_GET['userName'];

                    $query = "DELETE FROM `admin_notify` WHERE userId='$userId'";
                    $db->delete($query);
                    ?>
                 <a href="../index.php?adminVisit=<?php echo $userId; ?>" target="_blank" class="btn btn-success btn-sm">visit to user account</a>
                    <h3 class="tile-title"><?php echo $userId; ?></h3>  
                   

                    <input id="userId" type="hidden" value="<?php echo $userId; ?>">

                    <div class="messanger" >
                        <div id="messanger" class="messages">
                            <div  id="messages">
                                <?php
                                $query = "SELECT * FROM `chat` where userId='$userId'";
                                $resulMsg = $db->select($query);
                                if ($resulMsg) {
                                    foreach ($resulMsg as $msg) {
                                        if ($msg['admin'] == 1) {
                                            ?>
                                            <div class="message me"><img width="50px" src="../img/user.png">
                                                <p class="info"><?php echo $msg['msg'] ?></p>
                                            </div>
                                            <?php
                                        } else {
                                            ?>

                                            <div class="message "><img width="50px" src="../img/user.png">
                                                <p class="info"><?php echo $msg['msg'] ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="sender">
                            <form action="chatSend.php" method="post">
                               <input name="userId" type="hidden" value="<?php echo $userId; ?>">
                                <input name="msgSend" type="text" placeholder="Send Message">
                                <button name="sendChat"  id="send" class="btn btn-primary" type="submit"><i class="fa fa-lg fa-fw fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>
</main>

<!-- The javascript plugin to display page loading on top-->
<?php include './footer.php'; ?>
<script type="text/javascript" src="js/notification.js"></script>
<script>

    function scrollToBottom() {
        var messages = document.getElementById('messanger');
        messages.scrollTop = messages.scrollHeight;
    }
   /* $("#send").on("click", function () {

        scrollToBottom();
        var msgSend = $("#msgSend").val();
        var userId = $("#userId").val();
        $.ajax({
            method: "POST",
            url: "chatSend.php",
            data: {
                msgSend: msgSend,
                userId: userId
            },
            success: function (data) {

                if (data !== "") {
                    alert(data);
                } else {
                    $("#msgSend").val('');
                }
                location.reload();
            }
        });



    });*/



  /*  function chatList( )
    {

        var userId = $("#userId").val();
        alert(userId);
        $.ajax({
            method: "POST",
            url: "chatList.php",
            dataType: "text",
            data: {
                userId: userId
            },
            success: function (data)
            {
                alert(data);

                $('#messages').html(data);

            }
        });
    }*/
    //chatList();

    scrollToBottom();


   /* setInterval(function () {
        // chatList();
        //scrollToBottom();
    }, 1000);*/


</script>

</body>
</html>