<?php include './secondHeader.php'; ?>
<?php include './secondSite.php'; ?>


<?php
if (isset($_COOKIE['adminPanel'])) {

    $adminId = $_COOKIE['adminId'];
} else {

    $adminId = $_SESSION['adminId'];
}
?>
<link rel="stylesheet" type="text/css" href="css/betPanel.css">
<link rel="stylesheet" type="text/css" href="css/loader.css">
<main class="app-content">
    <div class="app-title">
        <div>
            <h6><i class="fa fa-dashboard"></i>p
            </h6>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">



            <div class="tile">
                <div class="tile-body">
                    <!-- add match -->
                    <div id="add-bet" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Match Title </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">



                                    <div id="addMatchSuccess">

                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">A Team</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="A_team" name="A_team" rows="4" placeholder="Enter A Team Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">B Team</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="B_team" name="B_team" rows="4" placeholder="Enter  B Team Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Bet Statement</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="title" name="title" rows="4" placeholder="Enter Bet Statement">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Date</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="date" name="date" id="demoDate" type="text" placeholder="Select Date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Match Status</label>
                                        <div class="col-md-8">
                                            <!--Radio Button Markup-->
                                            <div class="">
                                                <label>
                                                    <input type="radio" name="status" id="status" value="1"><span class="label-text"> </span><br>
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
                                                    <input class="gameTypec" type="radio" name="gameType" id="gameType" value="2"><span class="label-text"> Cricket</span><br>
                                                    <input type="radio" name="gameType" id="gameType" value="3"><span class="label-text"> Basketball</span>
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
                                                    <input type="radio" name="status2" id="status2" value="1"><span class="label-text"> ODI</span><br>
                                                    <input type="radio" name="status2" id="status2" value="2"><span class="label-text"> T20</span><br>
                                                    <input type="radio" name="status2" id="status2" value="3"><span class="label-text"> Test</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input  id="addMatchSubmit" type="submit" class="btn btn-success" value="submit">
                                            <input  id="addMatchSubmitDefault" type="submit" class="btn btn-success" value="add default">
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- hidden-match -->
                    <div id="hidden-match" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hidden match</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body" id="hiddenContentShow">

                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->

                    <a class="btn btn-primary icon-btn" href="" data-toggle="modal" data-target="#add-bet"><i class="fa fa-plus"></i>Add Item	</a>
                    <a class="btn btn-success" href="" ><i class="fa fa-refresh"></i>Refresh</a>
                    <a class="btn btn-primary" href="" id="hidden" data-toggle="modal" data-target="#hidden-match">hidden match </a>
                    <a class="btn btn-primary" href="defaultSecond.php" >Set default match </a><br><br>
                    <h6 style="color: #DD5347">Live Match</h6>


                    <!-- addQuestion -->
                    <div id="addQuestion" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Question </h5>

                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>match : <span id="matchShow"></span></h6>


                                    <div id="addQustionSuccess">

                                    </div>


                                    <div class="field_wrapper-sub">

                                        <div class="form-group row">

                                            <div class="col-md-6">
                                                <input class="form-control" name="input_field" id="addQustionOfMatch"  placeholder="Enter Question">


                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="bettingId" id="bettingIdForAddQuestion" type="text"  value="" hidden="1">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="addBetSubTitle" id="addQuestionSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->

                    <!-- limitMatch -->
                    <div id="limitMatch" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Limit </h5>

                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>match : <span id="matchShowOfLimit"></span></h6>


                                    <div id="limitMatchSuccess">

                                    </div>


                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input class="form-control" name="limitRateAmount" id="limitRateForMatch"  value="">

                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input name="bettingId" id="matchIdForLimit" type="text"  value="" hidden="1">
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="limitBettingTitle" id="limitRateForMatchSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                      <!-- limitMatch -->
                    <div id="scoreModal" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add score </h5>

                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>match : <span id="matchShowOfLimit"></span></h6>


                                    <div id="scoreSuc">

                                    </div>


                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input class="form-control" name="limitRateAmount" id="ScoreRateForMatch"  value="">

                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input name="bettingId" id="matchIdForScore" type="text"  value="" hidden="1">
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="limitBettingTitle" id="score" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- wait -->
                    <div id="matchWatting" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Match Waiting Time </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>match : <span id="matchShowOfWait"></span></h6>
                                    <div id="waitMatchSuccess">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <input class="form-control" id="matchWaittingRate" id="" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">                           
                                        <div class="col-md-8">
                                            <input name="bettingId" id="matchIdForWait" type="text"  value="" hidden="1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="waitBettingTitle" id="matchWattingTimeSubmit"type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- limitQuestion -->
                    <div id="limitQuestion" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Limit </h5>

                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Question  : <span id="questionShowOfLimit"></span></h6>


                                    <div id="limitQuestionSuccess">

                                    </div>


                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input class="form-control" name="limitRateAmount" id="limitRateForQuestion"  value="">

                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input name="bettingId" id="questionIdForLimit" type="text"  value="" hidden="1">
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="limitBettingTitle" id="limitRateForQuestionSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- wait -->
                    <div id="questionWatting" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Question Waiting Time </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>match : <span id="questionShowOfWait"></span></h6>
                                    <div id="waitQuestionSuccess">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <input class="form-control" id="questionWaittingRate" id="" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">                           
                                        <div class="col-md-8">
                                            <input name="bettingId" id="questionIdForWait" type="text"  value="" hidden="1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="waitBettingTitle" id="questionWattingTimeSubmit"type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- matchActionMenu -->
                    <div id="matchActionMenu" class="modal" style="">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">



                                <div class="modal-body">

                                    <div class="list-group">
                                        <a href="#" class="list-group-item btn btn-sm addQuestion" id="" data-toggle="modal" data-target="#addQuestion">Add Question</a>
                                        <a href="#" class="list-group-item btn btn-sm updateMatch" id="" data-toggle="modal" data-target="#updateMatch" data-dismiss="modal">Update match</a>

                                        <button class="list-group-item btn btn-sm closeMatch" id="" onclick="return confirm('Are you sure?')">Close The Match</button>
                                    </div>


                                </div>

                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- hidden-match -->
                    <div id="hidden-section" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hidden match</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body" id="hiddenSectionShow">

                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary m-default" type="button" data-dismiss="modal" id="">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->

                    <!-- matchActionMenu -->
                    <div id="default" class="modal" style="">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">



                                <div class="modal-body">

                                    <div class="list-group">
                                        <?php
                                        $query = "SELECT * FROM section";
                                        $resultreceivingMoneyNumber = $db->select($query);
                                        $i = 0;
                                        if ($resultreceivingMoneyNumber) {
                                            while ($receivingMoneyNumber = $resultreceivingMoneyNumber->fetch_assoc()) {

                                                $i++;
                                                ?>

                                                <a href="#" class="list-group-item btn btn-sm section" g-type="2" id="<?php echo $receivingMoneyNumber['id']; ?>" data-toggle="modal" data-target="#hidden-section"> <?php echo $receivingMoneyNumber['title']; ?></a>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>


                                </div>

                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->

                    <!-- Modal update match-->
                    <div id="updateMatch" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Match Title </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">


                                    <div id="UpdateMatchSuccess">

                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">A Team</label>
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control matchIdForUpdate" id="" rows="4" value="" >
                                            <input type="text" class="form-control" id="Update_A_team" name="A_team" rows="4" value="" placeholder="Enter A Team Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">B Team</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control"  id="Update_B_team" rows="4" value="" placeholder="Enter  B Team Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">match Statement</label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="title" id="Update_title" value="" rows="4" placeholder="Enter match Statement">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Date</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="Update_date" value="" name="date" id="demoDate" type="text" placeholder="Select Date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Match Status</label>
                                        <div class="col-md-8">
                                            <!--Radio Button Markup-->
                                            <div class="">
                                                <label>
                                                    <input type="radio" name="Update_status" id="Update_status" value="1"><span class="label-text"> Live</span><br>
                                                    <input type="radio" name="Update_status" id="Update_status" value="2"><span class="label-text"> Upcoming</span>
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
                                                    <input type="radio" name="Update_gameType" id="Update_gameType" value="1"><span class="label-text"> FootBall</span><br>
                                                    <input type="radio" name="Update_gameType" id="Update_gameType" value="2"><span class="label-text"> Cricket</span><br>
                                                    <input type="radio" name="Update_gameType" id="Update_gameType" value="3"><span class="label-text"> Basketball</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="updateMatch" id="updateMatchSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- questionActionMenu -->
                    <div id="questionActionMenu" class="modal" style="">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">



                                <div class="modal-body">

                                    <div class="list-group">
                                        <a href="#" class="list-group-item btn btn-sm addAns" id="" data-toggle="modal" data-target="#addAns">Add Answer</a>
                                        <a href="#" class="list-group-item btn btn-sm updateQuestion" id="" data-toggle="modal" data-target="#updateQuestion" data-dismiss="modal">Update question</a>

                                        <button class="list-group-item btn btn-sm closeQuestion" id="" onclick="return confirm('Are you sure?')" >Close The question</button>
                                    </div>


                                </div>

                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- addAns Modal -->
                    <div id="addAns" class="modal" style="">
                        <div class="modal-dialog "  role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Question : <span id="questionShowOfAddAns"></span></h6>
                                    <div id="addAnsSuccess">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input class="form-control" id="addAnsField"  placeholder="Enter Ans">
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" id="addAnsRate"  placeholder="Rate">
                                        </div>
                                    </div>
                                    <div class="form-group row">                           
                                        <div class="col-md-8">
                                            <input  id="questionIdForAddAns" type="text"  value="" hidden="1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input  id="addAnsSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->
                    <!-- update-sub-betting Modal -->
                    <div id="updateQuestion" class="modal" style="">
                        <div class="modal-dialog "  role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Question </h5>

                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <div id="UpdateQuestionSuccess">

                                    </div>


                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Question</label>
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control questionIdForUpdate" id="" rows="4" value="" >
                                            <input class="form-control" id="editQuestion"  value="">

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input name="updateMatch" id="updateQuestionSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">X</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->                                                       


                    <!-- edit betting rate -->
                    <div id="updateAnsRate" class="modal editRate" style="">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Answer </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <div id="UpdateAnsSuccess">

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <input class="form-control"  id="editAnswer" value="">
                                            <input type="hidden" class="form-control ansIdForUpdate" id="" rows="4" value="" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <input class="form-control rate"  id="editRateAmount" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input  id="updateAnsSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>  <!-- end Modal -->

                    <!-- limit betting rate -->
                    <div id="limitAns" class="modal" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Limit Answer </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Answer : <span id="ansShowOfLimit"></span></h6>
                                    <div id="limitAnsSuccess">
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input class="form-control" id="limitRateAmount"  value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input class="form-control"  id="ansIdForLimit"  value="" hidden="1">

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-8">
                                            <input  id="limitRateForAnsSubmit" type="submit" class="btn btn-success" value="submit">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- end Modal -->

                    <div id="liveMatchFetch">
                        <div class="loader loader-1">
                            <div class="loader-outter"></div>
                            <div class="loader-inner"></div>
                        </div>

                    </div>
                    <br> <h6 style="color: #17A05D">Upcoming Match</h6>  

                    <div id="upcomingContent">

                    </div>



                </div>
            </div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>

<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>

<!-- Page specific javascripts-->

<script>

                                            $(document).ready(function () {
                                                $("#liveMatchFetch").load('betLiveContent.php');
                                                $("#upcomingContent").load('upcomingMatch.php');

                                            });

                                            $(document).on('click', '#hidden', function (event) {
                                                $("#hiddenContentShow").load('hiddenContent.php');

                                            });
</script>
<!-- won-->  
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/select2.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/betAction.js"></script>
<script>

                                            $(function () {

                                                setInterval(function () {
                                                    console.log(data,841,"secondPanel.php")
                                                    if ($("#success").is(":visible")) {
                                                        //you may add animate.css class for fancy fadeout
                                                        $("#success").fadeOut("fast");
                                                    }
                                                }, 10000);

                                            });

                                            $('.editRate').on('shown.bs.modal', function () {
                                                $(this).find('.rate').focus();
                                            });


                                            setInterval(function () {
                                                $.ajax({
                                                    url: "betRefresh.php",
                                                    success: function (data) {
                                                        console.log(data,859,"secondpanel.php")
                                                        if (data === "1") {
                                                            $("#liveMatchFetch").load('betLiveContent.php');
                                                            $("#upcomingContent").load('upcomingMatch.php');
                                                        }
                                                    }
                                                });
                                            }, 60000);
                                            $(document).on('click', '.gameTypec', function () {

                                                $('.hiddenOp').toggle();


                                            });

</script>


</body>

</html>