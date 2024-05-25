<?php include './header.php'; ?>
<?php include './side.php'; ?>
<?php
$type = '';
$userId = '';
$id = '';
//type 1 deposit & type 2 withdraw
if (isset($_GET['type']) && isset($_GET['user']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $userId = $_GET['user'];
    $id = $_GET['id'];
}
if (isset($_GET['accept']) && isset($_GET['amount']) && $_GET['type']==1) {
    $userId = $_GET['accept'];
    $amount = $_GET['amount'];
    $query = "update `admin_notification` set seen=1 WHERE userId='$userId' and seen='0'";
    $result = $db->update($query);

    if ($result) {

        $query = "INSERT INTO `transaction`(`userId`, `deposit`)"
                . " VALUES ('$userId','$amount')";
        $result = $db->insert($query);
        if ($result) {

            $query = "SELECT * FROM `user` WHERE userId='$userId'";
            $resultBalanceCheck = $db->select($query);

            if ($resultBalanceCheck) {
                $balance = $resultBalanceCheck->fetch_assoc();
                $amount+=$balance['balance'];


                $query = "update `user` set balance='$amount' WHERE userId='$userId'";
                $result = $db->update($query);
            }
            echo '<script>window.location.href="index.php"</script>';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else if (isset($_GET['accept']) && isset($_GET['amount']) && $_GET['type']==2) {
    $userId = $_GET['accept'];
    $amount = $_GET['amount'];
    $query = "update `admin_notification` set seen=1 WHERE userId='$userId' and seen='0'";
    $result = $db->update($query);

    if ($result) {

        $query = "INSERT INTO `transaction`(`userId`, `withdrawal`)"
                . " VALUES ('$userId','$amount')";
        $result = $db->insert($query);
        if ($result) {

            $query = "SELECT * FROM `user` WHERE userId='$userId'";
            $resultBalanceCheck = $db->select($query);

            if ($resultBalanceCheck) {
                $balance = $resultBalanceCheck->fetch_assoc();
                $amount=$balance['balance']- $amount;


                $query = "update `user` set balance='$amount' WHERE userId='$userId'";
                $result = $db->update($query);
            }
            echo '<script>window.location.href="index.php"</script>';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
?>
<?php
if ($type == 1) {
    $query = "SELECT * FROM `admin_notification` WHERE userId='$userId' and id='$id' and seen='0'";
    $result = $db->select($query);

    if ($result) {
        $deposit = $result->fetch_assoc();
        ?>


        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-file-text-o"></i> Deposit</h1>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <section class="invoice">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <h2 class="page-header"><i class="fa fa-user-circle"></i> <?php echo $userId; ?> </h2>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">Date: <?php echo $deposit['time']; ?></h5>
                                </div>
                            </div>
                            <div class="row invoice-info">

                                <div class="col-1">

                                </div>
                                <div class="col-6">
                                    <b>Amount</b> <?php echo $deposit['deposit']; ?><br>
                                    <b>From:</b> <?php echo $deposit['from_number']; ?><br>
                                    <b>To:</b> <?php echo $deposit['to_number']; ?><br>
                                    <b>Method:</b> <?php echo $deposit['pay_method']; ?><br>
                                    <b>Reference Number:</b> <?php echo $deposit['ref_number']; ?>
                                    ]</div>
                            </div>

                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right"><a onclick="return confirm('Are You oke ?');" class="btn btn-primary" href="?accept=<?php echo $userId; ?>&& amount=<?php echo $deposit['deposit']; ?> && type=1" target=""><i class="fa fa-recycle"></i> Accept</a></div>

                            </div>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right"><a onclick="return confirm('Are You oke ?');" class="btn btn-primary" href="?cancel=<?php echo $userId; ?> && type=1" target=""><i class="fa fa-crosshairs"></i> Cancel</a></div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
        <?php
    }
} else {
    $query = "SELECT * FROM `admin_notification` WHERE userId='$userId' and id='$id' and seen='0'";
    $result = $db->select($query);

    if ($result) {
        $deposit = $result->fetch_assoc();
        ?>
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-file-text-o"></i> Withdraw</h1>

                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item"><a href="#">Deposit</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <section class="invoice">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <h2 class="page-header"><i class="fa fa-user-circle"></i> User Id </h2>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">Date: 01/01/2016</h5>
                                </div>
                            </div>
                            <div class="row invoice-info">

                                <div class="col-1">

                                </div>
                                <div class="col-6">
                                    <b>Amount</b> <?php echo $deposit['withdraw']; ?><br>
                                    <b>Account Type:</b> <?php echo $deposit['acc_type']; ?><br>
                                    <b>To:</b> <?php echo $deposit['to_number']; ?><br>
                                    <b>Method:</b> <?php echo $deposit['pay_method']; ?><br>


                                </div>
                            </div>

                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right"><a onclick="return confirm('Are You oke ?');" class="btn btn-primary" href="?accept=<?php echo $userId; ?>&& amount=<?php echo $deposit['withdraw']; ?>&& type=2" target=""><i class="fa fa-recycle"></i> Accept</a></div>

                            </div>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right"><a onclick="return confirm('Are You oke ?');" class="btn btn-primary" href="?cancel=<?php echo $userId; ?> && type=2" target=""><i class="fa fa-crosshairs"></i> Cancel</a></div>

                            </div>

                        </section>
                    </div>
                </div>
            </div>
        </main>
        <?php
    }
}
?>


<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<!-- Google analytics script-->
<script type="text/javascript">
                            if (document.location.hostname == 'pratikborsadiya.in') {
                                (function (i, s, o, g, r, a, m) {
                                    i['GoogleAnalyticsObject'] = r;
                                    i[r] = i[r] || function () {
                                        (i[r].q = i[r].q || []).push(arguments)
                                    }, i[r].l = 1 * new Date();
                                    a = s.createElement(o),
                                            m = s.getElementsByTagName(o)[0];
                                    a.async = 1;
                                    a.src = g;
                                    m.parentNode.insertBefore(a, m)
                                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
                                ga('create', 'UA-72504830-1', 'auto');
                                ga('send', 'pageview');
                            }
</script>
</body>
</html>