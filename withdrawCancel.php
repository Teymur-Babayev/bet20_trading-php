<?php

include './lib/Database.php';
$db = new Database();
?>
<?php

 if (isset($_GET['wCancel'])) {
    $id = $_GET['wCancel'];

    $query = "select * FROM `admin_notification` WHERE id='$id'";
    $result = $db->select($query);
    if ($result) {
        $result = $result->fetch_assoc();
        $amount = $result['withdraw'];
        $userId = $result['userId'];
        //transaction
        $query = "SELECT `total` FROM `transaction` WHERE userId='$userId' and (clubCredit=0 and clubDebit=0) order by id desc limit 1";
        $resultTotal = $db->select($query);
        $Total = 0;
        if ($resultTotal) {
            $Total = $resultTotal->fetch_assoc();
            $Total = $Total['total'];
        }
        $Total+=$amount;
        $dis = 'withdraw canceled by you';
        $query = "INSERT INTO `transaction`( `credit`,`userId`, `description`,total)"
                . " VALUES ('$amount','$userId','$dis','$Total')";
        $db->insert($query);
        //update balance
        $query = "SELECT * FROM `user` where userId='$userId'";
        $resultUser = $db->select($query);
        $userBalance = $resultUser->fetch_assoc();
        $userBlc = $userBalance['balance'] + $amount;
        $query = "update `user` set balance='$userBlc' WHERE userId='$userId'";
        $db->update($query);
    }

  $query = "DELETE FROM `admin_notification` WHERE id='$id'";
    $result = $db->update($query);
 
        header("location:statement.php");
    
}
?>