<?php
include '../lib/Database.php';
$db = new Database();
?>
<?php
if ($_GET['sendingNumberDelete']) {
    $id = $_GET['sendingNumberDelete'];
    $query = "DELETE FROM `sending_money_number` WHERE id='$id'";
    $result = $db->delete($query);
    if ($result) {
        header("location:index.php");
    }
}else if ($_GET['recvNumberDelete']) {
    $id = $_GET['recvNumberDelete'];
    $query = "DELETE FROM `receiving_money_number` WHERE id='$id'";
    $result = $db->delete($query);
    if ($result) {
        header("location:index.php");
    }
}else if ($_GET['methodNumberDelete']) {
    $id = $_GET['methodNumberDelete'];
    $query = "DELETE FROM `method` WHERE id='$id'";
    $result = $db->delete($query);
    if ($result) {
        header("location:index.php");
    }
}else if ($_GET['w_methodNumberDelete']) {
    $id = $_GET['w_methodNumberDelete'];
    $query = "DELETE FROM `w_method` WHERE id='$id'";
    $result = $db->delete($query);
    if ($result) {
        header("location:index.php");
    }
}
?>