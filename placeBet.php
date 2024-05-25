<?php

include './lib/Database.php';
$db = new Database();
$userActive = 0;
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt = $dt->format('d M Y g:i A');
?>
<?php

if (isset($_COOKIE['userId'])) {


    if (isset($_COOKIE['club'])) {
        $query = "SELECT * FROM `club` where userId='$_COOKIE[userId]'";
        $result = $db->select($query);
        $userActive = $result->fetch_assoc();
    } else {
        $query = "SELECT * FROM `user` where userId='$_COOKIE[userId]'";
        $result = $db->select($query);
        $userActive = $result->fetch_assoc();
    }

    if ($userActive['active'] == 1) {

        if (isset($_POST['match'])) {
            $match = $_POST['match'];
            $matchBet = $_POST['matchBet'];
            $betRate = $_POST['betRate'];
            $stakeAmount = $_POST['stakeAmount'];
            $betId = $_POST['betId']; //answer
            $matchId = $_POST['matchId']; //match
            $betTitleId = $_POST['betTitleId']; //question

            if (isset($_COOKIE['club'])) {
                echo 'club not permitted for bet';
            } else {



                if ($match != "" && $matchBet != "" && $betRate != "" && $stakeAmount != "" && $betId != "") {
                    $wait = 1;
                    //wait
                    $query = "SELECT * FROM `betting_title` WHERE id='$matchId'";
                    $result = $db->select($query);
                    if ($result) {
                        $matchFetch = $result->fetch_assoc();
                        $wait1 = $matchFetch['waittingTime'];
                        $query = "SELECT * FROM `betting_subtitle` WHERE id='$betTitleId'";
                        $result = $db->select($query);
                        if ($result) {
                            $matchFetch = $result->fetch_assoc();
                            $wait2 = $matchFetch['waittingTime'];
                            if ($wait1 > $wait2) {
                                $wait = $wait1;
                            } else {
                                $wait = $wait2;
                            }
                        }
                    }
                    sleep($wait);
                    //active

                    $query = "SELECT * FROM `betting_sub_title_option` WHERE id='$betId'";
                    $result = $db->select($query);
                    if ($result) {
                        $matchFetch = $result->fetch_assoc();
                        $betRate = $matchFetch['amount'];
                    }

                    $active = 1;
                    $query = "SELECT * FROM `betting_title` WHERE id='$matchId'";
                    $result = $db->select($query);
                    if ($result) {
                        $matchFetch = $result->fetch_assoc();
                        if ($matchFetch['showStatus'] == 0) {
                            $active = 0;
                            echo 'bet place  is inactive ,please wait....';
                        }
                    }
                    if ($active) {
                        $query = "SELECT * FROM `betting_subtitle` WHERE id='$betTitleId'";
                        $result = $db->select($query);
                        if ($result) {
                            $matchFetch = $result->fetch_assoc();
                            if ($matchFetch['showStatus'] == 0) {
                                $active = 0;
                                echo 'bet place  is inactive,please wait....';
                            }
                        }
                    }
                    if ($active) {
                        $query = "SELECT * FROM `betting_sub_title_option` WHERE id='$betId'";
                        $result = $db->select($query);
                        if ($result) {
                            $matchFetch = $result->fetch_assoc();
                            if ($matchFetch['showStatus'] == 0) {
                                $active = 0;
                                echo 'bet place  is inactive,please wait....';
                            }
                        }
                    }
                    if ($active) {
                        if ($stakeAmount > 0.00) {
                            if ($stakeAmount >= 20.00 && $stakeAmount <= 3000.00) {
                                $ok = 1;
                                //limit check match
                                $query = "SELECT * FROM `betting_title` WHERE id='$matchId'";
                                $result = $db->select($query);
                                if ($result) {
                                    $matchFetch = $result->fetch_assoc();
                                    if ($matchFetch['limitedAmount'] > 0) {
                                        $query = "SELECT sum(betAmount) as totalMatch FROM `bet` WHERE matchId='$matchId'";
                                        $result = $db->select($query);
                                        if ($result) {
                                            $fetch = $result->fetch_assoc();
                                            $totalMatch = $fetch['totalMatch'];
                                            if ($matchFetch['limitedAmount'] < ($totalMatch + $stakeAmount)) {
                                                $ok = 0;
                                                $value = ($totalMatch + $stakeAmount) - $matchFetch['limitedAmount'];
                                                echo 'bet amount is limited but you can place bet less than ' . abs($value);
                                            }
                                        }
                                    }
                                }
                                if ($ok == 1) {
                                    //limit check question
                                    $query = "SELECT * FROM `betting_subtitle` WHERE id='$betTitleId'";
                                    $result = $db->select($query);
                                    if ($result) {
                                        $matchFetch = $result->fetch_assoc();
                                        if ($matchFetch['limitedAmount'] > 0) {
                                            $query = "SELECT sum(betAmount) as totalMatch FROM `bet` WHERE betTitleId='$betTitleId'";
                                            $result = $db->select($query);
                                            if ($result) {
                                                $fetch = $result->fetch_assoc();
                                                $totalMatch = $fetch['totalMatch'];
                                                if ($matchFetch['limitedAmount'] < ($totalMatch + $stakeAmount)) {
                                                    $ok = 0;
                                                    $value = ($totalMatch + $stakeAmount) - $matchFetch['limitedAmount'];
                                                    echo 'bet amount is limited but you can place bet less than ' . abs($value);
                                                }
                                            }
                                        }
                                    }
                                } if ($ok == 1) {
                                    //limit check question
                                    $query = "SELECT * FROM `betting_sub_title_option` WHERE id='$betId'";
                                    $result = $db->update($query);
                                    if ($result) {
                                        $matchFetch = $result->fetch_assoc();
                                        if ($matchFetch['limitedAmount'] > 0) {
                                            $query = "SELECT sum(betAmount) as totalMatch FROM `bet` WHERE betId='$betId'";
                                            $result = $db->select($query);
                                            if ($result) {
                                                $fetch = $result->fetch_assoc();
                                                $totalMatch = $fetch['totalMatch'];
                                                if ($matchFetch['limitedAmount'] < ($totalMatch + $stakeAmount)) {
                                                    $ok = 0;
                                                    $value = ($totalMatch + $stakeAmount) - $matchFetch['limitedAmount'];
                                                    echo 'Now  you can place bet less than ' . abs($value);
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($ok) {
                                    if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {
                                        $query = "SELECT * FROM `user` where userId='$_COOKIE[userId]' and id='$_COOKIE[id]'";
                                        $resultBalance = $db->select($query);

                                        if ($resultBalance) {
                                            $Balance = $resultBalance->fetch_assoc();
                                            $clubId = $Balance['clubId'];
                                            $sponsorUsername = $Balance['sponsorUsername'];

                                            $query = "SELECT * FROM `club` where userId='$clubId'";
                                            $resultClub = $db->select($query);
                                            $clubBalance = $resultClub->fetch_assoc();
                                            $clubCommission = 0;
                                            if ($clubBalance['rate'] == 0) {
                                                $query = "SELECT * FROM `rule`";
                                                $resultRule = $db->select($query);
                                                $Commission = $resultRule->fetch_assoc();
                                                $clubCommission = $Commission['clubCommission'];
                                            } else {
                                                $clubCommission = $clubBalance['rate'];
                                            }

                                            if ($clubId == 'Bet2in') {
                                                $clubCommission = ($stakeAmount * 1.5) / 100.00;
                                            } else {
                                                $clubCommission = ($stakeAmount * $clubCommission) / 100.00;
                                            }


                                            $query = "SELECT * FROM `rule`";
                                            $resultRule = $db->select($query);
                                            $minimumBalance = $resultRule->fetch_assoc();
                                            $minimumBalance = $minimumBalance['minimumBalance'];

                                            if (($Balance['balance'] - $minimumBalance) >= ($stakeAmount)) {

                                                // club accouunt update

                                                $clubBlc = $clubBalance['balance'] + $clubCommission;
                                                $query = "update `club` set balance='$clubBlc' WHERE userId='$clubId'";
                                                $db->update($query);

                                                //club Transaction history

                                                $dis = 'club commission';
                                                $query = "INSERT INTO `transaction`(`userId`, `debit`,clubCredit,clubId,description,total,time)"
                                                        . " VALUES ('$_COOKIE[userId]','$clubCommission','$clubCommission','$clubId','$dis','$clubBlc','$dt')";
                                                $db->insert($query);


                                                $returnAmount = $stakeAmount * $betRate;
                                                $query = "INSERT INTO `bet`(`userId`, `club`, `betTitle`, `matchTitle`, `betRate`, `betAmount`,betId,matchId,betTitleId,returnAmount,time)"
                                                        . " VALUES ('$_COOKIE[userId]','$clubId','$matchBet','$match','$betRate','$stakeAmount','$betId','$matchId','$betTitleId','$returnAmount','$dt')";
                                                $resultBett = $db->insert($query);

                                                //sponsorUsername commision
                                                if ($sponsorUsername) {
                                                    $query = "SELECT * FROM `user` where userId='$sponsorUsername'";
                                                    $resultSponsor = $db->select($query);
                                                    $SponsorBalance = $resultSponsor->fetch_assoc();
                                                    $Sbalance = $SponsorBalance['balance'];

                                                    $SponsorCommission = 0;
                                                    if ($SponsorBalance['sponsorCommission'] == 0) {
                                                        $query = "SELECT * FROM `rule`";
                                                        $resultRule = $db->select($query);
                                                        $Commission = $resultRule->fetch_assoc();
                                                        $SponsorCommission = $Commission['userSponsor'];
                                                    } else {
                                                        $SponsorCommission = $SponsorBalance['sponsorCommission'];
                                                    }


                                                    $SponsorCommission = ($stakeAmount * $SponsorCommission) / 100.00;


                                                    //saving balance
                                                    $query = "SELECT * FROM `bettintransaction`";
                                                    $resultSave = $db->select($query);
                                                    $resultSave = $resultSave->fetch_assoc();
                                                    $saving = $resultSave['s_save'];
                                                    $saving = $saving - $SponsorCommission;
                                                    $query = "update `bettintransaction` set s_save='$saving'";
                                                    $db->update($query);
                                                    //update balance sponsor
                                                    $userBlc = $Sbalance + $SponsorCommission;
                                                    $query = "update `user` set balance='$userBlc' WHERE userId='$sponsorUsername'";
                                                    $db->update($query);
                                                    //sponsorUsername Transaction history

                                                    $dis = 'sponsor commission';
                                                    $query = "INSERT INTO `transaction`(`userId`, `credit`,description,total,sposor,time)"
                                                            . " VALUES ('$sponsorUsername','$SponsorCommission','$dis','$userBlc','$SponsorCommission','$dt')";
                                                    $db->insert($query);
                                                }


                                                //update balance
                                                $query = "SELECT * FROM `user` where userId='$_COOKIE[userId]'";
                                                $resultUser = $db->select($query);
                                                $userBalance = $resultUser->fetch_assoc();
                                                $userBlc = $userBalance['balance'] - $stakeAmount;
                                                $query = "update `user` set balance='$userBlc' WHERE userId='$_COOKIE[userId]'";
                                                $db->update($query);
                                                //user transaction

                                                $dis = 'Bet Placed';
                                                $query = "INSERT INTO `transaction`( `debit`,`userId`, `description`,total,time)"
                                                        . " VALUES ('$stakeAmount','$_COOKIE[userId]','$dis','$userBlc','$dt')";
                                                $db->insert($query);
                                                //admin refresh
                                                $query = "UPDATE `admin` SET refresh='1'";
                                                $result = $db->update($query);

                                                if ($resultBett) {
                                                    
                                                } else {
                                                    echo 'no 2';
                                                }
                                            } else {
                                                echo 'Not sufficient. Balance minimum balance requred ' . $minimumBalance . ' !! please deposit. ';
                                            }
                                        } else {
                                            echo 'no 1';
                                        }
                                    } else {
                                        echo 'Plz Login';
                                    }
                                }
                            } else {
                                echo ' Minimum bet amount 20  and maximum amount 3000 !! ';
                            }
                        } else {
                            echo ' insert valid  Balance !! ';
                        }
                    }
                } else {
                    echo '  Balancse is Requred!! ';
                }
            }
        }
//deposit submit
        else if (isset($_POST['dAmount']) && isset($_POST['dMethodt']) && isset($_POST['dFrom']) && isset($_POST['dReference'])) {
            $dAmount = $_POST['dAmount'];
            $dMethodt = $_POST['dMethodt'];
            $dFrom = $_POST['dFrom'];
            $dReference = $_POST['dReference'];
            $dTo = $_POST['dTo'];

            $rate = 1;
            $query = "SELECT * FROM method where id='$dMethodt'";
            $resultMethod = $db->select($query);

            if ($resultMethod) {
                $Method = $resultMethod->fetch_assoc();
                $dMethodt = $Method['method'];
                $rate = $Method['rate'];
            }

            $t = 1;
            if ($dAmount != "" && $dMethodt != "" && $dFrom != "" && $dReference != "" && $dTo != "") {


                if ($dAmount > 0.0) {

                    if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {
                        //previous submission check
                        $query = "SELECT * FROM `admin_notification` WHERE userId='$_COOKIE[userId]' and seen='0' and ref_number='$dReference'";
                        $resultBalance = $db->select($query);

                        if (!$resultBalance) {


                            $query = "INSERT INTO `admin_notification`( `userId`, `deposit`,`notificationType`, `pay_method`,`from_number`,`to_number`,`ref_number`,rate,time)"
                                    . " VALUES ('$_COOKIE[userId]','$dAmount','$t','$dMethodt','$dFrom','$dTo','$dReference','$rate','$dt')";
                            $resultBalance = $db->insert($query);

                            if ($resultBalance) {
                                
                            } else {
                                echo 'no';
                            }
                        } else {
                            echo 'Your Previous Request is Pending ! You can not send Deposit Request untill previous request is accepted';
                        }
                    } else {
                        echo 'Plz Login';
                    }
                } else {
                    echo ' Please Insert Valid Amount !! ';
                }
            } else {
                echo 'Field is requred';
            }
            //withdraw
        } else if (isset($_POST['wAmount'])) {


            if (isset($_COOKIE['userId'])) {

                if (isset($_COOKIE['club'])) {
                    $wAmount = $_POST['wAmount'];
                    $password = $_POST['password'];
                    $t = 2;
                    if ($wAmount != "" && $password != "") {


                        if ($wAmount > 0.0) {
                            $query = "SELECT * FROM `club` WHERE userId='$_COOKIE[userId]' and password='$password'";
                            $resultBalanceCheck = $db->select($query);

                            if ($resultBalanceCheck) {
                                $balance = $resultBalanceCheck->fetch_assoc();
                                $query = "SELECT * FROM rule";
                                $resultRule = $db->select($query);
                                $minimumBalance = $resultRule->fetch_assoc();
                                $minimumBalance = $minimumBalance['minimumBalance'];

                                if (($wAmount) <= ($balance['balance'] - $minimumBalance)) {
                                    if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {

                                        $query = "INSERT INTO `admin_notification`( `userId`, `withdraw`,`notificationType`,userType,time)"
                                                . " VALUES ('$_COOKIE[userId]','$wAmount','$t','2','$dt')";
                                        $resultBalance = $db->insert($query);
                                        if ($resultBalance) {
                                             echo 'Your Previous Request is Pending ! You can not send withdraw Request untill previous request is accepted';
                        }
                                        


                                        //update balance
                                        $query = "SELECT * FROM `club` where userId='$_COOKIE[userId]'";
                                        $resultUser = $db->select($query);
                                        $userBalance = $resultUser->fetch_assoc();
                                        $userBlc = $userBalance['balance'] - $wAmount;
                                        $query = "update `club` set balance='$userBlc' WHERE userId='$_COOKIE[userId]'";
                                        $db->update($query);
                                        //transaction

                                        $dis = 'withdraw';
                                        $query = "INSERT INTO `transaction`( `debit`,`clubId`,`description`,total,time)"
                                                . " VALUES ('$wAmount','$_COOKIE[userId]','$dis','$userBlc','$dt')";
                                        $db->insert($query);

                                        if ($resultBalance) {
                                            
                                        } else {
                                            echo 'no';
                                        }
                                    } else {
                                        echo ' Plz Login';
                                    }
                                } else {
                                    echo 'Not sufficient Balance minimum balance requred' . $minimumBalance . '!! please deposit. ';
                                }
                            } else {
                                echo 'password not match';
                            }
                        } else {
                            echo ' Please Insert Valid Amount !! ';
                        }
                    } else {
                        echo 'Field is requred ';
                    }
                } else {
                    $transferPassword = $_POST['wPassword'];
                    $query = "select * from `user` where userId='$_COOKIE[userId]' and  password='$transferPassword'";
                    if ($db->select($query)) {

                        $wAmount = $_POST['wAmount'];
                        $wMethod = '';
                        $id = $_POST['wMethod'];
                        $wType = $_POST['wType'];
                        $wTo = $_POST['wTo'];
                        
                              $query = "select id from `admin_notification` where userId='$_COOKIE[userId]' and seen=0 and wAction<3 and action=0";
                           if(  $db->select($query)){
                               echo 'You can not send withdraw request untill your previous request accepted.';
                           }  else {
                               
                           

                        //after deposit user
                        $query = "select * from `admin_notification` where userId='$_COOKIE[userId]' and  notificationType=1 and seen=1 order by id desc limit 1";
                        $resulDepositWait = $db->select($query);
                        if ($resulDepositWait) {
                            $resulDepositWait = $resulDepositWait->fetch_assoc();
                            $resulDepositWaitAction = $resulDepositWait['actionAt'];
                            $tt = new DateTime($resulDepositWaitAction);
                            $diff = $tt->diff(new DateTime());
                            $minutes = ($diff->days * 24 * 60) +
                                    ($diff->h * 60) + $diff->i;
                            $minutes;
                            //rule
                            $query = "SELECT * FROM rule";
                            $resultsendingMoneyNumber = $db->select($query);
                            $rule = $resultsendingMoneyNumber->fetch_assoc();
                            $rule = $rule['waitingTimeAfterDeposit'];
                            if ($minutes >= $rule) {


                                //after win
                                $query = "select * from `bet` where userId='$_COOKIE[userId]' and  betStatus=1 order by id desc limit 1";
                                $resulDepositWait = $db->select($query);
                                if ($resulDepositWait) {
                                    $resulDepositWait = $resulDepositWait->fetch_assoc();
                                    $resulDepositWaitAction = $resulDepositWait['actionAt'];
                                    $tt = new DateTime($resulDepositWaitAction);
                                    $diff = $tt->diff(new DateTime());
                                    $minutes = ($diff->days * 24 * 60) +
                                            ($diff->h * 60) + $diff->i;
                                    $minutes;
                                    //rule
                                    $query = "SELECT * FROM rule";
                                    $resultsendingMoneyNumber = $db->select($query);
                                    $rule = $resultsendingMoneyNumber->fetch_assoc();
                                    $rule = $rule['waitingTime'];
                                    if ($minutes >= $rule) {


                                        $rate = 1;
                                        $query = "SELECT * FROM w_method where id='$id'";
                                        $resultMethod = $db->select($query);

                                        if ($resultMethod) {
                                            $Method = $resultMethod->fetch_assoc();
                                            $wMethod = $Method['method'];
                                            $rate = $Method['rate'];
                                        }


                                        $t = 2;


                                        if ($wAmount != "" && $id != "" && $wType != "" && $wTo != "") {


                                            if ($wAmount > 0.0) {
                                                $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                                                $resultBalanceCheck = $db->select($query);

                                                if ($resultBalanceCheck) {
                                                    $balance = $resultBalanceCheck->fetch_assoc();
                                                    $query = "SELECT * FROM `rule`";
                                                    $resultRule = $db->select($query);
                                                    $minimumBalance = $resultRule->fetch_assoc();
                                                    $minimumBalance = $minimumBalance['minimumBalance'];

                                                    if (($wAmount * $rate) <= ($balance['balance'] - $minimumBalance)) {
                                                        if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {

                                                            $query = "INSERT INTO `admin_notification`( `userId`, `withdraw`,`notificationType`, `pay_method`,`acc_type`,`to_number`,rate,time)"
                                                                    . " VALUES ('$_COOKIE[userId]','$wAmount','$t','$wMethod','$wType','$wTo','$rate','$dt')";
                                                            $resultBalance = $db->insert($query);


                                                            //update balance
                                                            $query = "SELECT * FROM `user` where userId='$_COOKIE[userId]'";
                                                            $resultUser = $db->select($query);
                                                            $userBalance = $resultUser->fetch_assoc();
                                                            $userBlc = $userBalance['balance'] - $wAmount;
                                                            $query = "update `user` set balance='$userBlc' WHERE userId='$_COOKIE[userId]'";
                                                            $db->update($query);

                                                            //transaction

                                                            $dis = 'withdraw';
                                                            $query = "INSERT INTO `transaction`( `debit`,`userId`, `description`,total,time)"
                                                                    . " VALUES ('$wAmount','$_COOKIE[userId]','$dis','$userBlc','$dt')";
                                                            $db->insert($query);

                                                            if ($resultBalance) {
                                                                
                                                            } else {
                                                                echo 'no';
                                                            }
                                                        } else {
                                                            echo ' Plz Login';
                                                        }
                                                    } else {
                                                        echo 'Not sufficient Balance minimum balance requred ' . $minimumBalance . '!! please deposit. ';
                                                    }
                                                } else {
                                                    echo 'Create Account';
                                                }
                                            } else {
                                                echo ' Please Insert Valid Amount !! ';
                                            }
                                        } else {
                                            echo 'Field is requred 2';
                                        }
                                    } else {
                                        $res = $rule - $minutes;
                                        echo 'you can withdraw after ' . $res . ' minutes';
                                    }
                                } else {

                                    $rate = 1;
                                    $query = "SELECT * FROM w_method where id='$id'";
                                    $resultMethod = $db->select($query);

                                    if ($resultMethod) {
                                        $Method = $resultMethod->fetch_assoc();
                                        $wMethod = $Method['method'];
                                        $rate = $Method['rate'];
                                    }


                                    $t = 2;
                                    if ($wAmount != "" && $id != "" && $wType != "" && $wTo != "") {


                                        if ($wAmount > 0.0) {
                                            $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                                            $resultBalanceCheck = $db->select($query);

                                            if ($resultBalanceCheck) {
                                                $balance = $resultBalanceCheck->fetch_assoc();
                                                $query = "SELECT * FROM `rule`";
                                                $resultRule = $db->select($query);
                                                $minimumBalance = $resultRule->fetch_assoc();
                                                $minimumBalance = $minimumBalance['minimumBalance'];

                                                if (($wAmount * $rate) <= ($balance['balance'] - $minimumBalance)) {
                                                    if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {

                                                        $query = "INSERT INTO `admin_notification`( `userId`, `withdraw`,`notificationType`, `pay_method`,`acc_type`,`to_number`,rate,time)"
                                                                . " VALUES ('$_COOKIE[userId]','$wAmount','$t','$wMethod','$wType','$wTo','$rate','$dt')";
                                                        $resultBalance = $db->insert($query);


                                                        //update balance
                                                        $query = "SELECT * FROM `user` where userId='$_COOKIE[userId]'";
                                                        $resultUser = $db->select($query);
                                                        $userBalance = $resultUser->fetch_assoc();
                                                        $userBlc = $userBalance['balance'] - $wAmount;
                                                        $query = "update `user` set balance='$userBlc' WHERE userId='$_COOKIE[userId]'";
                                                        $db->update($query);

                                                        //transaction

                                                        $dis = 'withdraw';
                                                        $query = "INSERT INTO `transaction`( `debit`,`userId`, `description`,total,time)"
                                                                . " VALUES ('$wAmount','$_COOKIE[userId]','$dis','$userBlc','$dt')";
                                                        $db->insert($query);

                                                        if ($resultBalance) {
                                                            
                                                        } else {
                                                            echo 'no';
                                                        }
                                                    } else {
                                                        echo ' Plz Login';
                                                    }
                                                } else {
                                                    echo 'Not sufficient Balance minimum balance requred ' . $minimumBalance . '!! please deposit. ';
                                                }
                                            } else {
                                                echo 'Create Account';
                                            }
                                        } else {
                                            echo ' Please Insert Valid Amount !! ';
                                        }
                                    } else {
                                        echo 'Field is requred ';
                                    }
                                }
                            } else {
                                $res = $rule - $minutes;
                                echo 'you can withdraw after ' . $res . ' minutes';
                            }
                        } else {

                            //after win
                            $query = "select * from `bet` where userId='$_COOKIE[userId]' and  betStatus=1 order by id desc limit 1";
                            $resulDepositWait = $db->select($query);
                            if ($resulDepositWait) {
                                $resulDepositWait = $resulDepositWait->fetch_assoc();
                                $resulDepositWaitAction = $resulDepositWait['actionAt'];
                                $tt = new DateTime($resulDepositWaitAction);
                                $diff = $tt->diff(new DateTime());
                                $minutes = ($diff->days * 24 * 60) +
                                        ($diff->h * 60) + $diff->i;
                                $minutes;
                                //rule
                                $query = "SELECT * FROM rule";
                                $resultsendingMoneyNumber = $db->select($query);
                                $rule = $resultsendingMoneyNumber->fetch_assoc();
                                $rule = $rule['waitingTime'];
                                if ($minutes >= $rule) {


                                    $rate = 1;
                                    $query = "SELECT * FROM w_method where id='$id'";
                                    $resultMethod = $db->select($query);

                                    if ($resultMethod) {
                                        $Method = $resultMethod->fetch_assoc();
                                        $wMethod = $Method['method'];
                                        $rate = $Method['rate'];
                                    }


                                    $t = 2;


                                    if ($wAmount != "" && $id != "" && $wType != "" && $wTo != "") {


                                        if ($wAmount > 0.0) {
                                            $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                                            $resultBalanceCheck = $db->select($query);

                                            if ($resultBalanceCheck) {
                                                $balance = $resultBalanceCheck->fetch_assoc();
                                                $query = "SELECT * FROM `rule`";
                                                $resultRule = $db->select($query);
                                                $minimumBalance = $resultRule->fetch_assoc();
                                                $minimumBalance = $minimumBalance['minimumBalance'];

                                                if (($wAmount * $rate) <= ($balance['balance'] - $minimumBalance)) {
                                                    if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {

                                                        $query = "INSERT INTO `admin_notification`( `userId`, `withdraw`,`notificationType`, `pay_method`,`acc_type`,`to_number`,rate,time)"
                                                                . " VALUES ('$_COOKIE[userId]','$wAmount','$t','$wMethod','$wType','$wTo','$rate','$id')";
                                                        $resultBalance = $db->insert($query);


                                                        //update balance
                                                        $query = "SELECT * FROM `user` where userId='$_COOKIE[userId]'";
                                                        $resultUser = $db->select($query);
                                                        $userBalance = $resultUser->fetch_assoc();
                                                        $userBlc = $userBalance['balance'] - $wAmount;
                                                        $query = "update `user` set balance='$userBlc' WHERE userId='$_COOKIE[userId]'";
                                                        $db->update($query);
                                                        //transaction

                                                        $dis = 'withdraw';
                                                        $query = "INSERT INTO `transaction`( `debit`,`userId`, `description`,total,time)"
                                                                . " VALUES ('$wAmount','$_COOKIE[userId]','$dis','$userBlc','$dt')";
                                                        $db->insert($query);

                                                        if ($resultBalance) {
                                                            
                                                        } else {
                                                            echo 'no';
                                                        }
                                                    } else {
                                                        echo ' Plz Login';
                                                    }
                                                } else {
                                                    echo 'Not sufficient Balance minimum balance requred ' . $minimumBalance . '!! please deposit. ';
                                                }
                                            } else {
                                                echo 'Create Account';
                                            }
                                        } else {
                                            echo ' Please Insert Valid Amount !! ';
                                        }
                                    } else {
                                        echo 'Field is requred 2';
                                    }
                                } else {
                                    $res = $rule - $minutes;
                                    echo 'you can withdraw after ' . $res . ' minutes';
                                }
                            } else {

                                $rate = 1;
                                $query = "SELECT * FROM w_method where id='$id'";
                                $resultMethod = $db->select($query);

                                if ($resultMethod) {
                                    $Method = $resultMethod->fetch_assoc();
                                    $wMethod = $Method['method'];
                                    $rate = $Method['rate'];
                                }


                                $t = 2;
                                if ($wAmount != "" && $id != "" && $wType != "" && $wTo != "") {


                                    if ($wAmount > 0.0) {
                                        $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                                        $resultBalanceCheck = $db->select($query);

                                        if ($resultBalanceCheck) {
                                            $balance = $resultBalanceCheck->fetch_assoc();
                                            $query = "SELECT * FROM `rule`";
                                            $resultRule = $db->select($query);
                                            $minimumBalance = $resultRule->fetch_assoc();
                                            $minimumBalance = $minimumBalance['minimumBalance'];

                                            if (($wAmount * $rate) <= ($balance['balance'] - $minimumBalance)) {
                                                if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {

                                                    $query = "INSERT INTO `admin_notification`( `userId`, `withdraw`,`notificationType`, `pay_method`,`acc_type`,`to_number`,rate,time)"
                                                            . " VALUES ('$_COOKIE[userId]','$wAmount','$t','$wMethod','$wType','$wTo','$rate','$dt')";
                                                    $resultBalance = $db->insert($query);


                                                    //update balance
                                                    $query = "SELECT * FROM `user` where userId='$_COOKIE[userId]'";
                                                    $resultUser = $db->select($query);
                                                    $userBalance = $resultUser->fetch_assoc();
                                                    $userBlc = $userBalance['balance'] - $wAmount;
                                                    $query = "update `user` set balance='$userBlc' WHERE userId='$_COOKIE[userId]'";
                                                    $db->update($query);

                                                    //transaction

                                                    $dis = 'withdraw';
                                                    $query = "INSERT INTO `transaction`( `debit`,`userId`, `description`,total,time)"
                                                            . " VALUES ('$wAmount','$_COOKIE[userId]','$dis','$userBlc','$dt')";
                                                    $db->insert($query);
                                                    if ($resultBalance) {
                                                        
                                                    } else {
                                                        echo 'no';
                                                    }
                                                } else {
                                                    echo ' Plz Login';
                                                }
                                            } else {
                                                echo 'Not sufficient Balance minimum balance requred ' . $minimumBalance . '!! please deposit. ';
                                            }
                                        } else {
                                            echo 'Create Account';
                                        }
                                    } else {
                                        echo ' Please Insert Valid Amount !! ';
                                    }
                                } else {
                                    echo 'Field is requred ';
                                }
                            }
                        }
                    }
                    } else {
                        echo 'password not match';
                    }
                }
            } else {
                echo 'please login';
            }

            //balance transfer
        } else if (isset($_POST['transferAmount']) && isset($_POST['to_userId']) && isset($_POST['notes'])) {
            $transferPassword = $_POST['transferPassword'];
            $query = "select * from `user` where userId='$_COOKIE[userId]' and  password='$transferPassword'";
            if ($db->select($query)) {

                $query = "SELECT id FROM `club` WHERE personalIdOfClub='$_COOKIE[userId]' or personalIdOfClub='$_POST[to_userId]'";
                if ($db->select($query)) {

                    $query = "select * from `admin_notification` where userId='$_COOKIE[userId]' and  notificationType=1 order by id desc limit 1";
                    $resulDepositWait = $db->select($query);
                    if ($resulDepositWait) {
                        $resulDepositWait = $resulDepositWait->fetch_assoc();
                        $resulDepositWaitAction = $resulDepositWait['actionAt'];
                        $tt = new DateTime($resulDepositWaitAction);
                        $diff = $tt->diff(new DateTime());
                        $minutes = ($diff->days * 24 * 60) +
                                ($diff->h * 60) + $diff->i;
                        $minutes;
                        //rule
                        $query = "SELECT * FROM rule";
                        $resultsendingMoneyNumber = $db->select($query);
                        $rule = $resultsendingMoneyNumber->fetch_assoc();
                        $rule = $rule['waitingTimeAfterDeposit'];
                        if ($minutes >= $rule) {


                            $transferAmount = $_POST['transferAmount'];
                            $to_userId = $_POST['to_userId'];
                            $notes = $_POST['notes'];

                            $t = 2;
                            if ($transferAmount != "" && $to_userId != "" && $notes != "") {


                                if ($transferAmount > 0.0) {
                                    $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                                    $resultBalanceCheck = $db->select($query);

                                    if ($resultBalanceCheck) {
                                        $balance = $resultBalanceCheck->fetch_assoc();
                                        $query = "SELECT * FROM `rule`";
                                        $resultRule = $db->select($query);
                                        $minimumBalance = $resultRule->fetch_assoc();
                                        $minimumBalance = $minimumBalance['minimumBalance'];

                                        if ($transferAmount <= ($balance['balance'] - $minimumBalance)) {
                                            if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {

                                                $query = "SELECT * FROM `user` WHERE userId='$to_userId'";
                                                $resultTo_userId = $db->select($query);

                                                if ($resultTo_userId) {
                                                    $balanceToUserId = $resultTo_userId->fetch_assoc();
                                                    $blncToUserId = $balanceToUserId['balance'];

                                                    $blncToUserId+=$transferAmount;
                                                    $balance = $balance['balance'] - $transferAmount;
                                                    $query = "update `user` set balance='$blncToUserId' WHERE userId='$to_userId'";
                                                    $result = $db->update($query);
                                                    $query = "update `user` set balance='$balance' WHERE userId='$_COOKIE[userId]'";
                                                    $result = $db->update($query);

                                                    //transaction from

                                                    $dis = 'balance transfer to ' . $to_userId;
                                                    $query = "INSERT INTO `transaction`( `debit`,`userId`, `description`,total,time)"
                                                            . " VALUES ('$transferAmount','$_COOKIE[userId]','$dis','$balance','$dt')";
                                                    $db->insert($query);
                                                    //transaction to

                                                    $dis = 'balance transfer from ' . $_COOKIE['userId'];
                                                    $query = "INSERT INTO `transaction`( `credit`,`userId`, `description`,total,time)"
                                                            . " VALUES ('$transferAmount','$to_userId','$dis','$blncToUserId','$dt')";
                                                    $db->insert($query);

                                                    //
                                                    $query = "INSERT INTO `balance_transfer`(`userId`, `to_userId`, `amount`,notes,time)"
                                                            . " VALUES ('$_COOKIE[userId]','$to_userId','$transferAmount','$notes','$dt')";
                                                    $resultBalance = $db->insert($query);

                                                    if ($resultBalance) {
                                                        
                                                    } else {
                                                        echo 'no';
                                                    }
                                                } else {
                                                    echo ' To user Id not Found!';
                                                }
                                            } else {
                                                echo ' Plz Login';
                                            }
                                        } else {
                                            echo 'Not sufficient Balance minimum balance requred ' . $minimumBalance . '!! please deposit. ';
                                        }
                                    } else {
                                        echo 'Create Account';
                                    }
                                } else {
                                    echo ' Please Insert Valid Amount !! ';
                                }
                            } else {
                                echo 'Field is requred';
                            }
                        } else {
                            $res = $rule - $minutes;
                            echo 'you can transfer balance after ' . $res . ' minutes';
                        }
                    } else {

                        $transferAmount = $_POST['transferAmount'];
                        $to_userId = $_POST['to_userId'];
                        $notes = $_POST['notes'];

                        $t = 2;
                        if ($transferAmount != "" && $to_userId != "" && $notes != "") {


                            if ($transferAmount > 0.0) {
                                $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                                $resultBalanceCheck = $db->select($query);

                                if ($resultBalanceCheck) {
                                    $balance = $resultBalanceCheck->fetch_assoc();
                                    $query = "SELECT * FROM `rule`";
                                    $resultRule = $db->select($query);
                                    $minimumBalance = $resultRule->fetch_assoc();
                                    $minimumBalance = $minimumBalance['minimumBalance'];

                                    if ($transferAmount <= ($balance['balance'] - $minimumBalance)) {
                                        if (isset($_COOKIE["userId"]) && isset($_COOKIE["password"]) && isset($_COOKIE["id"])) {

                                            $query = "SELECT * FROM `user` WHERE userId='$to_userId'";
                                            $resultTo_userId = $db->select($query);

                                            if ($resultTo_userId) {
                                                $balanceToUserId = $resultTo_userId->fetch_assoc();
                                                $blncToUserId = $balanceToUserId['balance'];

                                                $blncToUserId+=$transferAmount;
                                                $balance = $balance['balance'] - $transferAmount;
                                                $query = "update `user` set balance='$blncToUserId' WHERE userId='$to_userId'";
                                                $result = $db->update($query);
                                                $query = "update `user` set balance='$balance' WHERE userId='$_COOKIE[userId]'";
                                                $result = $db->update($query);

                                                //transaction from

                                                $dis = 'balance transfer to ' . $to_userId;
                                                $query = "INSERT INTO `transaction`( `debit`,`userId`, `description`,total,time)"
                                                        . " VALUES ('$transferAmount','$_COOKIE[userId]','$dis','$balance','$dt')";
                                                $db->insert($query);
                                                //transaction to

                                                $dis = 'balance transfer from ' . $_COOKIE['userId'];
                                                $query = "INSERT INTO `transaction`( `credit`,`userId`, `description`,total,time)"
                                                        . " VALUES ('$transferAmount','$to_userId','$dis','$blncToUserId','$dt')";
                                                $db->insert($query);

                                                //
                                                $query = "INSERT INTO `balance_transfer`(`userId`, `to_userId`, `amount`,notes,time)"
                                                        . " VALUES ('$_COOKIE[userId]','$to_userId','$transferAmount','$notes','$dt')";
                                                $resultBalance = $db->insert($query);

                                                if ($resultBalance) {
                                                    
                                                } else {
                                                    echo 'no';
                                                }
                                            } else {
                                                echo ' To user Id not Found!';
                                            }
                                        } else {
                                            echo ' Plz Login';
                                        }
                                    } else {
                                        echo 'Not sufficient Balance minimum balance requred ' . $minimumBalance . '!! please deposit. ';
                                    }
                                } else {
                                    echo 'Create Account';
                                }
                            } else {
                                echo ' Please Insert Valid Amount !! ';
                            }
                        } else {
                            echo 'Field is requred';
                        }
                    }
                } else {
                    echo 'user to user balance transfer not allow !';
                }
            } else {
                echo 'password not match';
            }
        } else if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];


            $t = 2;
            $resultUser = '';
            if ($currentPassword != "" && $newPassword != "" && $confirmPassword != "") {


                if (isset($_COOKIE['club'])) {
                    $query = "SELECT * FROM `club` WHERE userId='$_COOKIE[userId]'";
                    $resultUser = $db->select($query);
                } else {
                    $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                    $resultUser = $db->select($query);
                }


                if ($resultUser) {
                    $password = $resultUser->fetch_assoc();
                    if ($password['password'] == $currentPassword) {
                        if (isset($_COOKIE['club'])) {
                            $query = "update `club` set password='$newPassword' WHERE userId='$_COOKIE[userId]'";
                            $result = $db->update($query);
                        } else {
                            $query = "update `user` set password='$newPassword' WHERE userId='$_COOKIE[userId]'";
                            $result = $db->update($query);
                        }
                    } else {
                        echo 'Sorry password not found';
                    }
                } else {

                    echo 'Create Account';
                }
            } else {
                echo 'Field is requred ';
            }
        } else if (isset($_POST['sendCode'])) {
            $sendCode = $_POST['sendCode'];

            $letters = '0123456789';
            $len = strlen($letters);
            $letter = $letters[rand(0, $len - 1)];

            $word = "";
            $number = '';
            for ($i = 0; $i < 6; $i++) {
                $letter = $letters[rand(0, $len - 1)];
                $word .= $letter;
            }
            if (isset($_COOKIE['club'])) {
                $query = "SELECT * FROM `club` WHERE userId='$_COOKIE[userId]'";
                $resultUser = $db->select($query);
            } else {
                $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]'";
                $resultUser = $db->select($query);
            }


            if ($resultUser) {
                $number = $resultUser->fetch_assoc();
                $number = $number['mobileNumber'];
            }
            if ($sendCode != "") {
                $query = "SELECT * FROM `userverifynumber` WHERE userId='$_COOKIE[userId]'";


            } else {
                echo 'Field is requred ';
            }
        } else if (isset($_POST['confirmCode'])) {
            $code = $_POST['code'];


            if ($code != "") {
                $query = "SELECT * FROM `userverifynumber` WHERE userId='$_COOKIE[userId]' and code='$code'";
                if ($db->select($query)) {
                    $timeCheck = $db->select($query)->fetch_assoc();
                    $tt = new DateTime($timeCheck['time']);
                    $diff = $tt->diff(new DateTime());
                    $minutes = ($diff->days * 24 * 60) +
                            ($diff->h * 60) + $diff->i;
                    $minutes;
                    if ($minutes <= 4) {
                        $query = "update `userverifynumber` set status='1' WHERE userId='$_COOKIE[userId]'";
                        $result = $db->update($query);
                    } else {
                        echo 'time expired';
                    }
                } else {
                    echo 'code not match';
                }
            } else {
                echo 'Field is requred ';
            }
        } else if (isset($_POST['cClub']) && isset($_POST['PasswordClubChange'])) {
            $cClub = $_POST['cClub'];
            $PasswordClubChange = $_POST['PasswordClubChange'];


            if ($cClub != "" && $PasswordClubChange != "") {

                $query = "SELECT * FROM `user` WHERE userId='$_COOKIE[userId]' and password='$PasswordClubChange'";
                $resultUser = $db->select($query);



                if ($resultUser) {

                    $query = "update `user` set clubId='$cClub' WHERE userId='$_COOKIE[userId]'";
                    $result = $db->update($query);
                } else {

                    echo 'password not match';
                }
            } else {
                echo 'Field is requred ';
            }
        } else {
            echo 'Field is requred ';
        }
    } else {
        echo 'You are inactivated !! ';
    }
} else {
    echo 'please login';
}
?>