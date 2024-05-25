<?php
include './lib/Database.php';
$db = new Database();
$data = array();
if (isset($_POST['bettingTitle'])) {
    $bettingTitle = $_POST['bettingTitle'];
    $bettingSubTitle = $_POST['bettingSubTitle'];
    $BettingSubTitleOption = $_POST['BettingSubTitleOption'];

    $query = "SELECT * FROM `betting_title` where id='$bettingTitle'";
    $resultBettingTitle = $db->select($query);

    if ($resultBettingTitle) {
        $bettingTitle = $resultBettingTitle->fetch_assoc();
        $data['bettingTitle']=$bettingTitle['A_team'].' vs '.$bettingTitle['B_team'].' <> '.$bettingTitle['title'].' <> '. $bettingTitle['date'];
        
        $query = "SELECT * FROM `betting_subtitle` where id='$bettingSubTitle'";
        $resulbettingSubTitle = $db->select($query);
        if ($resulbettingSubTitle) {
            $bettingSubTitle = $resulbettingSubTitle->fetch_assoc();
            $data['bettingSubTitle'] = $bettingSubTitle['title'];
            $query = "SELECT * FROM `betting_sub_title_option` where id='$BettingSubTitleOption'";
            $resulBettingSubTitleOption = $db->select($query);

            if ($resulBettingSubTitleOption) {
                $BettingSubTitleOption = $resulBettingSubTitleOption->fetch_assoc();
                $data['BettingSubTitleOption'] = $BettingSubTitleOption['title'];
                 $data['betRate'] = $BettingSubTitleOption['amount'];
                //$data['betId'] = $BettingSubTitleOption['id'];
                
            }
        }
    }
} else {
    echo 'no';
}
$data =json_encode($data);
echo $data;
//header("Content-type: application/json");
?>