<?php include './secondHeader.php'; ?>
<?php include './secondSite.php'; ?>
<style>

    #accordion .panel{
        border: none;
        border-radius: 0;
        box-shadow: none;
        /* margin: 0 30px 10px 30px;*/
        overflow: hidden;
        position: relative;
        margin-bottom: -7px !important;
    }
    #accordion .panel-heading{
        padding: 0;
        border: none;
        border-radius: 0;
        position: relative;
    }
    #accordion .panel-title a{
        display: block;
        padding: 8px 22px;
        margin: 0;
        background: #145C51;
        font-size: 14px;
        font-weight: 700;

        color: #fff;
        border-radius: 0;
        position: relative;
    }




    #accordion .panel-body{
        border: 3px solid #145C51;
        border-top: none;
        background: #fff;
        /* font-size: 15px; */
        color: #1c2336;
        line-height: 27px;
        position: relative;
        margin-top: -8px !important;
    }
    #accordion .panel-body-2{

        border-top: none;
        background: #fff;
        /* font-size: 15px; */
        color: #1c2336;
        line-height: 27px;
        position: relative;
        margin-top: -8px !important;
    }

    #accordion .panel-body p{
        padding: 10px;
    }
    //modal resize

</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Betting Panel</h1>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_POST['addBet'])) {
                $status = 0;
                $A_team = $_POST['A_team'];
                $B_team = $_POST['B_team'];
                $title = $_POST['title'];
                $date = $_POST['date'];
                if (isset($_POST['status'])) {
                    $status = $_POST['status'];
                }

                $gameType = $_POST['gameType'];


                $query = "INSERT INTO `default_match`(`A_team`, `B_team`, `title`, `date`, `status`, `gameType`)"
                        . " VALUES ('$A_team','$B_team','$title','$date','$status','$gameType')";
                $resultClubInsert = $db->insert($query);

                if ($resultClubInsert) {
                    
                } else {
                    
                }
            }
            ?>
            <?php
            if (isset($_POST['addBetSubTitle'])) {
                $input_field = $_POST['input_field'];
                $bettingId = $_POST['bettingId'];
                $category = $_POST['category'];
                     $gType = $_POST['gType'];


                foreach ($input_field as $title) {


                    $query = "INSERT INTO `default_ques`( `title`, `bettingId`,section_ct,g_type)"
                            . " VALUES ('$title','$bettingId','$category','$gType')";
                    $resultClubInsert = $db->insert($query);

                    if ($resultClubInsert) {
                        
                    } else {
                        
                    }
                }
            }
            ?>

            <?php
            if (isset($_POST['addBetSubTitleOption'])) {
                $input_field = $_POST['input_field'];
                $subBettingId = $_POST['subBettingId'];
                $betRate = $_POST['betRate'];



                foreach (array_combine($input_field, $betRate) as $title => $rate) {


                    $query = "INSERT INTO `default_ans`(`title`, `amount`, `bettingSubTitleId`)"
                            . " VALUES ('$title','$rate','$subBettingId')";
                    $resultClubInsert = $db->insert($query);

                    if ($resultClubInsert) {
                        
                    } else {
                        
                    }
                }
            }
            ?>
            <div class="tile">
                <div class="tile-body">
                    <!-- Modal -->
                    <div id="add-bet" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Match Title </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post">

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">A Team</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="A_team" rows="4" placeholder="Enter A Team Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">B Team</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="B_team" rows="4" placeholder="Enter  B Team Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Bet Statement</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="title" rows="4" placeholder="Enter Bet Statement">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Date</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="date" id="demoDate" type="text" placeholder="Select Date">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Match Type</label>
                                            <div class="col-md-8">
                                                <!--Radio Button Markup-->
                                                <div class="">
                                                    <label>
                                                        <input type="radio" name="gameType" id="gameType" value="1"><span class="label-text"> FootBall</span><br>
                                                        <input class="gameTypec" type="radio" name="gameType" id="gameType" value="2"><span class="label-text"> Cricket</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row hiddenOp" style="display: none">
                                            <label class="control-label col-md-3">Match Status</label>
                                            <div class="col-md-8">
                                                <!--Radio Button Markup-->
                                                <div class="">
                                                    <label>
                                                        <input type="radio" name="status" id="status" value="1"><span class="label-text"> ODI</span><br>
                                                        <input type="radio" name="status" id="status" value="2"><span class="label-text"> T20</span><br>
                                                        <input type="radio" name="status" id="status" value="3"><span class="label-text"> Test</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-8">
                                                <input name="addBet" type="submit" class="btn btn-success" value="submit">
                                            </div>
                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <a class="btn btn-primary icon-btn" href="" data-toggle="modal" data-target="#add-bet"><i class="fa fa-plus"></i>Add Item	</a>
                    <a class="btn btn-success" href="" ><i class="fa fa-refresh"></i>Refresh</a><br><br>
                    <h6 style="color: #DD5347">Live Match</h6>
                    <?php
                    $query = "SELECT * FROM `default_match` ORDER BY id desc";
                    $resultBettingTitle = $db->select($query);
                    $i = 0;
                    if ($resultBettingTitle) {
                        while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {

                            $i++;
                            ?>
                            <!-- Modal -->

                            <!-- Modal -->
                            <div id="action-sub-betting-id<?php echo $bettingTitle['id'] ?>" class="modal" style="">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">



                                        <div class="modal-body">

                                            <div class="list-group">
                                                <a href="#" class="list-group-item btn btn-sm" data-toggle="modal" data-target="#add-sub-betting-id<?php echo $bettingTitle['id'] ?>" data-dismiss="modal">Add Question</a>
                                                <a href="#" class="list-group-item btn btn-sm" data-toggle="modal" data-target="#update-match-<?php echo $bettingTitle['id'] ?>" data-dismiss="modal">Update match</a>
                                                <a class="list-group-item btn btn-sm" onclick="return confirm('Are you sure?')" href="defaultPanelAction.php?deleteMatch=<?php echo $bettingTitle['id'] ?>">Delete match</a>
                                                <a class="list-group-item btn btn-sm" onclick="return confirm('Are you sure?')" href="defaultPanelAction.php?closeMatch=<?php echo $bettingTitle['id'] ?>">Close The Match</a>
                                            </div>


                                        </div>

                                        <div class="modal-footer">

                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>  <!-- end Modal -->



                            <!-- Modal -->
                            <div id="add-sub-betting-id<?php echo $bettingTitle['id'] ?>" class="modal" style="">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Question </h5>

                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>match : <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> <?php echo $bettingTitle['title'] ?> </h6>
                                            <form class="form-horizontal" method="post">



                                                <div class="form-group">

                                                    <select class="form-control col-md-6" id="dTo" name="category">
                                                        <option disabled selected value>Select category</option>

                                                        <?php
                                                        $query = "SELECT * FROM section";
                                                        $resultreceivingMoneyNumber = $db->select($query);
                                                        $i = 0;
                                                        if ($resultreceivingMoneyNumber) {
                                                            while ($receivingMoneyNumber = $resultreceivingMoneyNumber->fetch_assoc()) {

                                                                $i++;
                                                                ?>
                                                                <option value=" <?php echo $receivingMoneyNumber['id']; ?>">      <?php echo $receivingMoneyNumber['title']; ?></option>

                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">

                                                    <select class="form-control col-md-6" id="dTo" name="gType">
                                                        <option disabled selected value>Select game type</option>


                                                        <option value="1">Football</option>
                                                        <option value="2">Cricket</option>
                                                        <option value="3">Basket</option>

                                                    </select>
                                                </div>


                                                <div class="field_wrapper-sub">

                                                    <div class="form-group row">

                                                        <div class="col-md-6">
                                                            <input class="form-control" name="input_field[]"  placeholder="Enter Question">

                                                            <a href="javascript:void(0);" class="add_input_button-sub" title="Add field"><i style="background: green;color: white;padding: 9px;border-radius: 43%;margin-top: 6px;" class="fa fa-plus" ></i></a>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="col-md-8">
                                                        <input name="bettingId" type="text"  value="<?php echo $bettingTitle['id'] ?>" hidden="1">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="col-md-8">
                                                        <input name="addBetSubTitle" type="submit" class="btn btn-success" value="submit">
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>  <!-- end Modal -->


                            <!-- Modal update match-->
                            <div id="update-match-<?php echo $bettingTitle['id'] ?>" class="modal" style="">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Match Title </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" method="post">

                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">A Team</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="A_team" rows="4" value="<?php echo $bettingTitle['A_team'] ?>" placeholder="Enter A Team Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">B Team</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="B_team" rows="4" value="<?php echo $bettingTitle['B_team'] ?>" placeholder="Enter  B Team Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">match Statement</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" name="title" value="<?php echo $bettingTitle['title'] ?> " rows="4" placeholder="Enter match Statement">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Date</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" value="<?php echo $bettingTitle['date'] ?> " name="date" id="demoDate" type="text" placeholder="Select Date">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Match Status</label>
                                                    <div class="col-md-8">
                                                        <!--Radio Button Markup-->
                                                        <div class="">
                                                            <label>
                                                                <input type="radio" name="status" id="status" value="1"><span class="label-text"> Live</span><br>
                                                                <input type="radio" name="status" id="status" value="2"><span class="label-text"> Upcoming</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Match Type</label>
                                                    <div class="col-md-8">
                                                        <!--Radio Button Markup-->
                                                        <div class="">
                                                            <label>
                                                                <input type="radio" name="gameType" id="gameType" value="1"><span class="label-text"> FootBall</span><br>
                                                                <input  type="radio" name="gameType" id="gameType" value="2"><span class="label-text"> Cricket</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="col-md-8">
                                                        <input name="addBet" type="submit" class="btn btn-success" value="submit">
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>  <!-- end Modal -->
                            <!-- first label -->

                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">

                                    <div class="panel-heading" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>one">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $bettingTitle['id'] ?>one" aria-expanded="true" aria-controls="collapseOne<?php echo $bettingTitle['id'] ?>one">

                                                <?php
                                                if ($bettingTitle['gameType'] == 1) {
                                                    ?>
                                                    <img src="../img/1393757333.png" width="25px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo $bettingTitle['date'] ?> 


                                                    <button class="btn btn-primary  btn-sm" href="" data-toggle="modal" data-target="#action-sub-betting-id<?php echo $bettingTitle['id'] ?>">action </button>


                                                    <?php
                                                    if ($bettingTitle['ariaHide'] == 1) {
                                                        ?>
                                                        <form  method="post"action="defaultPanelAction.php" style="display: inline">
                                                            <input type="text" name="bettingTitleId"   value="<?php echo $bettingTitle['id'] ?>" hidden>
                                                            <input type="submit" name="bettingTitleAriaHide" class="btn btn-primary  btn-sm"  value="aria hide">
                                                        </form>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <form method="post"action="defaultPanelAction.php" style="display: inline">
                                                            <input type="text" name="bettingTitleId"  value="<?php echo $bettingTitle['id'] ?>" hidden>
                                                            <input type="submit" name="bettingTitleAriaShow" class="btn btn-danger  btn-sm"  value="aria show">
                                                        </form>
                                                        <?php
                                                    }
                                                    ?>


                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="../img/ka-pl.png" width="25px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo $bettingTitle['date'] ?> 

                                                    <button class="btn btn-primary  btn-sm" href="" data-toggle="modal" data-target="#action-sub-betting-id<?php echo $bettingTitle['id'] ?>">action </button>

                                                    <?php
                                                    if ($bettingTitle['ariaHide'] == 1) {
                                                        ?>
                                                        <form  method="post"action="defaultPanelAction.php" style="display: inline">
                                                            <input type="text" name="bettingTitleId"   value="<?php echo $bettingTitle['id'] ?>" hidden>
                                                            <input type="submit" name="bettingTitleAriaHide" class="btn btn-primary  btn-sm"  value="aria hide">
                                                        </form>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <form method="post"action="defaultPanelAction.php" style="display: inline">
                                                            <input type="text" name="bettingTitleId"  value="<?php echo $bettingTitle['id'] ?>" hidden>
                                                            <input type="submit" name="bettingTitleAriaShow" class="btn btn-danger  btn-sm"  value="aria show">
                                                        </form>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>



                                            </a>

                                        </h4>
                                    </div>
                                    <?php
                                    if ($bettingTitle['ariaHide'] == 1) {
                                        ?>
                                        <div id="collapseOne<?php echo $bettingTitle['id'] ?>one" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne<?php echo $bettingTitle['id'] ?>one">
                                            <div class="panel-body" style="">

                                                <!-- second label -->
                                                <div class="panel-group" id="accordion<?php echo $bettingTitle['id'] ?>one" role="tablist" aria-multiselectable="true">
                                                    <?php
                                                    $query = "SELECT * FROM `default_ques` WHERE bettingId='$bettingTitle[id]'";
                                                    $resultBettingSubTitle = $db->select($query);
                                                    $i = 0;
                                                    if ($resultBettingSubTitle) {
                                                        while ($bettingSubTitle = $resultBettingSubTitle->fetch_assoc()) {

                                                            $i++;
                                                            ?>
                                                            <!-- add-sub-betting-option Modal -->
                                                            <div id="add-sub-betting-option-id<?php echo $bettingSubTitle['id'] ?>" class="modal" style="">
                                                                <div class="modal-dialog "  role="document">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Add </h5>

                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h6> <?php echo $bettingSubTitle['title'] ?> </h6>
                                                                            <form class="form-horizontal" method="post">

                                                                                <div class="field_wrapper">

                                                                                    <div class="form-group row">

                                                                                        <div class="col-md-6">
                                                                                            <input class="form-control" name="input_field[]"  placeholder="Enter Ans">

                                                                                            <a href="javascript:void(0);" class="add_input_button" title="Add field"><i style="background: green;color: white;padding: 9px;border-radius: 43%;margin-top: 6px;" class="fa fa-plus" ></i></a>

                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <input class="form-control" name="betRate[]"  placeholder="Bet Rate">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3"></label>
                                                                                    <div class="col-md-8">
                                                                                        <input name="subBettingId" type="text"  value="<?php echo $bettingSubTitle['id'] ?>" hidden="1">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3"></label>
                                                                                    <div class="col-md-8">
                                                                                        <input name="addBetSubTitleOption" type="submit" class="btn btn-success" value="submit">
                                                                                    </div>
                                                                                </div>


                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  <!-- end Modal -->
                                                            <!-- update-sub-betting Modal -->
                                                            <div id="update-sub-betting-option-id<?php echo $bettingSubTitle['id'] ?>" class="modal" style="">
                                                                <div class="modal-dialog "  role="document">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Edit Question </h5>

                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h6> <?php echo $bettingSubTitle['title'] ?> </h6>
                                                                            <form class="form-horizontal" action="betPanelAction.php" method="post">



                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3">Question</label>
                                                                                    <div class="col-md-8">
                                                                                        <input class="form-control" name="editQuestion"  value="<?php echo $bettingSubTitle['title'] ?>">

                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3"></label>
                                                                                    <div class="col-md-8">
                                                                                        <input name="editQuestionId" type="text"  value="<?php echo $bettingSubTitle['id'] ?>" hidden="1">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3"></label>
                                                                                    <div class="col-md-8">
                                                                                        <input name="submitQuestion" type="submit" class="btn btn-success" value="submit">
                                                                                    </div>
                                                                                </div>


                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  <!-- end Modal -->                                                       

                                                            <!-- action-sub-betting-option Modal -->
                                                            <div id="action-sub-betting-option-id<?php echo $bettingSubTitle['id'] ?>" class="modal" style="">
                                                                <div class="modal-dialog modal-sm modal-open"  role="document">
                                                                    <div class="modal-content">

                                                                        <div class="modal-body">

                                                                            <div class="list-group">
                                                                                <a href="#" class="list-group-item btn btn-sm" data-toggle="modal" data-target="#add-sub-betting-option-id<?php echo $bettingSubTitle['id'] ?>" data-dismiss="modal">Add</a>
                                                                                <a href="#" class="list-group-item btn btn-sm" data-toggle="modal" data-target="#update-sub-betting-option-id<?php echo $bettingSubTitle['id'] ?>" data-dismiss="modal">Update</a>
                                                                                <a class="list-group-item btn btn-sm" onclick="return confirm('Are you sure?')" href="defaultPanelAction.php?deleteQuestion=<?php echo $bettingSubTitle['id'] ?>">Delete</a>

                                                                            </div>


                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  <!-- end Modal -->


                                                            <div class="panel panel-default">
                                                                <div class="panel-heading" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>">
                                                                    <h4 class="panel-title">
                                                                        <a  style="background:#E7E7E7 !important;color: #212529;padding: 1%;border-bottom: 1px solid #979797;" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $bettingTitle['id'] ?>one" href="#collapseOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>">
                                                                            <?php echo $bettingSubTitle['title'] ?> 

                                                                            <?php
                                                                            $query = "SELECT * FROM section where id='$bettingSubTitle[section_ct]'";
                                                                            $resultreceivingMoneyNumber = $db->select($query);
                                                                            $i = 0;
                                                                            if ($resultreceivingMoneyNumber) {
                                                                                $receivingMoneyNumber = $resultreceivingMoneyNumber->fetch_assoc();
                                                                                ?>
                                                                                (  <?php echo $receivingMoneyNumber['title']; ?> )

                                                                                <?php
                                                                            }
                                                                            ?>


                                                                            <button style="" class="btn btn-primary  btn-sm" href="" data-toggle="modal" data-target="#action-sub-betting-option-id<?php echo $bettingSubTitle['id'] ?>">Action </button>

                                                                            <?php
                                                                            if ($bettingSubTitle['ariaHide'] == 1) {
                                                                                ?>
                                                                                <form  method="post"action="defaultPanelAction.php" style="display: inline">
                                                                                    <input type="text" name="bettingSubTitleId"   value="<?php echo $bettingSubTitle['id'] ?>" hidden>
                                                                                    <input type="submit" name="bettingSubTitleAriaHide" class="btn btn-primary  btn-sm" href="defaultPanelAction.php" value="aria hide">
                                                                                </form>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <form method="post"action="defaultPanelAction.php" style="display: inline">
                                                                                    <input type="text" name="bettingSubTitleId"  value="<?php echo $bettingSubTitle['id'] ?>" hidden>
                                                                                    <input type="submit" name="bettingSubTitleAriaShow" class="btn btn-danger  btn-sm" href="defaultPanelAction.php" value="aria show">
                                                                                </form>
                                                                                <?php
                                                                            }
                                                                            ?>


                                                                        </a>

                                                                    </h4>

                                                                </div>
                                                                <?php
                                                                if ($bettingSubTitle['ariaHide'] == 1) {
                                                                    ?>

                                                                    <div id="collapseOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>">
                                                                        <div class="panel-body-2" style="padding: 10px;margin-bottom: 5px;">
                                                                            <!-- third label -->
                                                                            <div class="">

                                                                                <div class="col-md-12">
                                                                                    <div class="">

                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-bordered ">
                                                                                                <thead>
                                                                                                    <tr>

                                                                                                        <th scope="col">Answer</th>
                                                                                                        <th scope="col">Bet Rate</th>

                                                                                                        <th scope="col">Action</th>

                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php
                                                                                                    $totalBetAmount = 0;
                                                                                                    $totalReturnAmount = 0;
                                                                                                    $query = "SELECT * FROM `default_ans` WHERE  bettingSubTitleId='$bettingSubTitle[id]'";
                                                                                                    $resultBettingSubTitleOption = $db->select($query);
                                                                                                    $i = 0;
                                                                                                    if ($resultBettingSubTitleOption) {
                                                                                                        while ($BettingSubTitleOption = $resultBettingSubTitleOption->fetch_assoc()) {

                                                                                                            $i++;
                                                                                                            ?>
                                                                                                            <tr>
                                                                                                                <th> <?php echo $BettingSubTitleOption['title'] ?> </th>
                                                                                                                <td> <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit-betting-rate<?php echo $BettingSubTitleOption['id'] ?>"> <?php echo $BettingSubTitleOption['amount'] ?></a> </td>

                                                                                                                <td>



                                                                                                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                                                                        Action
                                                                                                                    </button>
                                                                                                                    <div class="dropdown-menu">



                                                                                                                        <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="defaultPanelAction.php?deleteAnswer=<?php echo $BettingSubTitleOption['id'] ?>">Delete</a>

                                                                                                                    </div>
                                                                                                                    </div>

                                                                                                                    <!-- edit betting rate -->
                                                                                                                    <div id="edit-betting-rate<?php echo $BettingSubTitleOption['id'] ?>" class="modal editRate" style="">
                                                                                                                        <div class="modal-dialog modal-sm" role="document">
                                                                                                                            <div class="modal-content">
                                                                                                                                <div class="modal-header">


                                                                                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                                                                </div>
                                                                                                                                <div class="modal-body">
                                                                                                                                    <h6> <?php echo $bettingSubTitle['title'] ?> </h6>
                                                                                                                                    <form class="form-horizontal" action="defaultPanelAction.php" method="post">


                                                                                                                                        <div class="form-group row">

                                                                                                                                            <div class="col-md-8">
                                                                                                                                                <input class="form-control" name="editAnswer"  value="<?php echo $BettingSubTitleOption['title'] ?>">

                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <div class="form-group row">

                                                                                                                                            <div class="col-md-8">
                                                                                                                                                <input class="form-control rate" name="editRateAmount" >

                                                                                                                                            </div>
                                                                                                                                        </div>

                                                                                                                                        <div class="form-group row">
                                                                                                                                            <label class="control-label col-md-3"></label>
                                                                                                                                            <div class="col-md-8">
                                                                                                                                                <input name="BettingSubTitleOptionId" type="text"  value="<?php echo $BettingSubTitleOption['id'] ?>" hidden="1">
                                                                                                                                            </div>
                                                                                                                                        </div>

                                                                                                                                        <div class="form-group row">
                                                                                                                                            <label class="control-label col-md-3"></label>
                                                                                                                                            <div class="col-md-8">
                                                                                                                                                <input name="editBetRate" type="submit" class="btn btn-success" value="submit">
                                                                                                                                            </div>
                                                                                                                                        </div>


                                                                                                                                    </form>
                                                                                                                                </div>

                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>  <!-- end Modal -->


                                                                                                                </td>

                                                                                                            </tr>
                                                                                                            <?php
                                                                                                        }
                                                                                                    }
                                                                                                    ?>


                                                                                                    <tr>


                                                                                                        <th style="border: 0px;"></th>
                                                                                                        <th style="border: 0px;"></th>

                                                                                                        <th style="border: 0px;"></th>
                                                                                                    </tr>

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>






                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
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
                                </div>
                            </div>
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



                </div>
            </div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>

<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->


<!-- won-->  
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/select2.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>

<script>
                                                                                            $(document).ready(function () {
                                                                                                var max_fields = 10;
                                                                                                var add_input_button = $('.add_input_button');
                                                                                                var field_wrapper = $('.field_wrapper');
                                                                                                var new_field_html = '<div class="form-group row"> <div class="col-md-6"><input class="form-control" name="input_field[]"  placeholder="Enter Ans"> <a href="javascript:void(0);" class="remove_input_button" title="Remove field"> <i style="background: red;color: white;padding: 9px;border-radius: 43%;margin-top: 6px;" class="fa fa-minus" ></i></a></div><div class="col-md-4"><input class="form-control" name="betRate[]"  placeholder="Bet Rate"></div></div>';
                                                                                                var input_count = 1;
// Add button dynamically
                                                                                                $(add_input_button).click(function () {
                                                                                                    if (input_count < max_fields) {
                                                                                                        input_count++;
                                                                                                        $(field_wrapper).append(new_field_html);
                                                                                                    }
                                                                                                });
// Remove dynamically added button
                                                                                                $(field_wrapper).on('click', '.remove_input_button', function (e) {
                                                                                                    e.preventDefault();
                                                                                                    $(this).parent('div').remove();
                                                                                                    input_count--;
                                                                                                });
                                                                                                //
                                                                                                var max_fields_sub = 10;
                                                                                                var add_input_button_sub = $('.add_input_button-sub');
                                                                                                var field_wrapper_sub = $('.field_wrapper-sub');
                                                                                                var new_field_html_sub = '<div class="form-group row"> <div class="col-md-6"><input class="form-control" name="input_field[]"  placeholder="Enter Bet Statement"> <a href="javascript:void(0);" class="remove_input_button-sub" title="Remove field"> <i style="background: red;color: white;padding: 9px;border-radius: 43%;margin-top: 6px;" class="fa fa-minus" ></i></a></div></div>';
                                                                                                var input_count_sub = 1;
// Add button dynamically
                                                                                                $(add_input_button_sub).click(function () {
                                                                                                    if (input_count_sub < max_fields_sub) {
                                                                                                        input_count_sub++;
                                                                                                        $(field_wrapper_sub).append(new_field_html_sub);
                                                                                                    }
                                                                                                });
// Remove dynamically added button
                                                                                                $(field_wrapper_sub).on('click', '.remove_input_button-sub', function (e) {
                                                                                                    e.preventDefault();
                                                                                                    $(this).parent('div').remove();
                                                                                                    input_count_sub--;
                                                                                                });
                                                                                            });


                                                                                            $('.editRate').on('shown.bs.modal', function () {
                                                                                                $(this).find('.rate').focus();
                                                                                            });

                                                                                            $(document).on('click', '.gameTypec', function () {

                                                                                                $('.hiddenOp').toggle();


                                                                                            });
</script>


</body>

</html>