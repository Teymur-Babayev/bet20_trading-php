<?php
include '../lib/Database.php';
$db = new Database();
$output = '';
if (isset($_POST['userId'])){
    $query = "SELECT * FROM `chat` where userId='$_POST[userId]'";
$resulMsg = $db->select($query);
if ($resulMsg) {
    foreach ($resulMsg as $msg) {
        if ($msg['admin'] == 1) {

            $output .= '<div class="message me"><img width="50px" src="../img/user.png">
                <p class="info">'. $msg['msg'].'</p>
            </div>';
        } else {
             $output .= '  <div class="message "><img width="50px" src="../img/user.png">
                <p class="info">' . $msg['msg'] . '</p>
            </div>';
        }
    }
}
echo $output;
}
?>
