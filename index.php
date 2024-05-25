<?php include './header.php'; ?>


<section class="callaction " style="min-height: 450px;">

    <div class="content-container mx-auto p-0 container">

        <div  >


        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12  pl-0 pr-0 ">
                <div >
                    <div >

                        <div class="">
                            <div class="list-group" >
                                <?php
                                $query = "SELECT * FROM `notice`";
                                $result = $db->select($query);
                                $notice = $result->fetch_assoc();
                                ?>
                                <marquee style="border-radius: 5px; background: linear-gradient(to right top, #f9a216, #b8b844, #fe6d56, #f9a216, #f9a216) !important;" class="mrq" scrollamount='3' direction="scroll"><p><strong> <?php echo $notice['text']; ?></strong></p></marquee>  
                                  
                                   <div id="dataModal" class="modal fade" bis_skin_checked="1">  
                                        <div class="modal-dialog" bis_skin_checked="1">  
                                            <div class="modal-content" bis_skin_checked="1">  
                                                <div class="modal-header" bis_skin_checked="1">  
                                                    <button type="button" class="close" data-dismiss="modal">×</button>  
                                                    <h4 class="modal-title">Employee Details</h4>  
                                                </div>  
                                                <div class="modal-body" id="employee_detail" bis_skin_checked="1">  
                                                </div>  
                                                <div class="modal-footer" bis_skin_checked="1">  
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                                </div>  
                                            </div>  
                                        </div>  
                                  </div>

                                    <div class="live-con upcoming">
                                        <div class="live-con-img">
                                            <img class="live-img" src="img/live.gif">  <span class="live-text"> Live</span><img class="live-img" src="img/live.gif">
                                        </div>
                                    </div>                  
                                    <div id="dataModal" class="modal fade">  
                                        <div class="modal-dialog">  
                                            <div class="modal-content">  
                                                <div class="modal-header">  
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                                    <h4 class="modal-title">Employee Details</h4>  
                                                </div>  
                                                <div class="modal-body" id="employee_detail">  
                                                </div>  
                                                <div class="modal-footer">  
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                                </div>  
                                            </div>  
                                        </div>  
                                    </div>
                                    
                               
                                <!-- Modal betting-->

                               <div class="modal fade betForm" id="betting" role="dialog" >
                                    <div class="modal-dialog" bis_skin_checked="1">

                                        <!-- Modal content-->
                                        <div class="modal-content m-content" bis_skin_checked="1">
                                            <div class="modal-header m-head" style="  background: #483d8b !important;" bis_skin_checked="1">

                                                <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">×</button>
                                                <h4 class="modal-title" style="color: #D2D2D2">  &nbsp; Place Bet</h4>
                                            </div>
                                            <div class="modal-body" style="padding: 2% !important" bis_skin_checked="1">
                                                <div class="signup-form" bis_skin_checked="1">

                                                    <div id="formData" bis_skin_checked="1">

                                                        
                                                           <div id="successPlaceBet" class="alert alert-success successlaceBet" role="alert" bis_skin_checked="1">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                                </button>  <strong>  Place Bet !!</strong> <span id="successPlaceBetText"></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-7">
                                                                    <label><span id="BettingSubTitleOption"></span> <span id="betRateShow" class="badge text-right"></span></label> <br>
                                                                    <label><small id="bettingSubTitle"></small></label><br>
                                                                    <label>
                                                                        <span id="bettingTitle"></span>
                                                                        <span  id="gameLiveOrUpcoming"  class="badge text-right"></span>
                                                                    </label><br>
                                                                    <input type="text" id="match" value="" hidden="1">
                                                                    <input type="text" id="matchBet" value="" hidden="1">
                                                                    <input type="text" id="betRate" value="" hidden="1">
                                                                    <input type="text" id="betId" value="" hidden="1">
                                                                    <input type="text" id="matchId" value="" hidden="1">
                                                                    <input type="text" id="betTitleId" value="" hidden="1">

                                                                   <label class="gameLogo">

                                                                        <img id="gameLogo" style="box-shadow: 1px 7px 4px 0px #787981 !important;border-radius: 50%;" class="img-circle" src="" width="25px;">&nbsp;


                                                                    </label>
                                                                </div>
                                                                <div class="col-lg-5" bis_skin_checked="1">
                                                                    <input type="text" class="form-control" id="stakeAmount" value="">
                                                                </div>
                                                            </div>

                                                     
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-7">
                                                                    <label><strong>Total Stake</strong></label>

                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label class="col-lg-12 text-right"><strong id="stakeAmountView">100</strong></label>

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-7">
                                                                    <label><strong>Possible Winning</strong></label>

                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label class="col-lg-12 text-right"><strong id="possibleAmount"> 100.00</strong></label>

                                                                </div>
                                                            </div>
                                                        </div>


                                                      <div class="form-group" >
                                                            <button type="submit" id="placeBet" name="placeBet" class="btn btn-info btn-lg btn-block">Place Bet</button>
                                                            <button id="load" class="btn btn-success btn-sm btn-block load"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                               </div>
                               <div id="liveContent">
                               </div>
                               <a class="list-group-item upcoming"><span> <i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Upcoming </span><span class="glyphicon glyphicon-menu-right mg-icon pull-right"></span></a>
                               <div id="upcomingContent">
                               </div>
                            </div><!-- ./ end list-group -->
                        </div><!-- ./ end slide-container -->

                    </div><!-- ./ end panel-body -->
                </div><!-- ./ end panel panel-default-->
            </div><!-- ./ endcol-lg-6 col-lg-offset-3 -->
        <div class="col-lg-2">

        </div>
        </div><!-- ./ end row -->
        </div>
    </div>
    
</section>

  <footer class="footer-basic-centered " style="background-color: #16627a !important;">
        <div class="container">


            <div class="row">

                <div class="col-lg-3">
                    <a  class="" href=""><img style="width: 150px;height: 60px;margin-left: 10px;" src="img/kkk.png"></a>
                    <p style="font-size: 15px;color: #dcdcdc;" class="footer-company-name">Bet20.live &copy; <?php echo date("Y"); ?>  all right reserved.</p>
                </div>
                <div class="col-lg-6">
                    <p class="footer-links">

                        <a href="index.php">Home</a>
                        |
                        <a href="#"> Contact-us</a>
                        |
                        <a href="#"> Rules & Regulations</a>
                        |
                        <a href="#"> FAQ</a>
                        |
                        <a href="#"> About Us</a>

                    </p>


                </div>
               

            </div>
        </div>

    </footer>

<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script src="js/jquery.min_1.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/validation/placeBet.js"></script>

<script src="js/validation/validated.js"></script>
<script src="js/validation/siteRefresh.js"></script>
<script src="js/validation/deposit_and_withdraw.js"></script>



<?php
if (isset($_COOKIE["userId"]) AND ( isset($_COOKIE["password"]))) {

    include './chatBox.php';
}
?>
</body>
</html>

