<?php
session_start();
if (isset($_COOKIE['adminType'])) {
    $adminType = $_COOKIE['adminType'];
} else {
    $adminType = $_SESSION['adminType'];
}
include '../lib/Database.php';
$db = new Database();
$userActive = 0;
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt=$dt->format('d M Y g:i A');
?>
<?php

if (isset($_POST['notice'])) {
    $noticeMsg = $_POST['noticeMsg'];
    $Times = $_POST['userId'];
    $ans = $_GET['ans'];

  foreach ($Times as $id) {
        $query = "update `bet` set notes='$noticeMsg' WHERE betId='$ans' and id='$id'";
        $resultUser = $db->update($query);
        header("location:bettingPanel.php");
     /* $query = "INSERT INTO `chat`(`userId`, `msg`,`admin`)"
          . " VALUES ('$user','$noticeMsg','1')";
          $db->insert($query);
          $query = "INSERT INTO `user_notify`(`userId`)"
          . " VALUES ('$user')";
          $db->insert($query); */
    }
} else if (isset($_POST['refund'])) {

    $refungAmount = $_POST['refungAmount'];
    $refundCheck = $_POST['refundCheck'];
    $Times = $_POST['userId'];
    $ans = $_GET['ans'];
     foreach ($Times as $id) {
         //echo $id.' '.$ans;
     }
  if ($refungAmount) {

        if ($refundCheck == 'send') {


            foreach ($Times as $id) {
                
                $query = "SELECT * FROM `bet` WHERE betId='$ans' and id='$id'";
                $resultUser = $db->select($query);
                $userTotal = $resultUser->fetch_assoc();
                $userTotalBet = $userTotal['betAmount'];
                $user = $userTotal['userId'];
                $sendBalance = ($refungAmount * $userTotalBet) / 100.00;
                //update action
                $query = "update `bet` set action=1,persentage='$refungAmount' WHERE betId='$ans' and id='$id'";
                $resultUser = $db->update($query);
          
                //update balance
                $query = "SELECT * FROM `user` where userId='$user'";
                $resultUser = $db->select($query);
                $userBalance = $resultUser->fetch_assoc();
                $userBlc = $userBalance['balance'] + $sendBalance;
                $query = "update `user` set balance='$userBlc' WHERE userId='$user'";
                $db->update($query);
                      //transaction


                $dis = ' Party Return to you ' . $refungAmount . '%';
                $query = "INSERT INTO `transaction`(`credit`,`userId`, `description`,total,time)"
                        . " VALUES ('$sendBalance','$user','$dis','$userBlc','$dt')";
                $db->insert($query);

                // 
            }
        
        } else if ($refundCheck == 'return') {


            foreach ($Times as $id) {
                $query = " SELECT * FROM `bet` WHERE betId='$ans' and id='$id'";
                $resultUser = $db->select($query);
                $userTotal = $resultUser->fetch_assoc();
                $userTotalBet = $userTotal['returnAmount'];
                $user = $userTotal['userId'];
                $sendBalance = ($refungAmount * $userTotalBet) / 100.00;
                //update action
                $query = "update `bet` set action=2,persentage='$refungAmount' WHERE betId='$ans' and id='$id'";
                $resultUser = $db->update($query);
       
                //update balance
                $userBlc = 0;
                $query = "SELECT * FROM `user` where userId='$user'";
                $resultUser = $db->select($query);
                $userBalance = $resultUser->fetch_assoc();
                $userBlc = $userBalance['balance'] - $sendBalance;
                if ($userBlc < 0) {
                    $b = abs($userBlc);
                    $cut = $sendBalance - $b;
                    $userBlc = $userBalance['balance'] - $cut;
                    $query = "update `user` set balance='$userBlc',loan='$b'  WHERE userId='$user'";
                    $db->update($query);
                             //transaction             

                $dis = 'return from you ' . $refungAmount . '%';
                $query = "INSERT INTO `transaction`(`debit`,`userId`, `description`,total,time)"
                        . " VALUES ('$sendBalance','$user','$dis','$userBlc','$dt')";
                $db->insert($query);
                } else {
                    $query = "update `user` set balance='$userBlc' WHERE userId='$user'";
                    $db->update($query);
                            //transaction             
                $dis = 'return from you ' . $refungAmount . '%';
                $query = "INSERT INTO `transaction`(`debit`,`userId`, `description`,total,time)"
                        . " VALUES ('$sendBalance','$user','$dis','$userBlc','$dt')";
                $db->insert($query);
                }
            }
        
        }
    }
        header("location:bettingPanel.php");
}
//deposite notice
if (isset($_POST['depositeNotice'])) {
    $noticeMsg = $_POST['noticeMsg'];
    $noticeId = $_POST['noticeId'];
    $query = "UPDATE `admin_notification` SET `notes`='$noticeMsg' WHERE id='$noticeId'";
    $db->update($query);
        if ($adminType == 1) {
                header("location:deposit.php");
            } else {
                header("location:thirdDeposit.php");
            }
} else if (isset($_POST['withdrawNotice'])) {
    $noticeMsg = $_POST['noticeMsg'];
    $noticeId = $_POST['noticeId'];
    $query = "UPDATE `admin_notification` SET `notes`='$noticeMsg' WHERE id='$noticeId'";
    $db->update($query);
       if ($adminType == 1) {
                    header("location:withdrawInbox.php");
                } else {

                    header("location:thirdWithdraw.php");
                }
}
?>