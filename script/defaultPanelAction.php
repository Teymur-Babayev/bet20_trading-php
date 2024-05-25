<?php

include '../lib/Database.php';
$db = new Database();
?>
<?php

// 1st label
//Match Close

if (isset($_GET['deleteMatch'])) {

    $deleteMatch = $_GET['deleteMatch'];
    if ($deleteMatch != '') {
        $query = "DELETE FROM `default_match` WHERE id='$deleteMatch'";
        $result = $db->delete($query);
        if ($result) {
            $query = "SELECT * FROM `default_ques` WHERE bettingId='$deleteMatch'";
            $result = $db->select($query);
            if ($result) {
                foreach ($result as $ques) {
                    $quesId = $ques['id'];
                    $query = "DELETE FROM `default_ans` WHERE bettingSubTitleId='$quesId'";
                    $db->delete($query);
                }
            }
            $query = "DELETE FROM `default_ques` WHERE bettingId='$deleteMatch'";
            $result = $db->delete($query);
        }
    }

}


if (isset($_POST['bettingTitleAriaHide'])) {

    $BettingSubTitleOptionId = $_POST['bettingTitleId'];
    if ($BettingSubTitleOptionId != '') {

        $query = "update `default_match` set ariaHide='0' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
     
    }
}

if (isset($_POST['bettingTitleAriaShow'])) {

    $BettingSubTitleOptionId = $_POST['bettingTitleId'];
    if ($BettingSubTitleOptionId != '') {

        $query = "update `default_match` set ariaHide='1' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
     
    }
}

if (isset($_POST['editBetRate'])) {
    $editBetRate = $_POST['editRateAmount'];
    $editAnswer = $_POST['editAnswer'];
    $BettingSubTitleOptionId = $_POST['BettingSubTitleOptionId'];
    if ($editBetRate != '') {

        $query = "update `default_ans` set amount='$editBetRate',title='$editAnswer' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
 
    }
}


//2nd label

if (isset($_POST['bettingSubTitleAriaHide'])) {

    $BettingSubTitleOptionId = $_POST['bettingSubTitleId'];
    if ($BettingSubTitleOptionId != '') {

        $query = "update `default_ques` set ariaHide='0' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
    
    } else {
        
    }
}

if (isset($_POST['bettingSubTitleAriaShow'])) {

    $BettingSubTitleOptionId = $_POST['bettingSubTitleId'];
    if ($BettingSubTitleOptionId != '') {

        $query = "update `default_ques` set ariaHide='1' WHERE id='$BettingSubTitleOptionId'";
        $result = $db->update($query);
      
    } else {
        
    }
}
//edit
if (isset($_POST['submitQuestion'])) {

    $editQuestionId = $_POST['editQuestionId'];
    $editQuestion = $_POST['editQuestion'];
    if ($editQuestionId != '') {

        $query = "update `default_ques` set title='$editQuestion' WHERE id='$editQuestionId'";
        $result = $db->update($query);
   
    } else {
        
    }
}
//delete
if (isset($_GET['deleteQuestion'])) {

    $deleteQuestion = $_GET['deleteQuestion'];
    if ($deleteQuestion != '') {

        $query = "DELETE FROM `default_ques`  WHERE id='$deleteQuestion'";
        $result = $db->delete($query);
        if ($result) {
            $query = "DELETE FROM `default_ans`  WHERE bettingSubTitleId='$deleteQuestion'";
            $result = $db->delete($query);
     
    } else {
        
    }
}

}
if (isset($_GET['deleteAnswer'])) {

    $deleteAnswer = $_GET['deleteAnswer'];
    if ($deleteAnswer != '') {

        $query = "DELETE FROM `default_ans`  WHERE id='$deleteAnswer'";
        $result = $db->delete($query);
   
    } 
}
if (isset($_COOKIE['adminType'])) {
    $adminType = $_COOKIE['adminType'];
} else {
    $adminType = $_SESSION['adminType'];
}
if ($adminType==1) {
 header("location:defaultSetting.php");
} else {
  header("location:defaultSecond.php");
}
?>   
           
     


