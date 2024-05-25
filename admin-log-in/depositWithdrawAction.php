<?php

session_start();
if (isset($_COOKIE['adminType'])) {
    $adminType = $_COOKIE['adminType'];
} else {
    $adminType = $_SESSION['adminType'];
}
include '../lib/Database.php';
$db = new Database();
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt = $dt->format('d M Y g:i A');
?>
<?php

//user balance
$userBalance = 0;
$query = "select sum(balance) as total from user";
$UserTotalBalance = $db->select($query);

if ($UserTotalBalance) {
    $UserTotalBalance = $UserTotalBalance->fetch_assoc();

    $userBalance = round($UserTotalBalance['total'], 2);
}

if (isset($_GET['action']) && isset($_GET['userId']) && isset($_GET['ref_number']) && isset($_GET['seen'])) {
//deposit
    $action = $_GET['action'];
    $userId = $_GET['userId'];
    $ref_number = $_GET['ref_number'];
    $amount = $_GET['amount'];
    $to = $_GET['to'];
    $rate = $_GET['rate'];
    $amount = $amount * $rate;


    if ($userId != '') {

        $query = "update `admin_notification` set seen='1',actionAt='$dt',userBalance='$userBalance' WHERE userId='$userId' and ref_number='$ref_number' and seen=0";
        $result = $db->update($query);
        if ($result) {

            //to number
            $query = "SELECT * FROM `deposit_and_withdraw_his` where m_number='$to'";
            if ($db->select($query)) {
                $resultTo = $db->select($query);
                $resultTo = $resultTo->fetch_assoc();
                $toAmount = $resultTo['amount'] + $amount;

                $query = "update `deposit_and_withdraw_his` set amount='$toAmount',finishDate='$dt' WHERE id='$resultTo[id]'";
                $db->update($query);
            } else {
                $query = "INSERT INTO `deposit_and_withdraw_his`(`m_number`, `amount`, `startDate`, `finishDate`,d_or_w)"
                        . " VALUES ('$to','$amount','$dt','$dt','1')";
                $db->insert($query);
            }

            //update balance
            $query = "SELECT * FROM `user` where userId='$userId'";
            $resultUser = $db->select($query);
            $userBalance = $resultUser->fetch_assoc();
            $userBlc = $userBalance['balance'] + $amount;
            $query = "update `user` set balance='$userBlc' WHERE userId='$userId'";
            $db->update($query);
            //transaction

            $dis = 'deposit';
            $query = "INSERT INTO `transaction`( `credit`,`userId`, `description`,total,time)"
                    . " VALUES ('$amount','$userId','$dis','$userBlc','$dt')";
            $db->insert($query);
        }
        //admin 
        $query = "SELECT `balance` FROM `admin` where type=1";
        $resultAdmin = $db->select($query);
        $adminBalance = 0;
        if ($resultAdmin) {
            $resultAdmin = $resultAdmin->fetch_assoc();
            $adminBalance = $resultAdmin['balance'];
        }
        if ($adminBalance > $amount) {
            $adminBalance = $adminBalance - $amount;
            $query = "UPDATE `admin` SET "
                    . "`balance`='$adminBalance'"
                    . " WHERE type=1";
            $resultClubInsert = $db->update($query);

            if ($resultClubInsert) {
                $query = "INSERT INTO `admintransaction`(`debit`, `description`,total)"
                        . " VALUES ('$amount','deposit by $userId','$adminBalance')";
                $resultClubInsert = $db->insert($query);
            }
        } else {
            echo '<script>alert("not enough balance of admin")</script>';
        }
    }
    if ($adminType == 1) {
        header("location:deposit.php");
    } else {
        header("location:thirdDeposit.php");
    }
} else if (isset($_GET['action']) && isset($_GET['userId']) && isset($_GET['ref_number'])) {
//process
    $action = $_GET['action'];
    $userId = $_GET['userId'];
    $ref_number = $_GET['ref_number'];
    if ($userId != '') {

        $query = "update `admin_notification` set action='1' WHERE userId='$userId' and ref_number='$ref_number' and seen=0";
        $result = $db->update($query);
        if ($result) {
            if ($adminType == 1) {
                header("location:deposit.php");
            } else {
                header("location:thirdDeposit.php");
            }
        } else {
            
        }
    } else {
        
    }
} else if (isset($_GET['Dcancel'])) {

    $id = $_GET['Dcancel'];

    if ($id != '') {

        $query = "update `admin_notification` set action='3',actionAt='$dt' WHERE id='$id'";
        $result = $db->update($query);
        if ($result) {
            if ($adminType == 1) {
                header("location:deposit.php");
            } else {
                header("location:thirdDeposit.php");
            }
        } else {
            
        }
    } else {
        
    }
} else if (isset($_GET['Wcancel'])) {

    $id = $_GET['Wcancel'];

    if ($id != '') {

        $query = "select * from `admin_notification`  WHERE id='$id'";
        $result = $db->select($query);
        if ($result) {
            $userId = $result->fetch_assoc();
            $amount = $userId['withdraw'];
            $query = "SELECT * FROM `user` where userId='$userId[userId]'";
            $resultUser = $db->select($query);
            if ($resultUser) {
                $userBalance = $resultUser->fetch_assoc();
                $userBlc = $userBalance['balance'] + $amount;
                $query = "update `user` set balance='$userBlc' WHERE userId='$userId[userId]'";
                $db->update($query);
                //transaction      
                $query = "INSERT INTO `transaction`( `credit`,`userId`, `description`,total,time)"
                        . " VALUES ('$amount','$userId[userId]','withrawal cancel','$userBlc','$dt')";
                $resultClubInsert = $db->insert($query);
            } else {
                $query = "SELECT * FROM `club` where userId='$userId[userId]'";
                $resultUser = $db->select($query);
                $userBalance = $resultUser->fetch_assoc();
                $userBlc = $userBalance['balance'] + $amount;
                $query = "update `club` set balance='$userBlc' WHERE userId='$userId[userId]'";
                $db->update($query);
                //transaction      
                $query = "INSERT INTO `transaction`( `credit`,`userId`, `description`,total,time)"
                        . " VALUES ('$amount','$userId[userId]','withrawal cancel','$userBlc','$dt')";
                $resultClubInsert = $db->insert($query);
            }

            $query = "update `admin_notification` set wAction='3' WHERE id='$id'";
            $result = $db->update($query);
            if ($result) {

                if ($adminType == 1) {
                    header("location:withdrawInbox.php");
                } else {

                    header("location:thirdWithdraw.php");
                }
            }
        }
    }
}

//withdraw
if (isset($_POST['wAction']) && isset($_POST['userId']) && isset($_POST['ref_number']) && isset($_POST['seen'])) {

    $action = $_POST['wAction'];
    $userId = $_POST['userId'];
    $id = $_POST['ref_number'];
    $amount = $_POST['withdraw'];
    $userType = $_POST['userType'];
 
    $confirm_number = $ref_number = $_POST['confirm_number'];
    if ($userId != '') {

        $query = "update `admin_notification` set"
                . " seen='1',"
                . " actionAt='$dt',userBalance='$userBalance',"
                . "confirm_number='$confirm_number'"
                . " WHERE userId='$userId' and id='$id' and seen=0";
        $result = $db->update($query);


        //admin 
        $query = "SELECT `balance` FROM `admin` where type=1";
        $resultAdmin = $db->select($query);
        $adminBalance = 0;
        if ($resultAdmin) {
            $resultAdmin = $resultAdmin->fetch_assoc();
            $adminBalance = $resultAdmin['balance'];
        }

        $adminBalance = $adminBalance + $amount;
        $query = "UPDATE `admin` SET "
                . "`balance`='$adminBalance'"
                . " WHERE type=1";
        $resultClubInsert = $db->update($query);

        if ($resultClubInsert) {


            $query = "INSERT INTO `admintransaction`(`credit`,`description`,total)"
                    . " VALUES ('$amount','withrawal by $userId','$adminBalance')";
            $resultClubInsert = $db->insert($query);
        }
        
    }
    if ($userType == 2) {

        $query = "SELECT * FROM `club` where userId='$userId'";
        $resultClub = $db->select($query);
        $clubBalance = $resultClub->fetch_assoc();
        $personalIdOfClub = $clubBalance['personalIdOfClub'];
        if ($personalIdOfClub) {

            //update balance
            $query = "SELECT * FROM `user` where userId='$personalIdOfClub'";
            $resultUser = $db->select($query);
            $userBalance = $resultUser->fetch_assoc();
            $userBlc = $userBalance['balance'] + $amount;
            $query = "update `user` set balance='$userBlc' WHERE userId='$personalIdOfClub'";
            $db->update($query);
            //user transaction

            $dis = 'Club to user balance';
            $query = "INSERT INTO `transaction`( `credit`,`userId`, `description`,total,time)"
                    . " VALUES ('$amount','$personalIdOfClub','$dis','$userBlc','$dt')";
            $db->insert($query);
        }


        header("location:clubInbox.php");
    } else {
            //from number
            $query = "SELECT * FROM `deposit_and_withdraw_his` where m_number='$confirm_number'";
            if ($db->select($query)) {
                $resultFrom = $db->select($query);
                $resultFrom = $resultFrom->fetch_assoc();
                $FromAmount = $resultFrom['amount'] + $amount;

                $query = "update `deposit_and_withdraw_his` set amount='$FromAmount',finishDate='$dt' WHERE id='$resultFrom[id]'";
                $db->update($query);
            } else {
                $query = "INSERT INTO `deposit_and_withdraw_his`(`m_number`, `amount`, `startDate`, `finishDate`,d_or_w)"
                        . " VALUES ('$confirm_number','$amount','$dt','$dt','2')";
                $db->insert($query);
            }
            
        if ($adminType == 1) {
            header("location:withdrawInbox.php");
        } else {

           header("location:thirdWithdrawInbox.php");
        }
    }
} else if (isset($_GET['wAction']) && isset($_GET['userId']) && isset($_GET['ref_number'])) {

    $action = $_GET['wAction'];
    $userId = $_GET['userId'];
    $ref_number = $_GET['ref_number'];
    if ($userId != '') {

        $query = "update `admin_notification` set wAction='1' WHERE userId='$userId' and id='$ref_number' and seen=0";
        $result = $db->update($query);
        if ($result) {
            if ($adminType == 1) {
                header("location:withdrawInbox.php");
            } else {

                header("location:thirdWithdraw.php");
            }
        } else {
            
        }
    } else {
        
    }
}