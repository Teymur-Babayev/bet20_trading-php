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
//bet transaction
$query = "SELECT * FROM `bettintransaction`";
$amount = $db->select($query);
$total = $amount->fetch_assoc();
$totalGain = $total['totalGaining'];
$totalSending = $total['totalSending'];
$totalSaving = $total['totalSaving'];
$s_save = $total['s_save'];
$winningAmount = 0.0;
$BetTotal = 0.0;
$ok = 0;
//winning action
if (isset($_GET['restart'])) {

    $match = $_GET['match'];
    $que = $_GET['que'];
    $sendingAmount = 0;
    $gainAmount = 0;

    if ($match != '') {
        //total bet
        $query = "select sum(betAmount) as totalBet FROM `bet` WHERE betTitleId='$que' and action=0";
        $resultBetTotal = $db->select($query)->fetch_assoc();
        $BetTotal = $resultBetTotal['totalBet'];

        $query = "select * FROM `bet` WHERE betTitleId='$que' and action=0 and betStatus=1";
        $resultBetWin = $db->select($query);
        if ($resultBetWin) {
            foreach ($resultBetWin as $win) {

                //update user balance
                $query = "SELECT * FROM `user` where userId='$win[userId]'";
                $resultUser = $db->select($query);
                $userBalance = $resultUser->fetch_assoc();
                $sendBalance = $win['returnAmount'];
                $sendingAmount = $sendingAmount - $sendBalance;
                if ($userBalance['balance'] > $win['returnAmount']) {
                    $userBlc = $userBalance['balance'] - $win['returnAmount'];
                    $query = "update `user` set balance='$userBlc' WHERE userId='$win[userId]'";
                    $db->update($query);
                    $winningAmount+=$sendBalance;
                }
              

                //transaction

                $dis = 'return from you';
                $query = "INSERT INTO `transaction`(`debit`,`userId`, `description`,total,time)"
                        . " VALUES ('$sendBalance','$win[userId]','$dis','$userBlc','$dt')";
                $db->insert($query);


                //   header("location:bettingPanel.php");
            }
        }
    }
      $query = "update `bet` set betStatus='0',actionAt=' ' WHERE betTitleId='$que'";
                $result = $db->update($query);

//user balance
    $userBalance = 0;
    $query = "select sum(balance) as total from user";
    $UserTotalBalance = $db->select($query);

    if ($UserTotalBalance) {
        $UserTotalBalance = $UserTotalBalance->fetch_assoc();

        $userBalance = round($UserTotalBalance['total'], 2);
    }
    //
    $RunningBalance = 0;
    $rem = $BetTotal - $winningAmount;
    $query = "select * FROM `betting_title` WHERE id='$match'";
    $result = $db->select($query);
    $matchName = $result->fetch_assoc();
    $matchName = $matchName['A_team'] . ' VS ' . $matchName['B_team'] . ' ' . $matchName['date'];

    $query = "select * FROM `betting_subtitle` WHERE id='$que'";
    $result = $db->select($query);
    $queName = $result->fetch_assoc();
    $queName = $queName['title'];

    if ($rem > 0) {
        $RunningBalance = $totalSaving - $rem;

        $s_save = $s_save - $rem;

           $query = "INSERT INTO `bet_history`(`question`, `match`, `debit`, `balance`,time,userBalance)"
                . " VALUES ('$queName','$matchName (mistake)','$rem','$RunningBalance','$dt','$userBalance')";
        $db->insert($query);
    } else {
        $RunningBalance = $totalSaving - ($rem);
        $s_save = $s_save - ($rem);
        $query = "INSERT INTO `bet_history`(`question`, `match`, `debit`, `balance`,time,userBalance)"
                . " VALUES ('$queName','$matchName (mistake)','$rem','$RunningBalance','$dt','$userBalance')";

        $db->insert($query);
    }


    //update bet transaction

    $query = "update `bettintransaction` set totalSending='$totalSending',totalGaining='$totalGain',totalSaving='$RunningBalance',s_save='$s_save'";
    $result = $db->update($query);
} else if (isset($_GET['match']) && isset($_GET['que']) && isset($_GET['ans'])) {

//winning action

    $match = $_GET['match'];
    $que = $_GET['que'];
    $ans = $_GET['ans'];
    $sendingAmount = 0;
    $gainAmount = 0;

    if ($match != '') {

        //total bet
        $query = "select sum(betAmount) as totalBet FROM `bet` WHERE betTitleId='$que' and betStatus='0' and action=0";
        $resultBetTotal = $db->select($query)->fetch_assoc();
        $BetTotal = $resultBetTotal['totalBet'];

        //
          $query = "select sum(returnAmount) as returnAmount FROM `bet` WHERE betId='$ans' and action=0";
        $winningAmount= $db->select($query)->fetch_assoc();;
        $winningAmount=$winningAmount['returnAmount'];
        
        
//user balance
        $userBalance = 0;
        $query = "select sum(balance) as total from user";
        $UserTotalBalance = $db->select($query);

        if ($UserTotalBalance) {
            $UserTotalBalance = $UserTotalBalance->fetch_assoc();

            $userBalance = round($UserTotalBalance['total'], 2);
        }
        //
        $RunningBalance = 0;
        $rem = $BetTotal - $winningAmount;
        $query = "select A_team,B_team,date FROM `betting_title` WHERE id='$match'";
        $result = $db->select($query);
        $matchName = $result->fetch_assoc();
        $matchName = $matchName['A_team'] . ' VS ' . $matchName['B_team'] . ' ' . $matchName['date'];

        $query = "select title FROM `betting_subtitle` WHERE id='$que'";
        $result = $db->select($query);
        $queName = $result->fetch_assoc();
        $queName = $queName['title'];
        if ($rem > 0) {
            $RunningBalance = $totalSaving + $rem;

            $s_save = $s_save + $rem;

            $query = "INSERT INTO `bet_history`(`question`, `match`, `credit`, `balance`,time,userBalance)"
                    . " VALUES ('$queName','$matchName','$rem','$RunningBalance','$dt','$userBalance')";
            $db->insert($query);
        } else {
            $RunningBalance = $totalSaving + ($rem);
            $s_save = $s_save + ($rem);
            $query = "INSERT INTO `bet_history`(`question`, `match`, `debit`, `balance`,time,userBalance)"
                    . " VALUES ('$queName','$matchName','$rem','$RunningBalance','$dt','$userBalance')";

            $db->insert($query);
        }
        $query = "INSERT INTO `betclosehistory`(`matchId`, `queId`, `gainAmunt`, `SendingAmount`)"
                . " VALUES ('$match','$que','$gainAmount','$sendingAmount')";
        $db->insert($query);

        //update bet transaction

        $query = "update `bettintransaction` set totalSending='$totalSending',totalGaining='$totalGain',totalSaving='$RunningBalance',s_save='$s_save'";
        $result = $db->update($query);
//result
        $query = "select id,userId,returnAmount FROM `bet` WHERE betId='$ans' and action=0";
        $resultBetWin = $db->select($query);
        if ($resultBetWin) {
            foreach ($resultBetWin as $win) {
                //update bet
                $query = "select id from `bet`  WHERE id='$win[id]' and userId='$win[userId]' and betStatus=0 and betId='$ans' and action=0";
                if ($db->select($query)) {

                    $query = "update `bet` set betStatus='1',actionAt='$dt' WHERE id='$win[id]' and userId='$win[userId]' and betStatus=0 and betId='$ans' and action=0";
                    $result = $db->update($query);
                    if ($result) {
                        $ok = 1;

                        //update user balance
                        $query = "SELECT balance FROM `user` where userId='$win[userId]'";
                        $resultUser = $db->select($query);
                        $userBalance = $resultUser->fetch_assoc();
                        $sendBalance = $win['returnAmount'];
                        $sendingAmount+=$sendBalance;
                        $userBlc = $userBalance['balance'] + $win['returnAmount'];
                        $query = "update `user` set balance='$userBlc' WHERE userId='$win[userId]'";
                        $db->update($query);
                        $winningAmount+=$sendBalance;

                        //bet transaction
                        $query = "SELECT returnAmount FROM `bet` WHERE userId='$win[userId]' and betId='$ans' and action=0 and betStatus=1";
                        $amount = $db->select($query);
                        if ($amount) {
                            $total = $amount->fetch_assoc();

                            $totalSending+=$total['returnAmount'];
                        }

                        //transaction

                        $dis = 'Bet Win';
                        $query = "INSERT INTO `transaction`(`credit`,`userId`, `description`,total,time)"
                                . " VALUES ('$sendBalance','$win[userId]','$dis','$userBlc','$dt')";
                        $db->insert($query);


                        //   header("location:bettingPanel.php");
                    }
                }
            }
        }

        $query = "select betAmount,userId FROM `bet` WHERE betTitleId='$que' and betStatus='0' and action=0";
        $resultBetLose = $db->delete($query);
        if ($resultBetLose) {
            foreach ($resultBetLose as $lose) {
                $gainBalance = $lose['betAmount'];
                $gainAmount+=$gainBalance;
                $query = "select id from `bet`  WHERE userId='$lose[userId]' and betStatus=0 and betStatus='0' and action=0 and betTitleId='$que'";
                if ($db->select($query)) {


                    //update bet
                    $query = "update `bet` set betStatus='2' WHERE userId='$lose[userId]' and betStatus=0 and betStatus='0' and action=0 and betTitleId='$que'";
                    $result = $db->update($query);

                    if ($result) {
                        $ok = 1;
                        //bet transaction
                        $query = "SELECT betAmount FROM `bet` WHERE userId='$lose[userId]' and betStatus='2' and action=0 and betTitleId='$que'";
                        $amount = $db->select($query);
                        if ($amount) {
                            $total = $amount->fetch_assoc();

                            $totalGain+=$total['betAmount'];
                        }
                    }
                }
            }
        }
    }
    if ($ok == 1) {


    }
}

if ($adminType == 1) {
    header("location:bettingPanel.php");
} else {
    header('location:SecondPanel.php');
}
?>

