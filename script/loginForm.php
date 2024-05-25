<?php
session_start();
include '../lib/Database.php';
$db = new Database();
?>
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST['login'])) {


    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $query = "select * from admin where userName='$username' and password='$password'";
    $result = $db->select($query);
    if (!$result) {
        $_SESSION['message'] = "Login Failed. User not Found!";
        header('location:login.php');
    } else {
        $row = $result->fetch_assoc();

        if (isset($_POST['remember'])) {
            //set up cookie
            setcookie("adminPanel", $row['userName'], time() + (86400 * 30));
            setcookie("adminPass", $row['password'], time() + (86400 * 30));
            setcookie("adminId", $row['id'], time() + (86400 * 30));
            setcookie("adminType", $row['type'], time() + (86400 * 30));
        } else {
            setcookie('adminPanel', '', time() - (86400 * 30));
            setcookie('adminPass', '', time() - (86400 * 30));
            setcookie("adminId", '', time() - (86400 * 30));
            setcookie("adminType", '', time() - (86400 * 30));
        }

   
        $_SESSION['adminId'] = $row['id'];
        $_SESSION['adminPanel'] = $row['userName'];
        $_SESSION['adminPass'] = $row['password'];
        $_SESSION['adminType'] = $row['type'];
        if ($row['type'] == 2) {
            header('location:SecondPanel.php');
        } else if ($row['type'] == 3) {
            header('location:thirdPanel.php');
        } else {
            header('location:index.php');
        }
    }
} else {
    header('location:login.php');
    $_SESSION['message'] = "Please Login!";
}
?>