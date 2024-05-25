<link rel="stylesheet" href="css/chatBoxStyle.css">
<div class="main-section">
    <div class="row border-chat">
        <div class="col-md-12 col-sm-12 col-xs-12 first-section">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-6 left-first-section">
                    <p>Chat<span id="notify" class="badge" style="background:#DD5145; "></span></p>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-6 right-first-section">
                    <a href="#"><i class="fa fa-minus" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-clone" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-chat">
        <div class="col-md-12 col-sm-12 col-xs-12 second-section">
            <div class="chat-section" id="mh">
                <ul id="messages">

                </ul>
            </div>
        </div>
    </div>
    <div class="row border-chat">
        <div class="col-md-12 col-sm-12 col-xs-12 third-section">
            <div class="text-bar">
                <input autofocus="1" id="msgSend" type="text" placeholder="Write messege"><a style="cursor: pointer"  id="send"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".left-first-section").click(function () {
            $('.main-section').toggleClass("open-more");
        });
    });
    $(document).ready(function () {
        $(".fa-minus").click(function () {
            $('.main-section').toggleClass("open-more");
        });
    });
    function scrollToBottom() {
        var messages = document.getElementById('mh');
        messages.scrollTop = messages.scrollHeight;
    }


   $(document).ready(function () {
    function fetchChat() {
        $.ajax({
            url: "messageFetch.php",
         dataType: 'json',
            success: function (data) {

                $("#messages").html(data.inbox);
                $("#notify").html(data.msgCount);
            }
        });
        //  fetchChat();
        //   scrollToBottom();

        setTimeout(function () {
            fetchChat() // runs first
            scrollToBottom() // runs second
        }, 1000)
    }
    $("#send").on("click", function () {
        scrollToBottom();
        var msgSend = $("#msgSend").val();
        $.ajax({
            method: "POST",
            url: "msgSend.php",
            data: {msgSend: msgSend,
            },
            success: function (data) {
                if (data !== "") {
                    alert(data);
                } else {
                    $("#msgSend").val('');
                }
            }
        });



    });

    fetchChat();

       });
</script>
