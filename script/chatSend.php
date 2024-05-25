<?php
include '../lib/Database.php';
$db = new Database();
$userId='';
if (isset($_POST['sendChat'])) {
    $msgSend = $_POST['msgSend'];
    $userId = $_POST['userId'];
    if ($msgSend != "") {
        $query = "INSERT INTO `chat`(`userId`,`msg`,admin)"
                . " VALUES ('$userId','$msgSend','1')";
        $result = $db->insert($query);
        if ($result) {
            $query = "INSERT INTO `user_notify`(`userId`)"
                    . " VALUES ('$userId')";
           $db->insert($query);
        } else {
            echo 'no1';
        }
    } else {
        echo 'please send any text !';
    }
} else {
    echo 'no';
}
header("location:chat.php?userName=".$userId);
?>