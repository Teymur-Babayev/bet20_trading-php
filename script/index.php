<?php include './header.php'; ?>
<?php include './side.php'; ?>
<?php
if (isset($_POST['addSending'])) {

    $number = $_POST['number'];
    if ($number != '') {

        $query = "INSERT INTO `sending_money_number`(`phone`)"
                . " VALUES ('$number')";
        $result = $db->insert($query);
        if ($result) {
            
        }
    }
} else if (isset($_POST['addReceiving'])) {

    $number = $_POST['number'];
    if ($number != '') {

        $query = "INSERT INTO `receiving_money_number`(`phone`)"
                . " VALUES ('$number')";
        $result = $db->insert($query);
        if ($result) {
            
        }
    }
} else if (isset($_POST['addMethod'])) {
    //echo '<script> alert("successfull !") </script>';
    $method = $_POST['method'];
    $rate = $_POST['rate'];
    if ($method != '') {

        $query = "INSERT INTO `method`(`method`,rate)"
                . " VALUES ('$method','$rate')";
        $result = $db->insert($query);
        if ($result) {
            
        }
    }
} else if (isset($_POST['w_addMethod'])) {
    //echo '<script> alert("successfull !") </script>';
    $method = $_POST['method'];
    $rate = $_POST['rate'];
    if ($method != '') {

        $query = "INSERT INTO `w_method`(`method`,rate)"
                . " VALUES ('$method','$rate')";
        $result = $db->insert($query);
        if ($result) {
            
        }
    }
}

if (isset($_POST['Winactive'])) {

    $query = "UPDATE `withdraw_action` SET `action`=0";
    $result = $db->update($query);
}
if (isset($_POST['Wactive'])) {

    $query = "UPDATE `withdraw_action` SET `action`=1";
    $result = $db->update($query);
}
?>


<main class="app-content">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user-circle "></i>
                <div class="info">
                    <h6>Total user balance</h6>
                    <p>
                        <?php
                        $query = "select sum(balance) as total from user";
                        $UserTotalBalance = $db->select($query);

                        if ($UserTotalBalance) {
                            $UserTotalBalance = $UserTotalBalance->fetch_assoc();
                            echo round($UserTotalBalance['total'], 2);
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user-secret "></i>
                <div class="info">
                    <h6>Total club balance</h6>
                    <p>
                        <?php
                        $query = "select sum(balance) as total from club";
                        $UserTotalBalance = $db->select($query);

                        if ($UserTotalBalance) {
                            $UserTotalBalance = $UserTotalBalance->fetch_assoc();
                            echo round($UserTotalBalance['total'], 2);
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-vcard "></i>
                <div class="info">
                    <h6>Total user</h6>
                    <p>
                       <?php
                        $query = "select id from user";
                        $User = $db->select($query);

                        if ($User) {
                     
                            echo $User->num_rows;
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
                <div class="info">
                    <h6>Total deposit</h6>
                    <p>
                        <?php
                        $query = "select sum(balance) as total from club";
                        $UserTotalBalance = $db->select($query);

                        if ($UserTotalBalance) {
                            $UserTotalBalance = $UserTotalBalance->fetch_assoc();

                            //echo round($UserTotalBalance['total'],2);
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bs-component">
        <div class="card">
            <h5 class="card-header">All  Category</h5>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <div id="add-new-number" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" class="form-group" method="post">
                                            <div class="form-group">
                                                <label for="phone">Phone number:</label>
                                                <input name="number" type="text" class="form-control" id="number" autofocus required="1">
                                            </div>

                                            <button name="addSending" type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6>Withdraw Number</h6></li>
                                <?php
                                $query = "SELECT * FROM sending_money_number";
                                $resultsendingMoneyNumber = $db->select($query);
                                $i = 0;
                                if ($resultsendingMoneyNumber) {
                                    while ($sendingMoneyNumber = $resultsendingMoneyNumber->fetch_assoc()) {

                                        $i++;
                                        ?>
                                        <li class="list-group-item list-group-item-action" ><?php echo $sendingMoneyNumber['phone']; ?><a href="indexAction.php?sendingNumberDelete=<?php echo $sendingMoneyNumber['id']; ?>" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">delete</a></li>

                                        <?php
                                    }
                                }
                                ?>
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add-new-number">Add new</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <div id="add-new-number-rcv" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" class="form-group" method="post">
                                            <div class="form-group">
                                                <label for="phone">Phone number:</label>
                                                <input type="text" name="number" class="form-control" id="number" autofocus required="1">
                                            </div>

                                            <button name="addReceiving" type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6>Deposit Number</h6></li>
                                <?php
                                $query = "SELECT * FROM receiving_money_number";
                                $resultreceivingMoneyNumber = $db->select($query);
                                $i = 0;
                                if ($resultreceivingMoneyNumber) {
                                    while ($receivingMoneyNumber = $resultreceivingMoneyNumber->fetch_assoc()) {

                                        $i++;
                                        ?>
                                        <li class="list-group-item list-group-item-action" ><?php echo $receivingMoneyNumber['phone']; ?><a href="indexAction.php?recvNumberDelete=<?php echo $receivingMoneyNumber['id']; ?>" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">delete</a></li>

                                        <?php
                                    }
                                }
                                ?>

                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add-new-number-rcv">Add new</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <div id="add-new-number-method" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="" class="form-group" method="post">
                                            <div class="form-group">
                                                <label for="phone">Method:</label>
                                                <input name="method" type="text" class="form-control" id="number" placeholder="Method" autofocus required="1">
                                                <label for="rate">Converting Rate</label>
                                                <input name="rate" type="text" class="form-control" placeholder="Rate" id="number" autofocus required="1">
                                            </div>

                                            <button name="addMethod"type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6> deposit Method </h6></li>
                                <?php
                                $query = "SELECT * FROM method";
                                $resultMethod = $db->select($query);
                                $i = 0;
                                if ($resultMethod) {
                                    while ($method = $resultMethod->fetch_assoc()) {

                                        $i++;
                                        ?>
                                        <li class="list-group-item list-group-item-action" ><?php echo $method['method']; ?> <span  class="badge badge-primary"><?php echo $method['rate']; ?> </span><a href="indexAction.php?methodNumberDelete=<?php echo $method['id']; ?>" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">delete</a></li>

                                        <?php
                                    }
                                }
                                ?>

                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add-new-number-method">Add new</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <div id="add-new-number-w_method" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="" class="form-group" method="post">
                                            <div class="form-group">
                                                <label for="phone">Method:</label>
                                                <input name="method" type="text" class="form-control" id="number" placeholder="Method" autofocus required="1">
                                                <label for="rate">Converting Rate</label>
                                                <input name="rate" type="text" class="form-control" placeholder="Rate" id="number" autofocus required="1">
                                            </div>

                                            <button name="w_addMethod"type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6> withdraw Method </h6></li>
                                <?php
                                $query = "SELECT * FROM w_method";
                                $resultMethod = $db->select($query);
                                $i = 0;
                                if ($resultMethod) {
                                    while ($method = $resultMethod->fetch_assoc()) {

                                        $i++;
                                        ?>
                                        <li class="list-group-item list-group-item-action" ><?php echo $method['method']; ?> <span  class="badge badge-primary"><?php echo $method['rate']; ?> </span><a href="indexAction.php?w_methodNumberDelete=<?php echo $method['id']; ?>" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">delete</a></li>

                                        <?php
                                    }
                                }
                                ?>

                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add-new-number-w_method">Add new</a>

                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6> User Action </h6></li>

                                <li class="list-group-item list-group-item-action" >
                                    <form action="userAction.php" class="form-group" method="post">
                                        <input name="userN" type="text" class="form-control" placeholder="User name" id="number"  required="1"><br>

                                        <button name="userAction"type="submit" class="btn btn-info">Go...</button>
                                    </form>
                                </li>  






                            </div>
                        </div>
           
                    </div>


                </div>

            </div>

            <div class="card-footer text-muted"></div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>
<script type="text/javascript">
    $('#clubMember').DataTable();

</script>