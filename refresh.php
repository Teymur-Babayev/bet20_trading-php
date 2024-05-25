<?php
include './lib/Database.php';
$db = new Database();
?>
<?php
// if (isset($_COOKIE['userId'])) {
	
// $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
// $result = $db->select($query);

// if ($result) {
//     $refresh = $result->fetch_assoc();
//     if ($refresh['refresh'] == 1) {
//         $query = "update `user` set refresh='0' WHERE userId='$_COOKIE[userId]'";
//         $db->update($query);
//         echo '1';
//     }
// }
// }
echo '1';
?>