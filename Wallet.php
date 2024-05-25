<?php include './header.php'; ?>

<link rel="stylesheet" href="css/statementAndWallet.css">
<body>



    <div id=" "  style="border-bottom: 1px solid #5F5F5F;min-height: 450px;">

    <style type="text/css">
        .modal{
            border-radius: 10px;
        }
    </style>

        <!-- Modal deposit -->
        <div id="deposit" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header m-head" style="  background: #8000ff !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: white;"> &nbsp; Request a deposit</h4>
                    </div>
                    <div class="modal-body" style="padding: 2% !important">
                        <div class="">
                            <div role="form" class="register-form">
                                <div id="errorDeposit" class="alert alert-danger errorDeposit" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>  <strong>  Opps !!</strong> <span id="errorDepositText"></span>
                                </div>
                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <label style="text-align: left;width: 100%;">Method<span style="color:#DD4F43;">*</span></label>

                                            <select class="form-control" id="dMethodt">
                                                <option disabled selected value>Select method</option>

                                                <?php
                                                $query = "SELECT * FROM method";
                                                $resultMethod = $db->select($query);
                                                $i = 0;
                                                if ($resultMethod) {
                                                    while ($method = $resultMethod->fetch_assoc()) {

                                                        $i++;
                                                        ?>
                                                        <option value="<?php echo $method['id']; ?>"><?php echo $method['method']; ?></option>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <label style="text-align: left;width: 100%;">To <span style="color:#DD4F43;">*</span></label>
                                            <select class="form-control" id="dTo">
                                                <option disabled selected value>Select number</option>

                                                <?php
                                                $query = "SELECT * FROM receiving_money_number";
                                                $resultreceivingMoneyNumber = $db->select($query);
                                                $i = 0;
                                                if ($resultreceivingMoneyNumber) {
                                                    while ($receivingMoneyNumber = $resultreceivingMoneyNumber->fetch_assoc()) {

                                                        $i++;
                                                        ?>
                                                        <option>      <?php echo $receivingMoneyNumber['phone']; ?></option>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">

                                        <div class="form-group">
                                            <label style="text-align: left;width: 100%;">Amount <span style="color:#DD4F43;">*</span></label>
                                            <input type="text" name="first_name" id="dAmount" class="form-control input-lg" placeholder="Amount" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <label style="text-align: left;width: 100%;">From <span style="color:#DD4F43;">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="dFrom" id="dFrom" class="form-control input-lg" placeholder="From" tabindex="1">
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">Transaction Number  <span style="color:#DD4F43;">*</span></label>
                                    <input type="text" name="display_name" id="dReference" class="form-control input-lg" placeholder="Transaction Number " tabindex="3">
                                </div>




                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6"><input type="submit" id="depositSubmit" value="Submit" class="btn btn-success btn-block btn-lg" tabindex="7"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Modal withdraw -->
        <div id="withdraw" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header m-head" style="  background: #8000ff !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: white;"> &nbsp;Request a withdraw</h4>
                    </div>
                    <div class="modal-body" style="padding: 2% !important">
                        <div class="">
                            <div role="form" class="register-form">

                                <div id="errorWithraw" class="alert alert-danger errorWithraw" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>  <strong>  Opps !!</strong> <span id="errorWithrawText"></span>
                                </div>
                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <label style="text-align: left;width: 100%;">Method<span style="color:#DD4F43;">*</span></label>

                                            <select class="form-control" id="wMethod">
                                                <option disabled selected value>select Method</option>
                                                <?php
                                                $query = "SELECT * FROM w_method";
                                                $resultMethod = $db->select($query);
                                                $i = 0;
                                                if ($resultMethod) {
                                                    while ($method = $resultMethod->fetch_assoc()) {

                                                        $i++;
                                                        ?>
                                                        <option value="<?php echo $method['id']; ?>"><?php echo $method['method']; ?></option>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <label style="text-align: left;width: 100%;">Type <span style="color:#DD4F43;">*</span></label>
                                            <select class="form-control" id="wType">
                                                <option disabled selected value>Account Type</option>
                                                <option>Personal</option>
                                                <option>Agent</option>

                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">

                                        <div class="form-group">
                                            <label style="text-align: left;width: 100%;">Amount <span style="color:#DD4F43;">*</span></label>
                                            <input type="text" name="first_name" id="wAmount" class="form-control input-lg" placeholder="Amount" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <label style="text-align: left;width: 100%;">To <span style="color:#DD4F43;">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="first_name" id="wTo" class="form-control input-lg" placeholder="To" tabindex="1">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12">

                                        <div class="form-group">
                                            <label style="text-align: left;width: 100%;">Password <span style="color:#DD4F43;">*</span></label>
                                            <input type="text" name="first_name" id="wPassword" class="form-control input-lg" placeholder="Password" tabindex="1">
                                        </div>
                                    </div>


                                </div>





                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6"><input type="submit" id="withdrawSubmit" value="Submit" class="btn btn-success btn-block btn-lg" tabindex="7"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Modal number verify -->
        <div id="numberVerify" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">

                    <div id="" class="showCategoryId"></div>
                    <div class="modal-header m-head" style="  background: #8000ff !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: white;"> &nbsp; Verification step</h4>
                    </div>
                    <div class="modal-body" style="padding: 2% !important">
                        <div class="">
                            <div role="form" class="register-form">

                                <div id="codeError" style="display: none" class="alert alert-danger codeError" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>  <strong>  Opps !!</strong> <span id="codeErrorText"></span>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">

                                        <div class="form-group">
                                            <label style="text-align: left;width: 100%;">Verify code <span style="color:#DD4F43;">*</span></label>
                                            <input type="text" name="first_name" id="Vcode" class="form-control input-lg" placeholder="Enter code" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <label style="text-align: left;width: 100%;">To account number <span style="color:#DD4F43;">*</span></label>
                                        <div class="form-group">
                                            <div class=""><button  id="sendCode"  class="btn btn-primary btn-block btn-lg" tabindex="7">send code</button></div>
                                        </div>
                                    </div>

                                </div>





                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6"><input style="display: none" type="submit" id="confirmCode" value="Submit" class="btn btn-success btn-block btn-lg" tabindex="7"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Modal changePassword-->
        <div id="changePassword" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header m-head" style="  background: #8000ff !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: white;">  &nbsp; Change Password</h4>
                    </div>
                    <div class="modal-body" style="padding: 2% !important">
                        <div class="">
                            <div role="form" class="register-form">

                                <div id="errorChangePassword" class="alert alert-danger errorChangePassword" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>  <strong>  Opps !!</strong> <span id="errorChangePasswordText"></span>
                                </div>
                                <hr class="colorgraph">


                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">Current Password  <span style="color:#DD4F43;">*</span></label>
                                    <input type="text" name="currentPassword" id="currentPassword" class="form-control input-lg" placeholder="Current Password " tabindex="3" required>
                                </div>

                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">New Password  <span style="color:#DD4F43;">*</span></label>
                                    <input type="text" name="newPassword" id="newPassword" class="form-control input-lg" placeholder="New Password" tabindex="3" required>
                                </div>

                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">Confirm Password  <span style="color:#DD4F43;">*</span></label>
                                    <input type="text" name="confirmPassword" id="confirmPasswordAgain" class="form-control input-lg" placeholder="Confirm Password" tabindex="3" required>
                                </div>




                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6"><input type="submit"  id="changePasswordSubmit" value="Submit" class="btn btn-success btn-block btn-lg" tabindex="7"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Modal balance Transfer-->
        <div id="balanceTransfer" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header m-head" style="  background: #8000ff !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: white;"> &nbsp; Balance Transfer</h4>
                    </div>
                    <div class="modal-body" style="padding: 2% !important">
                        <div class="">
                            <div role="form" class="register-form">

                                <div id="errorBalanceTransfer" class="alert alert-danger errorBalanceTransfer" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>  <strong>  Opps !!</strong> <span id="balanceTransferText"></span>
                                </div>
                                <hr class="colorgraph">
                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">To <span style="color:#DD4F43;">*</span></label>
                                    <input type="text" name="display_name" id="to_userId" class="form-control input-lg" placeholder="User Id" tabindex="3">
                                </div>


                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">Notes <span style="color:#DD4F43;">*</span></label>
                                    <input type="text" name="notes" id="notes" class="form-control input-lg" placeholder="Notes " tabindex="3">
                                </div>

                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">Amount <span style="color:#DD4F43;">*</span></label>
                                    <input type="text"  id="transferAmount" class="form-control input-lg" placeholder="Amount" tabindex="3">
                                </div>


                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">Password <span style="color:#DD4F43;">*</span></label>
                                    <input type="text"  id="transferPassword" class="form-control input-lg" placeholder="Password" tabindex="3">
                                </div>


                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6"><input type="submit" id="balanceTransferSubmit" value="Submit" class="btn btn-success btn-block btn-lg" tabindex="7"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Modal change club -->
        <div id="changeClub" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">


                    <div class="modal-header m-head" style="  background: #8000ff !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: white"> &nbsp; Change Club</h4>
                    </div>

                    <div class="modal-body" style="padding: 2% !important">
                        <div class="">
                            <div role="form" class="register-form">


                                <div id="errorchangeClub" class="alert alert-danger errorchangeClub" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>  <strong>  Opps !!</strong> <span id="errorchangeClubText"></span>
                                </div>
                                <hr class="colorgraph">

                                <div class="form-group">

                                    <label style="text-align: left;width: 100%;">Method<span style="color:#DD4F43;">*</span></label>

                                    <select class="form-control" id="cClub">
                                        <option disabled selected value>Select Club</option>
                                        <?php
                                        $query = "SELECT * FROM club";
                                        $resultMethod = $db->select($query);
                                        $i = 0;
                                        if ($resultMethod) {
                                            while ($method = $resultMethod->fetch_assoc()) {

                                                $i++;
                                                ?>
                                                <option value="<?php echo $method['userId']; ?>"><?php echo $method['name']; ?></option>

                                                <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                    <div class="form-group">

                                        <label style="text-align: left;width: 100%;"> Password  <span style="color:#DD4F43;">*</span></label>
                                        <input type="text" name="PasswordClubChange" id="PasswordClubChange" class="form-control input-lg" placeholder="Current Password " tabindex="3" required>
                                    </div>
                                </div>                
                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6"><input type="submit" id="changeClubSubmit" value="Update" class="btn btn-success btn-block btn-lg" tabindex="7"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <?php
        if (isset($_COOKIE["userId"]) && ( isset($_COOKIE["password"])) && ( isset($_COOKIE["id"]))) {
            $userId = $_COOKIE["userId"];
            $id = $_COOKIE["id"];
            $query = "select * from `user` where userId='$userId' and id='$id'";
            $result = $db->select($query);
            if ($result) {
                $userProfile = $result->fetch_assoc();
                ?>
                <section class="callaction ">
                    <div class="content-wrap" >

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-11 bhoechie-tab-container" style="width: 98.5% !important;background: #ffffff;">
                                    <div class="col-lg-2  bhoechie-tab-menu">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item active text-center list-item">
                                                Profile
                                            </a>

                                            <a href="#" class="list-group-item text-center list-item " id="deposit-numberW"  data-toggle="modal" data-target="#deposit">
                                                Deposit
                                            </a>
                                            <a href="#" id="1" class="list-group-item text-center list-item wDraw" data-toggle="modal" data-target="#withdraw">
                                                Withdraw
                                            </a>
                                            <a href="#" id="2" class="list-group-item text-center list-item Btrans" data-toggle="modal" data-target="#balanceTransfer">
                                                Balance Transfer
                                            </a>
                                            <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#changeClub">
                                                Change Club
                                            </a>
                                            <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#changePassword">
                                                Change Password
                                            </a>


                                        </div>
                                    </div>
                                    <div class="col-lg-10  bhoechie-tab">
                                        <!-- flight section -->
                                        <div class="bhoechie-tab-content ">
                                            <center>
                                                <table class="table table-bordered">

                                                    <tr>
                                                        <th style="color: #EE6A15;">Full Name</th>
                                                        <td style="color: #EE6A15;"><?php echo $userProfile['name']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Username</th>
                                                        <td style="color: #EE6A15;"><?php echo $userProfile['userId']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Mobile No.</th>
                                                        <td style="color: #EE6A15;"><?php echo $userProfile['mobileNumber']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Email</th>
                                                        <td style="color: #EE6A15;"><?php echo $userProfile['email']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Referred By</th>
                                                        <td style="color: #EE6A15;">
                                                            <?php echo $userProfile['sponsorUsername']; ?>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Club</th>
                                                        <td style="color: #EE6A15;">   <?php echo $userProfile['clubId']; ?>  </td>

                                                    </tr>

                                                </table>

                                            </center>
                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
            }
        } else {
            ?>
            <h1>You are Not Allow</h1>
            <?php
        }
        ?>


    </div>
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
    <script src="js/jquery.min_1.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/animate.js"></script>


    <script src="js/validation/deposit_and_withdraw.js"></script>
    <script src="js/validation/sendCode.js"></script>
    <script>
        $(document).ready(function () {
            $("#data-click").click(function () {
                $("#data-show").toggle("slow");
            });
        });

        $(document).ready(function () {
            $(".history_check").click(function () {
                $(".hitory_content").fadeIn("slow");
            });
        });
    </script>
      <script>

    
    $("#deposit-numberW").on("click", function () {

       $("#dTo").load('DepositNumber.php');

});
</script>
    <script>
        //wallet
        $(document).ready(function () {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });
        });
    </script>


</body>

</html>
