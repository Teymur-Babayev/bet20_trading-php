<?php
include './lib/Database.php';
$db = new Database();
$output = '';
?>
<?php
$query = "SELECT * FROM `betting_title` where status=1 and gameType=2 and close=0 ORDER BY date asc";
$resultBettingTitle = $db->select($query);
$i = 0;
if ($resultBettingTitle) {
    while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {

        $i++;
        ?>
        <?php
        if ($bettingTitle['hide']) {
            ?>
            <div class="panel panel-default panel2">
                <?php
                if ($bettingTitle['showStatus'] == 0) {
                    ?>
                    <div style="background: #46555D !important;" class="panel-heading first-lebal" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>">
                        <?php
                    } else {
                        ?>
                        <div class="panel-heading first-lebal" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>">
                            <?php
                        }
                        ?>

                        <h4 style="cursor: pointer" class="panel-title"  role="button" data-toggle="collapse"  href="#collapseOne<?php echo $bettingTitle['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $bettingTitle['id'] ?>">

                            <?php
                            if ($bettingTitle['gameType'] == 1) {
                                ?>
                                <img src="./img/1393757333.png" width="27px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?>  
                                <?php
                            } else if ($bettingTitle['gameType'] == 2) {
                                ?>
                                <img src="./img/ka-pl.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                                <?php
                            } else {
                                ?>

                                <img src="./img/basket.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                                <?php
                            }
                            ?>

                        </h4>
                    </div>
                    <div id="collapseOne<?php echo $bettingTitle['id'] ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne<?php echo $bettingTitle['id'] ?>">
                        <div class="panel-body" style="padding: 0px;">
                            <?php
                            $query = "SELECT * FROM `betting_subtitle` WHERE bettingId='$bettingTitle[id]' and close=0";
                            $resultBettingSubTitle = $db->select($query);
                            $i = 0;
                            if ($resultBettingSubTitle) {
                                while ($bettingSubTitle = $resultBettingSubTitle->fetch_assoc()) {

                                    $i++;
                                    ?>
                                    <?php
                                    if ($bettingSubTitle['hide']) {
                                        ?>

                                        <div class="panel panel-default panel2">
                                            <?php
                                            if ($bettingTitle['showStatus'] == 0 || $bettingSubTitle['showStatus'] == 0) {
                                                ?>

                                                <div style="background: #46555D !important;" class="panel-heading second-lebal" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>-two<?php echo $bettingSubTitle['id'] ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="panel-heading second-lebal" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>-two<?php echo $bettingSubTitle['id'] ?>">
                                                        <?php
                                                    }
                                                    ?>

                                                    <h4 style="cursor: pointer" class="panel-title" role="button" data-toggle="collapse"  href="#collapseOne<?php echo $bettingTitle['id'] ?>-two<?php echo $bettingSubTitle['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $bettingTitle['id'] ?>-two<?php echo $bettingSubTitle['id'] ?>">

                                                        <?php echo $bettingSubTitle['title'] ?> <span class="badge bg">Live</span>

                                                    </h4>
                                                </div>
                                                <div id="collapseOne<?php echo $bettingTitle['id'] ?>-two<?php echo $bettingSubTitle['id'] ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne<?php echo $bettingTitle['id'] ?>-two<?php echo $bettingSubTitle['id'] ?>">
                                                    <div class="panel-body"  style="padding: 0px 0px;background: #5F5F5F;">




                                                        <?php
                                                        $query = "SELECT * FROM `betting_sub_title_option` WHERE  bettingSubTitleId='$bettingSubTitle[id]'";
                                                        $resultBettingSubTitleOption = $db->select($query);
                                                        $i = 0;
                                                        if ($resultBettingSubTitleOption) {
                                                            while ($BettingSubTitleOption = $resultBettingSubTitleOption->fetch_assoc()) {

                                                                $i++;
                                                                ?>
                                                                <?php
                                                                if ($BettingSubTitleOption['hide']) {
                                                                    ?>


                                                                    <?php
                                                                    if ($bettingTitle['showStatus'] == 0 || $bettingSubTitle['showStatus'] == 0 || $BettingSubTitleOption['showStatus'] == 0) {
                                                                        ?>

                                                                        <div style="background: #46555D !important;" class="col-xl-4 col-lg-2 col-md-3 col-sm-3 col-xs-4 btn btn-default btn-sm data-show buttonrate" style="cursor: pointer"

                                                                             data-toggle="modal"
                                                                             <?php if (isset($_COOKIE["userId"]) && ( isset($_COOKIE["password"])) && ( isset($_COOKIE["id"]))) {
                                                                                 ?>
                                                                                 data-target=""
                                                                                 <?php
                                                                             } else {
                                                                                 ?>
                                                                                 data-target="#SignIn"
                                                                                 <?php
                                                                             }
                                                                             ?>

                                                                             >

                                                                            <?php echo $BettingSubTitleOption['title'] ?>  <span  style="color:#F9CD51;"><?php echo $BettingSubTitleOption['amount'] ?></span>

                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="col-xl-4 col-lg-2 col-md-3 col-sm-3 col-xs-4 btn btn-default btn-sm data-show buttonrate" style="cursor: pointer"



                                                                             id="select " 
                                                                             bettingTitle="<?php echo $bettingTitle['id'] ?>"
                                                                             bettingSubTitle=" <?php echo $bettingSubTitle['id'] ?>"
                                                                             BettingSubTitleOption="<?php echo $BettingSubTitleOption['id'] ?>"
                                                                             gameType="<?php echo $bettingTitle['gameType'] ?>"
                                                                             gameStatus="<?php echo $bettingTitle['status'] ?>"

                                                                             data-toggle="modal"
                                                                             <?php if (isset($_COOKIE["userId"]) && ( isset($_COOKIE["password"])) && ( isset($_COOKIE["id"]))) {
                                                                                 ?>
                                                                                 data-target="#betting"
                                                                                 <?php
                                                                             } else {
                                                                                 ?>
                                                                                 data-target="#SignIn"
                                                                                 <?php
                                                                             }
                                                                             ?>

                                                                             >

                                                                            <?php echo $BettingSubTitleOption['title'] ?>  <span  style="color:#F9CD51;"><?php echo $BettingSubTitleOption['amount'] ?></span>

                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>


                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
            }
        } else {
            ?>
            <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Match not Found !!!</strong>
            </div>
            <?php
        }
        ?>