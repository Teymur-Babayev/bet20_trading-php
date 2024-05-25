<?php
session_start();
include '../lib/Database.php';
$db = new Database();
?>
<?php
if (isset($_COOKIE['adminPanel'])) {

    $adminId = $_COOKIE['adminId'];
} else {

    $adminId = $_SESSION['adminId'];
}
?>
<?php	
$query = "SELECT * FROM `admin` WHERE id='$adminId'";
$result = $db->select($query);
if ($result) {
    $refresh = $result->fetch_assoc();
    if ($refresh['refresh'] == 1) {
        $query = "update `admin` set refresh='0'  WHERE id='$adminId'";
        $db->update($query);
        echo '1';
    }
}
?>