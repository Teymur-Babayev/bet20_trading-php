<?php

include './lib/Database.php';
$db = new Database();
?>
<?php

if (isset($_POST['msgSend'])) {
    $msgSend = $_POST['msgSend'];
    if ($msgSend != "") {


        if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {
            $query = "INSERT INTO `chat`(`userId`, `msg`)"
                    . " VALUES ('$_COOKIE[userId]','$msgSend')";
            $resultBalance = $db->insert($query);

            if ($resultBalance) {
                $query = "SELECT `userId` FROM `club` WHERE userId='$_COOKIE[userId]'";
                if ($db->select($query)) {
                    $query = "INSERT INTO `admin_notify`(`userId`,type)"
                            . " VALUES ('$_COOKIE[userId]','2')";
                    $db->insert($query);
                } else {
                    $query = "INSERT INTO `admin_notify`(`userId`,type)"
                            . " VALUES ('$_COOKIE[userId]','1')";
                    $db->insert($query);
                }

                $query = "DELETE FROM `user_notify` WHERE userId='$_COOKIE[userId]'";
                $db->insert($query);
            } else {
                echo 'no1';
            }
        } else {
            echo 'Plz Login';
        }
    } else {
        echo 'please send any text !';
    }
} else {
    echo 'no';
}
?>