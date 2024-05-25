<?php
include './lib/Database.php';
$db = new Database();
date_default_timezone_set('Asia/Dhaka');
?>
<?php
if (isset($_GET["logout"])) {
    if (isset($_COOKIE["userId"]) AND isset($_COOKIE["password"]) AND isset($_COOKIE["club"])) {
        setcookie("userId",'',time()-(60*60*24*10));
        setcookie("password",'',time()-(60*60*24*10));
        setcookie("club",'',time()-(60*60*24*10));
    } else if (isset($_COOKIE["userId"]) AND isset($_COOKIE["password"])) {
        setcookie("userId",'',time()-(60*60*24*10));
        setcookie("password",'',time()-(60*60*24*10));
    }
      
    
}
if (isset($_GET['adminVisit'])) {
    $userId = $_GET['adminVisit'];
    $query = "select * from `user` where userId='$userId'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();

        //set up cookie
        setcookie("userId",$userId,time()+(60*60*24*10));
        setcookie("password",$row['password'],time()+(60*60*24*10));
        setcookie("id",$row['id'],time()+(60*60*24*10));
        setcookie("msg",0,time()+(60*60*24*10));
        $_SESSION['userId']=$userId;
    } else {
        $query = "select * from `club` where userId='$userId'";
        $result = $db->select($query);
        if ($result) {

            $row = $result->fetch_assoc();
            //set up cookie
            setcookie("userId",$userId,time()+(60*60*24*10));
            setcookie("password",$row['password'],time()+(60*60*24*10));
            setcookie("club",$userId,time()+(60*60*24*10));
            setcookie("id",$row['id'],time()+(60*60*24*10));
            setcookie("msg",0,time()+(60*60*24*10));
            $_SESSION['userId']=$userId;
        } else {
            echo 'no';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
         <title>Bet20 Best Betting Platform In Bangladesh</title>
         <link rel="shortcut icon" type="image/png" href="img/in.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="betting portal ,cricket,football,basketball" />
        <!-- css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/footer-basic-centered.css">
        <link rel="stylesheet" href="css/headerStyle.css">
        <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/indexStyle.css">
        <script type="text/javascript" src="js/date_time.js"></script>
    </head>


    <body style="background-color: #141c33 !important;">
        <!-- Modal deposit -->
        <div id="deposit" class="modal fade" role="dialog" >
            <div class="modal-dialog  " >

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header m-head" style="  background: #2c2656  !important;">

                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                        <h4 class="modal-title" style="color: #D2D2D2"> &nbsp; Request a deposit</h4>
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

        <div id="wrapper  " >
            <!-- start header -->
            <header >


                <nav class="navbar navbar-default heading-color">
                    <div class="container">
                         <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                        <!-- Brand and toggle get grouped for better mobile display -->
                                                   
                        <div class="log-sign" bis_skin_checked="1"> 
                       
                            <a  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                                       
                            </button>
                        </a>
                            
                            
                            
                             <a  class="" href="#"><img style="margin-right:29px;width: 90px;height: 45px;center: 35px;" src="img/kkk.png"></a> 
                            
                              <div class="colock ">
                                 <span id="date_time"></span></br>
                                <script type="text/javascript">window.onload = date_time('date_time');</script>
                             </div>
                        </div>         
                        
                          <div class="navbar-header ">
                            <table class="guest" id="content-mobile" style="width:96% ;margin: 0px auto">
                                <tr>
                                    <?php
                                    if (!isset($_COOKIE["userId"]) AND ( !isset($_COOKIE["password"]))) {
                                        ?>
                                           
                                         <td>
                                            
                                            <div style=" padding:7px; cursor: pointer;background: #dc3545 !important;color:#EDC145 !important;border: 1px solid #C29625 !important;"  class="panel text-center " data-toggle="modal" data-target="#SignUp"> 
                                               <span class="menu-icon fa fa-sign-out">Join</span>
                                            </div>

                                        </td>
                                        <td>
                                            <div  style=" padding:7px; cursor: pointer;background: #198754 !important;color:#EDC145 !important;border: 1px solid #C29625 !important;"  class="panel text-center " data-toggle="modal" data-target="#SignIn"> 
                                                <span class="menu-icon fa fa-sign-out">Log In</span>
                                            </div>

                                        </td>   
                                           
                                           
                                           
                                        <?php
                                    } else {
                                        $account = '';
                                        if (isset($_COOKIE["club"])) {

                                            $query = "select * from `club` where userId='$_COOKIE[userId]'";
                                            $result = $db->select($query);
                                            if ($result) {
                                                $account = $result->fetch_assoc();
                                            }
                                            ?>


                                            <?php
                                        } else {

                                            $query = "select * from `user` where userId='$_COOKIE[userId]'";
                                            $result = $db->select($query);
                                            if ($result) {
                                                $account = $result->fetch_assoc();
                                            }
                                        }
                                        ?>
                                         <div id="MyClockDisplay" class="clock;"style="background-color: #000080;" onload="showTime()"></div>
                                        <td>
                                             
                                            <div style=" padding:7px;cursor: pointer;background: #4C4C4C !important;color: #EDC145!important;border: px solid #A07403!important;"  class="panel text-center "> 

                                              <span style="color:white !important;">(<?php echo $_COOKIE["userId"]; ?>)  </span>  Balance: <?php echo $account['balance']; ?>
                                            </div>

                                        </td>
                                        <td>
                                            <?php
                                            if (isset($_COOKIE["club"])) {
                                                ?>
                                               <div  style=" padding: 7px;cursor: pointer;background: #4C4C4C !important;color: #EDC145!important;border: 1px solid #A07403!important;" class="panel text-center "> 
                                                Deposit
                                            </div>
                                                <?php
                                            } else {
                                                ?>
                                               <div  style="  padding: 7px;cursor: pointer;background: #4C4C4C !important;color: #EDC145!important;border: 1px solid #A07403!important;" class="panel text-center " data-toggle="modal" data-target="#deposit"> 
                                                Deposit
                                            </div>
                                                <?php
                                            }
                                            ?>
                                         

                                        </td>
                                    <?php }
                                    ?>
                                </tr>
                            </table>


                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                       <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right nv">
                                <?php
                                $account = '';
                                if (!isset($_COOKIE["userId"]) AND ( !isset($_COOKIE["password"]))) {
                                    ?>
                                    <li class="log-btn-top"><a style=" padding:10px 44px; border-radius: 4px; cursor: pointer;background: #198754 !important;color:#EDC145 !important;border: 1px solid #C29625 !important;"  href="" data-toggle="modal" data-target="#SignUp"><span class="menu-icon fa fa-sign-out">Sign Up</span></a></li>
                                    <li class="log-btn-top"><a style=" padding:10px 44px;border-radius: 4px; cursor: pointer;background: #dc3545 !important;color:#EDC145 !important;border: 1px solid #C29625 !important;" href=""   data-toggle="modal" data-target="#SignIn"><span class="menu-icon fa fa-sign-out">Login</span></a></li>
                                    <?php
                                } else {
                                    if (isset($_COOKIE["club"])) {

                                        $query = "select * from `club` where userId='$_COOKIE[userId]'";
                                        $result = $db->select($query);
                                        if ($result) {
                                            $account = $result->fetch_assoc();
                                        }
                                        ?>
                                        <li>
                                            <a href="#"><?php echo $_COOKIE["userId"]; ?></a>  
                                        </li>

                                        <div class="modal fade" id="clubMember" role="dialog">
                                            <div class="modal-dialog modal-lg " >

                                                <!-- Modal content-->
                                                <div class="modal-content m-content">
                                                    <div class="modal-header m-head" style="  background: #2c2656  !important;">

                                                        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                                                        <h4 class="modal-title" style="color: #C0C0C0">  &nbsp; All Sponsor's</h4>
                                                    </div>
                                                    <div class="modal-body" style="">
                                                        <div class="table-responsive">
                                                            <table  class="table table-bordered table-hover" id="clubMember">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SN.</th>
                                                                        <th>Joining Date</th>
                                                                        <th>Recent Bet Date</th>
                                                                        <th>Name</th>
                                                                        <th>User Id</th>
                                                                        <th>Total Bet</th> 
                                                                        <th>Commission Earned</th>  
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $totalBet = 0;
                                                                    $totalCommission = 0;
                                                                    $query = "select * from `user` where clubId='$_COOKIE[userId]'";
                                                                    $resultClubMember = $db->select($query);
                                                                    $count = 0;
                                                                    if ($resultClubMember) {
                                                                        foreach ($resultClubMember as $ClubMember) {
                                                                            $count++;
                                                                            ?>


                                                                            <tr>
                                                                                <td><?php echo $count; ?></td>
                                                                                <td><?php echo $ClubMember['time'] ?></td>
                                                                                <?php
                                                                                $query = "select * from `bet` where userId='$ClubMember[userId]' order by id desc";
                                                                                $resultRecentBet = $db->select($query);

                                                                                if ($resultRecentBet) {
                                                                                    $RecentBet = $resultRecentBet->fetch_assoc();
                                                                                    ?>
                                                                                    <td><?php echo $RecentBet['time'] ?></td>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <td> not yet bet </td>       
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <td><?php echo $ClubMember['name'] ?></td>
                                                                                <td><?php echo $ClubMember['userId'] ?></td>
                                                                                <?php
                                                                                $query = "select sum(betAmount) as betAmount from `bet` where userId='$ClubMember[userId]'";
                                                                                $betAmount = $db->select($query);

                                                                                if ($betAmount) {
                                                                                    $betAmountTotal = $betAmount->fetch_assoc();
                                                                                    $totalBet+=$betAmountTotal['betAmount'];
                                                                                    ?>
                                                                                    <td><?php echo $betAmountTotal['betAmount'] ?></td>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <td> not yet bet </td>       
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <?php
                                                                                $query = "select sum(clubCredit) as commission  from `transaction` where userId='$ClubMember[userId]' and clubId='$_COOKIE[userId]'";
                                                                                $betAmount = $db->select($query);

                                                                                if ($betAmount) {
                                                                                    $betAmountTotal = $betAmount->fetch_assoc();
                                                                                    $totalCommission+=$betAmountTotal['commission'];
                                                                                    ?>
                                                                                    <td><?php echo $betAmountTotal['commission'] ?></td>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <td> not yet bet </td>       
                                                                                    <?php
                                                                                }
                                                                                ?>


                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                    <div  class="alert alert-danger " role="alert">
                                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                                            ×</button>  <strong>  Opps !!</strong> Members not found !!
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>Page Total</th>
                                                                    <th><?php echo $totalBet; ?></th> 
                                                                    <th><?php echo $totalCommission; ?></th>  
                                                                </tr>

                                                                </tbody>

                                                            </table>
                                                        </div><!--end of .table-responsive-->
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <li >

                                            <a href="clubMember.php" >Club Member (<?php echo $count; ?> )</a>   
                                        </li>
                                        <li >

                                            <a href="clubHistory.php" >Club History</a>   
                                        </li>
                                        <li> <a style="" href="clubProfile.php" >  My Wallet</a></li>
                                        <li> <a style="" href="clubStatement.php" >My Statement</a></li>
                                        <li> <a>Balance ( <span  class=""><?php echo $account['balance'] * 1.00; ?></span>)</a></li>
                                        <li>  <a style="" href="?logout" >Log Out</a></li>



                                        <?php
                                    } else {

                                        $query = "select * from `user` where userId='$_COOKIE[userId]'";
                                        $result = $db->select($query);
                                        if ($result) {
                                            $account = $result->fetch_assoc();
                                            ?>
                                            <div class="modal fade" id="sponsor" role="dialog">
                                                <div class="modal-dialog  modal-lg" >

                                                    <!-- Modal content-->
                                                    <div class="modal-content m-content">
                                                        <div class="modal-header m-head" style="  background: #2c2656  !important;">

                                                            <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                                                            <h4 class="modal-title" style="color: #C0C0C0">  &nbsp; All Sponsor's</h4>
                                                        </div>
                                                        <div class="modal-body" style="">
                                                            <div class="table-responsive">
                                                                <table  class="table table-bordered table-hover" id="sampleTable2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No.</th>
                                                                            <th>Name</th>
                                                                            <th>User Id</th>
                                                                            <th>Email</th> 
                                                                            <th>Phone</th>  
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $query = "select * from user where sponsorUsername='$_COOKIE[userId]'";
                                                                        $resultUser = $db->select($query);
                                                                        $i = 0;
                                                                        if ($resultUser) {
                                                                            while ($user = $resultUser->fetch_assoc()) {

                                                                                $i++;
                                                                                ?>


                                                                                <tr>
                                                                                    <td><?php echo $i; ?></td>
                                                                                    <td><?php echo $user['name'] ?></td>
                                                                                    <td><?php echo $user['userId'] ?></td>
                                                                                    <td><?php echo $user['email'] ?></td>

                                                                                    <td><?php echo $user['mobileNumber'] ?></td>


                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                        <div  class="alert alert-danger " role="alert">
                                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                                                ×</button>  <strong>  Opps !!</strong> Sponsor's not found !!
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                    </tbody>

                                                                </table>
                                                            </div><!--end of .table-responsive-->
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <li >
                                                <a style="color: #DEC343 !important;">(<?php echo $_COOKIE["userId"]; ?>)  </a> </li>

                                            <li> <a  href="Wallet.php" >  My Wallet</a></li>
                                            <li> <a href="statement.php" >My Statement</a></li>
                                            <li><a  href="#" data-toggle="modal" data-target="#sponsor">

                                                    My Sponsor <?php //echo $account['sponsorUsername']; ?></a></li>
                                            <li> <a  href="#" >Balance ( <?php echo $account['balance'] * 1.00; ?> )</a></li>
                                            <li> <a  href="?logout" >Log Out</a></li>



                                            <?php
                                        }
                                    }
                                    ?>



                                    <?php
                                }
                                ?>

                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>
            <!-- end header -->

            <!-- Modal Login-->

            <div class="modal fade" id="SignIn" role="dialog">
                <div class="modal-dialog  " >

                    <!-- Modal content-->
                    <div class="modal-content m-content">
                        <div class="modal-header m-head" style="  background: #2c2656  !important;">

                            <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                            <h4 class="modal-title"  style="color: #D2D2D2">   &nbsp; Sign In</h4>
                        </div>
                        <div class="modal-body" style="padding: 2% !important">
                            <div class="signup-form">

                                <div  id="formData">

                                    <div id="errorSignIn" class="alert alert-danger errorSignIn" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            ×</button>  <strong>  Opps !!</strong> Please Insert Right Data !!
                                    </div>
                                    <div class="form-group">

                                        <label>User Id <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="userId" 
                                               value="<?php
                                               if (isset($_COOKIE["userId"])) {
                                                   echo $_COOKIE["userId"];
                                               }
                                               ?>" id="userIdOfuser" placeholder="user Id" required>
                                        <span id="userIdError" style="color: #C84038;font-family: initial;"></span>

                                    </div>


                                    <div class="form-group">

                                        <label>Password <span style="color: red">*</span></label>
                                        <input type="password" class="form-control" name="password" value="<?php
                                        if (isset($_COOKIE["password"])) {
                                            echo $_COOKIE["password"];
                                        }
                                        ?>" id="passwordOfuser" placeholder="password" required="required"  pattern=".{6,}"   title="6 characters minimum">
                                        <span>Password at least 6 characters.</span>

                                    </div>


                                    <div class="form-group">

                                        <button type="submit" id="userSignInForm"  name="userSignInForm"  class="btn btn-success btn-lg btn-block">Sign In</button>


                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- sign up -->
            <div id="SignUp" class="modal fade" role="dialog" >
                <div class="modal-dialog  " >

                    <!-- Modal content-->
                    <div class="modal-content m-content">
                        <div class="modal-header m-head" style="  background: #2c2656  !important;">

                            <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">&times;</button>
                            <h4 class="modal-title"  style="color: #C0C0C0"> &nbsp; Sign Up</h4>
                        </div>
                        <div class="modal-body" style="padding: 2% !important">
                            <div class="signup-form">

                                <div  id="formData">

                                    <div id="error" class="alert alert-danger error" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            ×</button>  <strong>  Opps !! </strong><span id="signuperrorText"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Full Name <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>User Id <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="userId" 
                                                       value="<?php
                                                       if (isset($_COOKIE["userId"])) {
                                                           echo $_COOKIE["userId"];
                                                       }
                                                       ?>" id="userId" placeholder="user Id" required>
                                                <span id="userIdError" style="color: #C84038;font-family: initial;"></span>
                                            </div>
                                        </div>        	
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Mobile Number <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="mobileNumber" id="mobileNumber" placeholder="mobileNumber" required>
                                                <span id="mobileError" style="color: #C84038;font-family: initial;"></span>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Email <span style="color: red">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="email" required="required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Select Club <span style="color: red">*</span></label>
                                                <select class="form-control" id="club" name="club">

                                                    <?php
                                                    $query = "SELECT * FROM `club`";
                                                    $resultClubTitle = $db->select($query);
                                                    $i = 0;
                                                    if ($resultClubTitle) {
                                                        while ($clubTitle = $resultClubTitle->fetch_assoc()) {

                                                            $i++;
                                                            ?>
                                                    <option value="<?php echo $clubTitle['userId'] ?>"><?php echo $clubTitle['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>




                                                </select>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Sponsor's Username</label>
                                                <input type="text" class="form-control" name="sponsor" id="sponsor" placeholder="Sponsor's Username" >
                                                <span id="sponsorError" style="color: #C84038;font-family: initial;"></span>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Password <span style="color: red">*</span></label>
                                                <input type="password" class="form-control" name="password" value="<?php
                                                if (isset($_COOKIE["password"])) {
                                                    echo $_COOKIE["password"];
                                                }
                                                ?>" id="password" placeholder="password" required="required"  pattern=".{6,}"   title="6 characters minimum">
                                                <span>Password at least 6 characters.</span>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Confirm Password <span style="color: red">*</span></label>
                                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="confirmPassword" required="required"  pattern=".{6,}"   title="6 characters minimum">
                                                <span id="passwordError" style="color: #C84038;font-family: initial;"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" id="userSignUp"  name="userSignUp"  class="btn btn-success btn-lg btn-block">Register Now</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

           