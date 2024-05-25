<?php
include './lib/Database.php';
$db = new Database();
?>
<?php
if (isset($_POST['userId']) && $_POST['password']) {

    if (($_POST['userId'] !== "") && ($_POST['password'] !== "")) {


        $userId = $_POST['userId'];
        $password = $_POST['password'];
        $query = "select * from `user` where userId='$userId' and password='$password'";
        $result = $db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();

            //set up cookie
            setcookie("userId", $userId, time() + (86400 * 30));
            setcookie("password", $password, time() + (86400 * 30));
            setcookie("id", $row['id'], time() + (86400 * 30));
               setcookie("msg", 0, time() + (86400 * 30));
            $_SESSION['userId'] = $userId;
        } else {
            $query = "select * from `club` where userId='$userId' and password='$password'";
            $result = $db->select($query);
            if ($result) {

                $row = $result->fetch_assoc();
                //set up cookie
                setcookie("userId", $userId, time() + (86400 * 30));
                setcookie("password", $password, time() + (86400 * 30));
                setcookie("club", $userId, time() + (86400 * 30));
                setcookie("id", $row['id'], time() + (86400 * 30));
                setcookie("msg", 0, time() + (86400 * 30));
                $_SESSION['userId'] = $userId;
            } else {
                echo 'no';
            }
        }
    } else {
        echo 'no';
    }
} else {
    echo 'no';
}
?>