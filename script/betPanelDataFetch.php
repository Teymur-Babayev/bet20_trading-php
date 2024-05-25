<?php
session_start();
include '../lib/Database.php';
$db = new Database();
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt = $dt->format('d M Y g:i A');
if (isset($_COOKIE['adminPanel'])) {
    $operator = $_COOKIE['adminPanel'];
    $adminId = $_COOKIE['adminId'];
} else {
    $operator = $_SESSION['adminPanel'];
    $adminId = $_SESSION['adminId'];
}
if (isset($_POST['match_id'])) {
    $output = '';
    $match_id = $_POST['match_id'];
    $query = "SELECT * FROM betting_title WHERE id ='$match_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        // echo json_encode($row);
        $output.=$row['A_team'] . ' VS ' . $row['B_team'];
        echo $output;
    }
} else if (isset($_POST['updateMatchSelect'])) {
    $output = array();
    $match_id = $_POST['updateMatchSelect'];
    $query = "SELECT * FROM betting_title WHERE id ='$match_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        // $output['A_team']=$row['A_team'];
        echo json_encode($row);

        // echo $output;
    }
} else if (isset($_POST['updateAnsSelect'])) {

    $match_id = $_POST['updateAnsSelect'];
    $query = "SELECT * FROM betting_sub_title_option WHERE id ='$match_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        // $output['A_team']=$row['A_team'];
        echo json_encode($row);

        // echo $output;
    }
} else if (isset($_POST['toLive'])) {
    $BettingSubTitleOptionId = $_POST['toLive'];
    if ($BettingSubTitleOptionId != '') {

        $query = "update `betting_title` set status='1' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
    }

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['hiddenToPanel'])) {
    $matchId = $_POST['hiddenToPanel'];
    if ($matchId != '') {

        $query = "DELETE FROM `hiddenmatch` WHERE  matchId='$matchId' and adminId='$adminId'";
        $result = $db->delete($query);
    }
} else if (isset($_POST['defaultHiddenToLiveId'])) {
    $matchId = $_POST['defaultHiddenToLiveId'];
    if ($matchId != '') {

    $query = "update `betting_subtitle` set section_hide='1' WHERE id='$matchId'";
        $result = $db->update($query);
    }
} else if (isset($_POST['updateQuestionSelect'])) {

    $question_id = $_POST['updateQuestionSelect'];
    $query = "SELECT * FROM betting_subtitle WHERE id ='$question_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    }
} else if (isset($_POST['limitAnsSelect'])) {

    $ans_id = $_POST['ans_id_for_limitSelect'];
    $query = "SELECT * FROM betting_sub_title_option WHERE id ='$ans_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    }
} else if (isset($_POST['question_id'])) {
    $output = '';
    $question_id = $_POST['question_id'];
    $query = "SELECT * FROM betting_subtitle WHERE id ='$question_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        // echo json_encode($row);
        $output.=$row['title'];
        echo $output;
    }
} else if (isset($_POST['addMatch'])) {
    $A_team = $_POST['A_team'];
    $B_team = $_POST['B_team'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $gameType = $_POST['gameType'];

    if ($A_team != '' && $B_team != '' && $title != '' && $date != '' && $status != '' && $gameType != '') {



        $query = "INSERT INTO `betting_title`(`A_team`, `B_team`, `title`, `date`, `status`, `gameType`,user)"
                . " VALUES ('$A_team','$B_team','$title','$date','$status','$gameType','$operator')";
        $resultClubInsert = $db->insert($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

  
} else if (isset($_POST['addMatchDefault'])) {
    $A_team = $_POST['A_team'];
    $B_team = $_POST['B_team'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $status2 = $_POST['status2'];
    $gameType = $_POST['gameType'];

    if ($status != '' && $gameType != '') {



        if ($status2 == '1' || $status2 == '2' || $status2 == '3') {
            $query = "SELECT * FROM `default_match` where gameType='$gameType' and status='$status2'";
        } else {
            $query = "SELECT * FROM `default_match` where gameType='$gameType'";
        }

        $resultBettingTitle = $db->select($query);

        if ($resultBettingTitle) {
            $bettingTitle = $resultBettingTitle->fetch_assoc();
            //insert default to main table
            $query = "INSERT INTO `betting_title`(`A_team`, `B_team`, `title`, `date`, `status`, `gameType`,user)"
                    . " VALUES ('$A_team','$B_team','$title','$date','$status','$gameType','$operator')";
            $resultClubInsert = $db->insert($query);
            // select match id
            $query = "SELECT id FROM `betting_title` order by id desc limit 1";
            $resultBettingTitleId = $db->select($query);
            $bettingTitleId = '';
            if ($resultBettingTitleId) {
                $bettingTitleId = $resultBettingTitleId->fetch_assoc();
            }

            $query = "SELECT * FROM `default_ques` WHERE bettingId='$bettingTitle[id]'";
            $resultBettingSubTitle = $db->select($query);


            if ($resultBettingSubTitle) {
                while ($bettingSubTitle = $resultBettingSubTitle->fetch_assoc()) {

                    //insert default to main table
                    $query = "INSERT INTO `betting_subtitle`( `title`, `bettingId`,section_ct,section_hide)"
                            . " VALUES ('$bettingSubTitle[title]','$bettingTitleId[id]','$bettingSubTitle[section_ct]','0')";
                    $resultClubInsert = $db->insert($query);
                    // select question id
                    $query = "SELECT id FROM `betting_subtitle` order by id desc limit 1";
                    $resultQuestionId = $db->select($query);
                    $QuestionId = '';
                    if ($resultQuestionId) {
                        $QuestionId = $resultQuestionId->fetch_assoc();
                    }

                    $query = "SELECT * FROM `default_ans` WHERE  bettingSubTitleId='$bettingSubTitle[id]'";
                    $resultBettingSubTitleOption = $db->select($query);

                    if ($resultBettingSubTitleOption) {
                        while ($BettingSubTitleOption = $resultBettingSubTitleOption->fetch_assoc()) {
                            $team='';
                            if($BettingSubTitleOption['title']=="A"){
                                $team=$A_team;
                            }else if ($BettingSubTitleOption['title']=="B"){
                                     $team=$B_team;
                            }  else {
                                     $team=$BettingSubTitleOption['title'];
                            }
                            $query = "INSERT INTO `betting_sub_title_option`(`title`, `amount`, `bettingSubTitleId`)"
                                    . " VALUES ('$team','$BettingSubTitleOption[amount]','$QuestionId[id]')";
                            $resultClubInsert = $db->insert($query);
                        }
                    }
                }
            }
        }
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }


} else if (isset($_POST['updateMatch'])) {
    $A_team = $_POST['A_team'];
    $B_team = $_POST['B_team'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $gameType = $_POST['gameType'];
    $matchId = $_POST['match_id_for_update'];
    if ($A_team != '' && $B_team != '' && $title != '' && $date != '' && $status != '' && $gameType != '') {




        $query = "UPDATE `betting_title` SET "
                . "`A_team`='$A_team',"
                . "`B_team`='$B_team',"
                . "`title`='$title',"
                . "`date`='$date',"
                . "`status`='$status',"
                . "`gameType`='$gameType'"
                . " WHERE id='$matchId'";
        $resultClubInsert = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }
    $db->update($query);

} else if (isset($_POST['updateQuestion'])) {
    $editQuestionId = $_POST['question_id_for_update'];
    $editQuestion = $_POST['editQuestion'];
    if ($editQuestionId != '') {

        $query = "update `betting_subtitle` set title='$editQuestion' WHERE id='$editQuestionId'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }


   
} else if (isset($_POST['updateAns'])) {
    $editBetRate = $_POST['editRateAmount'];
 
    $BettingSubTitleOptionId = $_POST['ans_id_for_update'];
    if ($editBetRate != '') {

        $query = "update `betting_sub_title_option` set amount='$editBetRate' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }


} else if (isset($_POST['updateAnsT'])) {
    
    $editAnswer = $_POST['editAnswer'];
    $BettingSubTitleOptionId = $_POST['ans_id_for_update'];
    if ( $editAnswer != '') {

        $query = "update `betting_sub_title_option` set title='$editAnswer' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

   
} else if (isset($_POST['addQuestion'])) {
    $input_field = $_POST['addQuestion'];
    $match_id = $_POST['match_id_for_q'];



    if ($input_field != '') {

        $query = "INSERT INTO `betting_subtitle`( `title`, `bettingId`)"
                . " VALUES ('$input_field','$match_id')";
        $resultClubInsert = $db->insert($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

 
} else if (isset($_POST['addAns'])) {
    $title = $_POST['addAns'];
    $rate = $_POST['addAnsRate'];
    $questionIdForAddAns = $_POST['questionIdForAddAns'];



    if ($title != '' && $rate != '') {

        $query = "INSERT INTO `betting_sub_title_option`(`title`, `amount`, `bettingSubTitleId`)"
                . " VALUES ('$title','$rate','$questionIdForAddAns')";
        $resultClubInsert = $db->insert($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

   
} else if (isset($_POST['match_id_for_limit'])) {
    $input_field = $_POST['limitRateForMatch'];
    $match_id = $_POST['match_id_for_limit'];



    if ($input_field != '') {

        $query = "update `betting_title` set limitedAmount='$input_field' WHERE id='$match_id'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

   
} else if (isset($_POST['match_id_for_score'])) {
    $input_field = $_POST['score'];
    $match_id = $_POST['match_id_for_score'];



    if ($input_field != '') {

        $query = "update `betting_title` set liveScore='$input_field' WHERE id='$match_id'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

   
} else if (isset($_POST['match_id_for_wait'])) {
    $input_field = $_POST['matchWaittingRate'];
    $match_id = $_POST['match_id_for_wait'];



    if ($input_field != '') {

        $query = "update `betting_title` set waittingTime='$input_field' WHERE id='$match_id'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

   
} else if (isset($_POST['match_id_for_stop'])) {
    $match_id = $_POST['match_id_for_stop'];
    $query = "update `betting_title` set showStatus='0' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['closeMatch'])) {
    $closeMatch = $_POST['closeMatch'];
    if ($closeMatch != '') {
        $query = "update `betting_title` set close=1,close_time='$dt' WHERE id='$closeMatch'";
        $result = $db->delete($query);
    }

 
} else if (isset($_POST['deleteMatch'])) {
    $deleteMatch = $_POST['deleteMatch'];
    if ($deleteMatch != '') {
        $query = "DELETE FROM `betting_title` WHERE id='$deleteMatch'";
        $result = $db->delete($query);
        if ($result) {
            $query = "SELECT * FROM `betting_subtitle` WHERE bettingId='$deleteMatch'";
            $result = $db->select($query);
            if ($result) {
                foreach ($result as $ques) {
                    $quesId = $ques['id'];
                    $query = "DELETE FROM `betting_sub_title_option` WHERE bettingSubTitleId='$quesId'";
                    $db->delete($query);
                }
            }
            $query = "DELETE FROM `betting_subtitle` WHERE bettingId='$deleteMatch'";
            $result = $db->delete($query);
        }
    }


} else if (isset($_POST['closeQuestion'])) {
    $closeQuestion = $_POST['closeQuestion'];
    if ($closeQuestion != '') {
        $query = "update `betting_subtitle` set close=1 WHERE id='$closeQuestion'";
        $result = $db->update($query);
    }
} else if (isset($_POST['deleteQuestion'])) {
    $deleteQuestion = $_POST['deleteQuestion'];
    if ($deleteQuestion != '') {
        $query = "DELETE FROM `betting_subtitle`  WHERE id='$deleteQuestion'";
        $result = $db->delete($query);
        if ($result) {
            $query = "DELETE FROM `betting_sub_title_option`  WHERE bettingSubTitleId='$deleteQuestion'";
            $result = $db->delete($query);
        }
    }

   
} else if (isset($_POST['deleteAns'])) {
    $deleteAnswer = $_POST['deleteAns'];
    if ($deleteAnswer != '') {
        $query = "DELETE FROM `betting_sub_title_option`  WHERE id='$deleteAnswer'";
        $result = $db->delete($query);
    }

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['match_id_for_active'])) {
    $match_id = $_POST['match_id_for_active'];
    $query = "update `betting_title` set showStatus='1' WHERE id='$match_id'";
    $result = $db->update($query);


} else if (isset($_POST['match_id_for_hide'])) {
    $match_id = $_POST['match_id_for_hide'];
    $query = "update `betting_title` set hide='0' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['match_id_for_show'])) {
    $match_id = $_POST['match_id_for_show'];
    $query = "update `betting_title` set hide='1' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['match_id_for_aria_hide'])) {
    $match_id = $_POST['match_id_for_aria_hide'];
    $query = "update `betting_title` set ariaHide='0' WHERE id='$match_id'";
    $result = $db->update($query);

   
} else if (isset($_POST['match_id_for_aria_show'])) {
    $match_id = $_POST['match_id_for_aria_show'];
    $query = "update `betting_title` set ariaHide='1' WHERE id='$match_id'";
    $result = $db->update($query);


} else if (isset($_POST['match_id_for_HideFromPanel'])) {
    $match_id = $_POST['match_id_for_HideFromPanel'];
    $query = "INSERT INTO `hiddenmatch`(`matchId`, `adminId`)"
            . " VALUES ('$match_id','$adminId')";
    $result = $db->insert($query);

//question
} else if (isset($_POST['question_id_for_limit'])) {
    $input_field = $_POST['limitRateForQuestion'];
    $question_id = $_POST['question_id_for_limit'];



    if ($input_field != '') {

        $query = "update `betting_subtitle` set limitedAmount='$input_field' WHERE id='$question_id'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }


  
} else if (isset($_POST['ans_id_for_limit'])) {
    $input_field = $_POST['limitRateForAns'];
    $ans_id = $_POST['ans_id_for_limit'];



    if ($input_field != '') {

        $query = "update `betting_sub_title_option` set limitedAmount='$input_field' WHERE id='$ans_id'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }


} else if (isset($_POST['question_id_for_wait'])) {
    $input_field = $_POST['questionhWaittingRate'];
    $question_id = $_POST['question_id_for_wait'];



    if ($input_field != '') {

        $query = "update `betting_subtitle` set waittingTime='$input_field' WHERE id='$question_id'";
        $result = $db->update($query);
        ?>

        <div  class="alert alert-success " id="success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Ok !!</strong>      Success!.
        </div>
        <?php
    } else {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> All field is required.
        </div>
        <?php
    }

 
} else if (isset($_POST['question_id_for_stop'])) {
    $match_id = $_POST['question_id_for_stop'];
    $query = "update `betting_subtitle` set showStatus='0' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['question_id_for_active'])) {
    $match_id = $_POST['question_id_for_active'];
    $query = "update `betting_subtitle` set showStatus='1' WHERE id='$match_id'";
    $result = $db->update($query);
    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['question_id_for_hide'])) {
    $match_id = $_POST['question_id_for_hide'];
    $query = "update `betting_subtitle` set hide='0' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['question_id_for_show'])) {
    $match_id = $_POST['question_id_for_show'];
    $query = "update `betting_subtitle` set hide='1' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['question_id_for_aria_hide'])) {
    $match_id = $_POST['question_id_for_aria_hide'];
    $query = "update `betting_subtitle` set ariaHide='0' WHERE id='$match_id'";
    $result = $db->update($query);

    
} else if (isset($_POST['question_id_for_aria_show'])) {
    $match_id = $_POST['question_id_for_aria_show'];
    $query = "update `betting_subtitle` set ariaHide='1' WHERE id='$match_id'";
    $result = $db->update($query);

   
} else if (isset($_POST['question_id_for_HideFromPanel'])) {
    $match_id = $_POST['question_id_for_HideFromPanel'];
    $query = "update `betting_subtitle` set hideFromPanel='1' WHERE id='$match_id'";
    $result = $db->update($query);

  

    //ans
} else if (isset($_POST['ans_id_for_stop'])) {
    $match_id = $_POST['ans_id_for_stop'];
    $query = "update `betting_sub_title_option` set showStatus='0' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['ans_id_for_active'])) {
    $match_id = $_POST['ans_id_for_active'];
    $query = "update `betting_sub_title_option` set showStatus='1' WHERE id='$match_id'";
    $result = $db->update($query);
    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['ans_id_for_hide'])) {
    $match_id = $_POST['ans_id_for_hide'];
    $query = "update `betting_sub_title_option` set hide='0' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
} else if (isset($_POST['ans_id_for_show'])) {
    $match_id = $_POST['ans_id_for_show'];
    $query = "update `betting_sub_title_option` set hide='1' WHERE id='$match_id'";
    $result = $db->update($query);

    //user refresh
    $query = "UPDATE `user` SET refresh='1'";
    $result = $db->update($query);
}
?>