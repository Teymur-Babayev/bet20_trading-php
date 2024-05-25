<?php include './header.php'; ?>
<link rel="stylesheet" href="css/statementAndWallet.css">
<body>
    


    <div id=" " style="border-bottom: 1px solid #5F5F5F;min-height: 450px;" >



        <?php
        if (isset($_COOKIE["userId"]) && ( isset($_COOKIE["password"])) && ( isset($_COOKIE["id"]))) {
            $userId = $_COOKIE["userId"];
            $id = $_COOKIE["id"];
            ?>
            <section class="callaction container">
                <div class="content-wrap" >

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-11 bhoechie-tab-container" style="width: 98.5% !important;background: #ffffff;">
                                <div class="col-lg-2  bhoechie-tab-menu">
                                    <div class="list-group">

                                        <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#">
                                            Withdrawal
                                        </a>
                                        <a href="#" class="list-group-item text-center list-item" data-toggle="modal" data-target="#">
                                            Transaction History
                                        </a>


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

                                                                        <th scope="col" class="text-center">Amount</th>

                                                                        <th scope="col" class="text-center">Notes </th>
                                                                    

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

                                                                          
                                                                                <td><?php echo $DepositAndWithdraw['withdraw'] ?></td>
                                                                   
                                                                                <td><?php echo $DepositAndWithdraw['notes']; ?></td>
                                                                      

                                                                                <td><?php echo $DepositAndWithdraw['time']; ?></td>
                                                                                <td>

                                                                                    <?php
                                                                                    if ($DepositAndWithdraw['wAction'] == 0 && $DepositAndWithdraw['seen'] == 0) {
                                                                                        ?>
                                                                                        <div class="dropdown">
                                                                                            <button class="btn btn-primary btn-sm  dropdown-toggle" type="button" data-toggle="dropdown">Refund
                                                                                                <span class="caret"></span></button>
                                                                                            <ul class="dropdown-menu">
                                                                                                <li><a href="withdrawCancel.php?wCancel=<?php echo $DepositAndWithdraw['id']; ?>">Request Cancel</a></li>


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
                                                                                <th scope="col">Date & Time</th>
                                                                                <th scope="col">Description</th>
                                                                                <th scope="col">Debit (Out)</th>
                                                                                <th scope="col" class="text-center">Credit (In)</th>
                                                                                <th scope="col" class="text-center">Balance</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $query = "select * from `transaction` where clubId='$_COOKIE[userId]'";
                                                                            $resultTransaction = $db->select($query);
                                                                            $sum = 0;
                                                                            if ($resultTransaction) {
                                                                                foreach ($resultTransaction as $Transaction) {
                                                                                    ?>

                                                                                    <tr>
                                                                                        <td><?php echo $Transaction['time']; ?></td>
                                                                                        <td><?php echo $Transaction['description']; ?></td>
                                                                                        <td><?php echo $Transaction['clubDebit']; ?></td>
                                                                                        <td><?php echo $Transaction['clubCredit']; ?></td>
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

    <footer class="footer-basic-centered ">
    <div class="container">


        <div class="row">

            <div class="col-lg-3">
                <a  class="" href=""><img style="width: 150px;height: 60px;margin-left: 10px;" src="img/kkk.png"></a>
                <p style="font-size: 15px;color: #dcdcdc;" class="footer-company-name">bet22in &copy; <?php echo date("Y"); ?>  all right reserved.</p>
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

    <script type="text/javascript" src="a99nz/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="a99nz/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
        $('#sampleTable2').DataTable();
       // $('#sampleTable3').DataTable();
        $('#sampleTable4').DataTable();
        $('#sampleTable3').dataTable({
            aaSorting: [[4, 'desc']]
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
