<?php include './header.php'; ?>

<link rel="stylesheet" href="css/statementAndWallet.css">
<body>



    <div id=" "  style="border-bottom: 1px solid #5F5F5F;min-height: 450px;">



 
        <!-- Modal withdraw -->
        <div id="withdraw" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header m-head" style="  background: #27898c !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: #D2D2D2"> &nbsp;Request a withdraw</h4>
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
                  

                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">

                                        <div class="form-group">
                                            <label style="text-align: left;width: 100%;">Amount <span style="color:#DD4F43;">*</span></label>
                                            <input type="text" name="first_name" id="wAmount-c" class="form-control input-lg" placeholder="Amount" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <label style="text-align: left;width: 100%;">Password <span style="color:#DD4F43;">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="password" id="password-c" class="form-control input-lg" placeholder="Password" tabindex="1">
                                        </div>
                                    </div>

                                </div>





                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6"><input type="submit" id="withdrawSubmit-c" value="Submit" class="btn btn-success btn-block btn-lg" tabindex="7"></div>

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

                    <div class="modal-header m-head" style="  background: #14805E !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: #D2D2D2">  &nbsp; Change Password</h4>
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


        <?php
        if (isset($_COOKIE["userId"]) && ( isset($_COOKIE["password"])) && ( isset($_COOKIE["id"]))) {
            $userId = $_COOKIE["userId"];
            $id = $_COOKIE["id"];
            $query = "select * from `club` where userId='$userId' and id='$id'";
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

                                            <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#withdraw">
                                                Withdraw
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
                                                        <td><?php echo $userProfile['name']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Username</th>
                                                        <td><?php echo $userProfile['userId']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Mobile No.</th>
                                                        <td><?php echo $userProfile['mobileNumber']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="color: #EE6A15;">Email</th>
                                                        <td><?php echo $userProfile['email']; ?></td>

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
    <footer class="footer-basic-centered ">
    <div class="container">


        <div class="row">

            <div class="col-lg-3">
                <a  class="" href=""><img style="width: 150px;height: 60px;margin-left: 10px;" src="img/nnn.png"></a>
                <p style="font-size: 15px;color: #dcdcdc;" class="footer-company-name">bdbet65&copy; <?php echo date("Y"); ?>  all right reserved.</p>
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
            <div class="col-lg-3">
                <span class="userAlert"> Caution! We are strongly discourage to use this site who are not 18+ and also site administrator is not liable to any kind of issues created by user.</span>
            </div>
     
        </div>
    </div>

</footer>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min_1.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/animate.js"></script>


    <script src="js/validation/deposit_and_withdraw.js"></script>
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
