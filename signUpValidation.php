<?php

include './lib/Database.php';
$db = new Database();
?>

<?php

if (isset($_POST['userId'])){
    

    $userId= $_POST['userId'];


    $query = "SELECT  `userId` FROM `user` WHERE userId='$userId'";
    $resultUserId = $db->select($query);

    if ($resultUserId) {
        echo 'User already exists !!';
        exit();
    } 
}

if (isset($_POST['sponsor']) && isset($_POST['club'])){
    

    $sponsor= $_POST['sponsor'];
    $club= $_POST['club'];

    $query = "SELECT  * FROM `user` WHERE name='$sponsor'";
    $resultUserId = $db->select($query);

    if (!$resultUserId) {
        echo 'sponsor not exist !! ';
        exit();
    } 
}
?>