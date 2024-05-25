<?php
session_start();
include '../lib/Database.php';
$db = new Database();
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt = $dt->format('d M Y g:i A');
if (isset($_COOKIE['adminType'])) {
    $adminType = $_COOKIE['adminType'];
} else {
    $adminType = $_SESSION['adminType'];
}

//winning action
if (isset($_GET['match']) && isset($_GET['que']) && isset($_GET['ans'])) {

    $match = $_GET['match'];
    $que = $_GET['que'];
    $ans = $_GET['ans'];
    $sendingAmount = 0;
    $gainAmount = 0;

    if ($match != '') {

        $query = "select * FROM `bet` WHERE betId='$ans' and action=0";
        $resultBetWin = $db->select($query);
        if ($resultBetWin) {
            foreach ($resultBetWin as $win) {
                //update bet
                $query = "update `bet` set betStatus='1',actionAt='$dt' WHERE userId='$win[userId]' and betId='$ans' and action=0";
                $result = $db->update($query);
                if ($result) {

            
                    //update balance
                    $query = "SELECT * FROM `user` where userId='$win[userId]'";
                    $resultUser = $db->select($query);
                    $userBalance = $resultUser->fetch_assoc();
                    $sendBalance = $win['returnAmount'];
                    $sendingAmount+=$sendBalance;
                    $userBlc = $userBalance['balance'] + $win['returnAmount'];
                    $query = "update `user` set balance='$userBlc' WHERE userId='$win[userId]'";
                    $db->update($query);

                            //transaction
                
                    $dis = 'Bet Win';
                    $query = "INSERT INTO `transaction`(`credit`,`userId`, `description`,total,time)"
                            . " VALUES ('$sendBalance','$win[userId]','$dis','$userBlc','$dt')";
                    $db->insert($query);


                    //   header("location:bettingPanel.php");
                }
            }
        }

        $query = "select * FROM `bet` WHERE betTitleId='$que' and betStatus='0' and action=0";
        $resultBetLose = $db->delete($query);
        if ($resultBetLose) {
            foreach ($resultBetLose as $lose) {
                $gainBalance = $lose['betAmount'];
                $gainAmount+=$gainBalance;
                //update bet
                $query = "update `bet` set betStatus='2' WHERE userId='$lose[userId]' and betStatus='0' and action=0 and betTitleId='$que'";
                $result = $db->update($query);
                if ($result) {
                    
                }
            }
        } else {
            
        }
    } else {
        
    }
    $query = "INSERT INTO `betclosehistory`(`matchId`, `queId`, `gainAmunt`, `SendingAmount`)"
            . " VALUES ('$match','$que','$gainAmount','$sendingAmount')";
    $db->insert($query);
    if ($adminType==1){
          header("location:bettingPanel.php");
    }  else {
         header('location:SecondPanel.php');  
    }
  
}
?>

