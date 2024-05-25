<?php include './header.php'; ?>
<link rel="stylesheet" href="css/statementAndWallet.css">
<body>



    <div id=" " style="border-bottom: 1px solid #5F5F5F;min-height: 450px;" >



        <?php
        if (isset($_COOKIE["userId"]) && ( isset($_COOKIE["password"])) && ( isset($_COOKIE["id"]))) {
        $userId = $_COOKIE["userId"];
        $id = $_COOKIE["id"];
        ?>
        <section class="callaction ">
            <div class="content-wrap" >

                <div class="container">
                    <div class="row">
                        <div class="col-lg-11 bhoechie-tab-container" style="width: 98.5% !important;background: #ffffff;">
                            <div class="col-lg-2  bhoechie-tab-menu">
                                <div class="list-group">





                                    <a href="#" class="list-group-item active text-center list-item">
                                        All Bets
                                    </a>

                                    <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#">
                                        All Deposit
                                    </a>
                                    <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#">
                                        All Withdrawal
                                    </a>
                                    <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#">
                                        Balance Transfer
                                    </a>
                                    <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#">
                                        Transaction History
                                    </a>


                                </div>
                            </div>
                            <div class="col-lg-10  bhoechie-tab">
                                <!-- bet section -->
                                <div class="bhoechie-tab-content ">
                                    <center>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="tile">
                                                        <div class="tile-body">


                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered" id="sampleTable">

                                                                    <thead>
                                                                        <tr>
                                                                              <th scope="col">SN.</th>
                                                                            <th scope="col">Match</th>
                                                                            <th scope="col">Question</th>
                                                                            <th scope="col">Answer</th>

                                                                            <th scope="col" class="text-center">Amount</th>
                                                                            <th scope="col" class="text-center">Return Rate</th>
                                                                            <th scope="col" class="text-center">Return Amount(Won)</th>
                                                                            <th scope="col" class="text-center">Notes</th>
                                                                            <th scope="col" class="text-center">Win/Lose</th>
                                                                            <th scope="col" class="text-center">Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $i=0;
                                                                        $query = "select * from `bet` where userId='$userId' order by id desc";
                                                                        $resultBet = $db->select($query);
                                                                        if ($resultBet) {
                                                                        foreach ($resultBet as $bet) {
                                                                                   $i++;
                                                                        ?>

                                                                        <tr>
                                                                            <td><?php echo $i; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                $query = "select * from `betting_title` where id='$bet[matchId]'";
                                                                                $resultMatch = $db->select($query);
                                                                                if ($resultMatch) {
                                                                                $match = $resultMatch->fetch_assoc();

                                                                                if ($match['gameType'] == 1) {
                                                                                ?>
                                                                                <img src="./img/1393757333.png" width="27px;">&nbsp; 
                                                                                <?php
                                                                                } else if ($match['gameType'] == 2) {
                                                                                ?>
                                                                                <img src="./img/ka-pl.png" width="27px;">&nbsp; 
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                <img src="./img/basket.png" width="27px;">&nbsp; 
                                                                                <?php
                                                                                }

                                                                                echo $match['A_team'] . ' vs ' . $match['B_team'] . ' <> ' . $match['title'] . ' <> ' . $match['date'];
                                                                                ;
                                                                                }
                                                                                
                                                                                ?>
                                                                            </td>
                                                                            <td>

                                                                                <?php echo $bet['matchTitle']; ?>
                                                                            </td>
                                                                            <td><?php echo $bet['betTitle']; ?></td>

                                                                            <td><?php echo $bet['betAmount']; ?></td>
                                                                            <td><?php echo $bet['betRate']; ?></td>
                                                                            <td><?php echo $bet['betAmount'] * $bet['betRate']; ?></td>
                                                                            <td><?php echo $bet['notes']; ?></td>
                                                                            <td>

                                                                                <?php
                                                                                if ($bet['action'] > 0) {
                                                                                ?>

                                                                                <button style="" class="btn btn-default btn-sm "><span><i style="font-size: 20px; color: red" class="fa fa-crop"></i></span>
                                                                                </button>



                                                                                <?php
                                                                                } else if ($bet['betStatus'] == 1) {
                                                                                ?>

                                                                                <button style="" class="btn btn-default btn-sm "><span><i style="font-size: 20px; color:blue" class="fa fa-circle"></i></span>
                                                                                </button>



                                                                                <?php
                                                                                } else if ($bet['betStatus'] == 2) {
                                                                                ?>

                                                                                <button style="" class="btn btn-default btn-sm "><span><i style="font-size: 20px;color: red;" class="fa fa-circle"></i></span>
                                                                                </button>

                                                                                <?php
                                                                                } else if ($bet['betStatus'] == 0) {
                                                                                ?>

                                                                                <button class="btn btn-default btn-sm ">
                                                                                    <i class="fa fa-spinner fa-spin" style="font-size:20px"></i> </button>

                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <td><?php echo $bet['time']; ?></td>

                                                                        </tr>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>


                                                                    </tbody>

                                                                </table>
                                                            </div><!--end of .table-responsive-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </center>
                                </div>



                            </div>
                            <div class="col-lg-10  bhoechie-tab">
                                <!-- deposit section -->
                                <div class="bhoechie-tab-content ">
                                    <center>



                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="table-responsive">
                                                        <table  class="table table-bordered table-hover" id="sampleTable1">

                                                            <thead>
                                                                <tr>

                                                                    <th scope="col" class="text-center">To</th>
                                                                    <th scope="col" class="text-center">From</th>
                                                                    <th scope="col" class="text-center">Amount</th>
                                                                    <th scope="col" class="text-center">TrXID</th>
                                                                    <th scope="col" class="text-center">Rate</th>
                                                                    <th scope="col" class="text-center">Through</th>
                                                                    <th scope="col" class="text-center">Converted Rate</th>
                                                                    <th scope="col" class="text-center">Notes</th>

                                                                    <th scope="col" class="text-center">Requested At</th>
                                                                    <th scope="col" class="text-center">Action At</th>
                                                                    <th scope="col" class="text-center">Action</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $query = "select * from `admin_notification` where userId='$userId' and  notificationType=1 order by id desc";
                                                                $resulDepositAndWithdraw = $db->select($query);
                                                                if ($resulDepositAndWithdraw) {
                                                                foreach ($resulDepositAndWithdraw as $DepositAndWithdraw) {
                                                                ?>

                                                                <tr>
                                                                    <td><?php echo $DepositAndWithdraw['to_number']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['from_number']; ?></td>

                                                                    <td><?php echo $DepositAndWithdraw['deposit']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['ref_number']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['rate']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['pay_method']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['rate'] * $DepositAndWithdraw['deposit']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['notes']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['time']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['actionAt']; ?></td>

                                                                    <td>

                                                                        <?php
                                                                        if ($DepositAndWithdraw['action'] == 0 && $DepositAndWithdraw['seen'] == 0) {
                                                                        ?>

                                                                        <button class="btn btn-primary btn-sm  dropdown-toggle" type="button" data-toggle="dropdown">Requested
                                                                        </button>

                                                                        <?php
                                                                        } else if ($DepositAndWithdraw['action'] == 1 && $DepositAndWithdraw['seen'] == 0) {
                                                                        ?>

                                                                        <button class="btn btn-success btn-sm ">
                                                                            <i class="fa fa-spinner fa-spin" style="font-size:20px"></i> </button>

                                                                        <?php
                                                                        } else if ($DepositAndWithdraw['seen'] == 1) {
                                                                        ?>

                                                                        <button style="background:#004d67;" class="btn btn-success btn-sm "><span><i style="font-size: 20px; " class="fa fa-check-square-o"></i></span>
                                                                        </button>



                                                                        <?php
                                                                        } else if ($DepositAndWithdraw['seen'] == 0 && $DepositAndWithdraw['action'] == 3) {
                                                                        ?>

                                                                        <button class="btn btn-danger btn-sm " >Request Canceled</button>



                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                </tr>
                                                                <?php
                                                                }
                                                                }
                                                                ?>

                                                            </tbody>

                                                        </table>
                                                    </div><!--end of .table-responsive-->
                                                </div>
                                            </div>
                                        </div>


                                    </center>
                                </div>



                            </div>
                            <div class="col-lg-10  bhoechie-tab">
                                <!-- withdraw section -->
                                <div class="bhoechie-tab-content ">
                                    <center>



                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="table-responsive">
                                                        <table  class="table table-bordered table-hover" id="sampleTable22">

                                                            <thead>
                                                                <tr>

                                                                    <th scope="col" class="text-center">To</th>
                                                                    <th scope="col" class="text-center">Converted Rate</th>
                                                                    <th scope="col" class="text-center"> Rate</th>
                                                                    <th scope="col" class="text-center">Through</th>
                                                                    <th scope="col" class="text-center">Amount</th>

                                                                    <th scope="col" class="text-center">Notes </th>
                                                                    <th scope="col" class="text-center">From </th>

                                                                    <th scope="col" class="text-center">Requested At</th>

                                                                    <th scope="col" class="text-center">Action</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $query = "select * from `admin_notification` where userId='$userId' and  notificationType=2 order by id desc";
                                                                $resulDepositAndWithdraw = $db->select($query);
                                                                if ($resulDepositAndWithdraw) {
                                                                foreach ($resulDepositAndWithdraw as $DepositAndWithdraw) {
                                                                ?>

                                                                <tr>

                                                                    <td><?php echo $DepositAndWithdraw['to_number']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['withdraw'] * $DepositAndWithdraw['rate']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['rate']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['pay_method']; ?></td> 
                                                                    <td><?php echo $DepositAndWithdraw['withdraw']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['notes']; ?></td>
                                                                    <td><?php echo $DepositAndWithdraw['confirm_number']; ?></td>

                                                                    <td><?php echo $DepositAndWithdraw['time']; ?></td>
                                                                    <td>

                                                                        <?php
                                                                        if ($DepositAndWithdraw['wAction'] == 0 && $DepositAndWithdraw['seen'] == 0) {
                                                                        ?>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-primary btn-sm  dropdown-toggle" type="button" data-toggle="dropdown">pending
                                                                                <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu">
                                                                                
                                                                                

                                                                            </ul>
                                                                        </div>
                                                                        <?php
                                                                        } else if ($DepositAndWithdraw['wAction'] == 1 && $DepositAndWithdraw['seen'] == 0) {
                                                                        ?>

                                                                        <button class="btn btn-success btn-sm ">
                                                                            <i class="fa fa-spinner fa-spin" style="font-size:20px"></i> </button>

                                                                        <?php
                                                                        } else if ($DepositAndWithdraw['seen'] == 1) {
                                                                        ?>

                                                                        <button style="background: #14805E;" class="btn btn-success btn-sm "><span><i style="font-size: 20px; " class="fa fa-check-square-o"></i></span>
                                                                        </button>



                                                                        <?php
                                                                        } else if ($DepositAndWithdraw['seen'] == 0 && $DepositAndWithdraw['wAction'] == 3) {
                                                                        ?>

                                                                        <a class="btn btn-danger btn-sm ">Request Canceled </a>



                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                </tr>
                                                                <?php
                                                                }
                                                                }
                                                                ?>

                                                            </tbody>

                                                        </table>
                                                    </div><!--end of .table-responsive-->
                                                </div>
                                            </div>
                                        </div>


                                    </center>
                                </div>



                            </div>
                            <div class="col-lg-10  bhoechie-tab">

                                <!-- balance transfer section -->
                                <div class="bhoechie-tab-content ">
                                    <center>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="tile">
                                                        <div class="tile-body">


                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered" id="sampleTable4">

                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">to_userId</th>
                                                                            <th scope="col">Amount</th>
                                                                            <th scope="col">Notes</th>
                                                                            <th scope="col">Time</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $query = "select * from `balance_transfer` where userId='$userId' order by id desc";
                                                                        $resultBet = $db->select($query);
                                                                        if ($resultBet) {
                                                                        foreach ($resultBet as $bet) {
                                                                        ?>

                                                                        <tr>
                                                                            <td><?php echo $bet['to_userId']; ?></td>
                                                                            <td><?php echo $bet['amount']; ?></td>
                                                                            <td><?php echo $bet['notes']; ?></td>
                                                                            <td><?php echo $bet['time']; ?></td>


                                                                        </tr>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>


                                                                    </tbody>

                                                                </table>
                                                            </div><!--end of .table-responsive-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </center>
                                </div>



                            </div>
                            <div class="col-lg-10  bhoechie-tab">


                                <!-- Transaction history section -->
                                <div class="bhoechie-tab-content ">
                                    <center>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="tile">
                                                        <div class="tile-body">


                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered" id="sampleTable3">

                                                                    <thead>
                                                                        <tr>
                                                                              <th scope="col">SN.</th>
                                                                            <th scope="col">Date & Time</th>
                                                                            <th scope="col">Description</th>
                                                                            <th scope="col">Debit (Out)</th>
                                                                            <th scope="col" class="text-center">Credit (In)</th>
                                                                            <th scope="col" class="text-center">Balance</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $i=0;
                                                                        $query = "select * from `transaction` where userId='$userId' and (clubCredit=0 and clubDebit=0) ORDER BY id desc";
                                                                        $resultTransaction = $db->select($query);

                                                                        if ($resultTransaction) {
                                                                        foreach ($resultTransaction as $Transaction) {
                                                                            $i++;
                                                                        ?>

                                                                        <tr>
                                                                            <td><?php echo $i; ?></td>
                                                                            <td><?php echo $Transaction['time']; ?></td>
                                                                            <td><?php echo $Transaction['description']; ?></td>
                                                                            <td><?php echo $Transaction['debit']; ?></td>
                                                                            <td><?php echo $Transaction['credit']; ?></td>
                                                                            <td><?php echo $Transaction['total']; ?></td>

                                                                        </tr>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>


                                                                    </tbody>

                                                                </table>
                                                            </div><!--end of .table-responsive-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </center>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
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

    <script type="text/javascript" src="a99nz/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="a99nz/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        //  $('#sampleTable').DataTable();
        $('#sampleTable1').DataTable();
        $('#sampleTable22').DataTable();
        // $('#sampleTable3').DataTable();
        $('#sampleTable4').DataTable();

        $('#sampleTable3').dataTable({
            aaSorting: [[0, 'asc']]
        });
        $('#sampleTable').dataTable({
        
        });
    </script>
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
