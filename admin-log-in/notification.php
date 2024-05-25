<?php

include '../lib/Database.php';
$db = new Database();
?>

<?php

    $query = "SELECT  `userId` FROM `user`";
    $resultUserId = $db->select($query);

    if ($resultUserId) {
        echo '1';
    } else {
           echo 'not';
    }

?>