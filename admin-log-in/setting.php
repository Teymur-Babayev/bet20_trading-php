<?php include './header.php'; ?>
<?php include './side.php'; ?>
<?php
if (isset($_POST['addMember'])) {
    $name = $_POST['name'];

    $password = $_POST['password'];

    $userId = $_POST['userId'];

    $query = "SELECT * FROM `admin` WHERE userName='$userId'";
    $result = $db->select($query);

    if ($result) {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> User Id Already exist.
        </div>
        <?php
    } else {

        $query = "INSERT INTO `admin`(`name`,`userName`, `password`,`type`)"
                . " VALUES ('$name','$userId','$password','2')";
        $resultClubInsert = $db->insert($query);

        if ($resultClubInsert) {
            
        }
    }
}
if (isset($_POST['addMemberThird'])) {
    $name = $_POST['name'];

    $password = $_POST['password'];

    $userId = $_POST['userId'];

    $query = "SELECT * FROM `admin` WHERE userName='$userId'";
    $result = $db->select($query);

    if ($result) {
        ?>
        <div  class="alert alert-danger errorWithraw" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>  <strong>  Opps !!</strong> User Id Already exist.
        </div>
        <?php
    } else {

        $query = "INSERT INTO `admin`(`name`,`userName`, `password`,`type`)"
                . " VALUES ('$name','$userId','$password','3')";
        $resultClubInsert = $db->insert($query);

        if ($resultClubInsert) {
            
        }
    }
}

if (isset($_POST['updateBalance'])) {
    $balance = $_POST['balance'];

    $query = "SELECT `balance` FROM `admin` where type=1";
    $resultAdmin = $db->select($query);
    $adminBalance = 0;
    if ($resultAdmin) {
        $resultAdmin = $resultAdmin->fetch_assoc();
        $adminBalance = $resultAdmin['balance'];
    }
    $adminBalance+=$balance;
    $query = "UPDATE `admin` SET "
            . "`balance`='$adminBalance'"
            . " WHERE type=1";
    $resultClubInsert = $db->update($query);
}
if (isset($_POST['updateSecond'])) {
    $userSecond = $_POST['userSecond'];
    $password = $_POST['password'];
      $uId = $_POST['uId'];

    $query = "UPDATE `admin` SET "
            . "`userName`='$userSecond' ,"
              . "`password`='$password'"
            . " WHERE id='$uId'";
   $db->update($query);
}

if (isset($_POST['updateMinimum'])) {
    $balance = $_POST['balance'];
    $query = "UPDATE `rule` SET"
            . " `minimumBalance`='$balance'";
    $db->update($query);
} else if (isset($_POST['updateWait'])) {
    $id = $_POST['time'];
    $query = "UPDATE `rule` SET"
            . " `waitingTime`='$id'";
    $db->update($query);
} else if (isset($_POST['updateWaitDeposit'])) {
    $id = $_POST['time'];
    $query = "UPDATE `rule` SET"
            . " `waitingTimeAfterDeposit`='$id'";
    $db->update($query);
} else if (isset($_POST['updateSponsor'])) {
    $balance = $_POST['balance'];
    $query = "UPDATE `rule` SET"
            . " `userSponsor`='$balance'";
    $db->update($query);
} else if (isset($_POST['updateClub'])) {
    $balance = $_POST['balance'];
    $query = "UPDATE `rule` SET"
            . " `clubCommission`='$balance'";
    $db->update($query);
}
?>

<main class="app-content">

    <div class="bs-component">
        <div class="card">
            <h5 class="card-header">Setting</h5>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <div id="add-new-number" class="modal" style=" ">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" name="name" type="text" placeholder="Enter full name" required="1">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">User Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" name="userId" type="text" placeholder="user name" required="1">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Password</label>
                                                <div class="col-md-8">
                                                    <input class="form-control col-md-8" name="password" type="password" placeholder="Enter Password" required="1">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="control-label col-md-3"></label>
                                                <div class="col-md-8">
                                                    <input name="addMember" class="form-control btn btn-success" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">

                                <li class="list-group-item list-group-item-action "><h6>2nd Panel Admin</h6></li>
                                <?php
                                $query = "SELECT * FROM admin where type=2";
                                $resultsendingMoneyNumber = $db->select($query);
                                $i = 0;
                                if ($resultsendingMoneyNumber) {
                                    while ($sendingMoneyNumber = $resultsendingMoneyNumber->fetch_assoc()) {

                                        $i++;
                                        ?>
                                        <div id="update-2nd" class="modal" style=" ">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" method="post" >
                                                            <div class="form-group ">

                                                                <div class="">
                                                                    <input class="form-control" name="uId" type="hidden" value="<?php echo $sendingMoneyNumber['id']; ?>">
                                                                    <input class="form-control" name="userSecond" type="text" placeholder="user Name" required="1">
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">

                                                                <div class="">
                                                                    <input class="form-control" name="password" type="text" placeholder="password" required="1">
                                                                </div>
                                                            </div> 

                                                            <div class="form-group ">

                                                                <div class="">
                                                                    <input name="updateSecond" class="form-control btn btn-success" type="submit" value="Submit">
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <li class="list-group-item list-group-item-action" ><?php echo $sendingMoneyNumber['userName']; ?><a href=""  data-toggle="modal" data-target="#update-2nd" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">Update</a></li>

                                        <?php
                                    }
                                }
                                ?>
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add-new-number">Add new</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <div id="add-new-thirdPanel" class="modal" style=" ">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" name="name" type="text" placeholder="Enter full name" required="1">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">User Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" name="userId" type="text" placeholder="user name" required="1">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Password</label>
                                                <div class="col-md-8">
                                                    <input class="form-control col-md-8" name="password" type="password" placeholder="Enter Password" required="1">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="control-label col-md-3"></label>
                                                <div class="col-md-8">
                                                    <input name="addMemberThird" class="form-control btn btn-success" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6>3rd Panel Admin</h6></li>
                                <?php
                                $query = "SELECT * FROM admin where type=3";
                                $resultsendingMoneyNumber = $db->select($query);
                                $i = 0;
                                if ($resultsendingMoneyNumber) {
                                    while ($sendingMoneyNumber = $resultsendingMoneyNumber->fetch_assoc()) {

                                        $i++;
                                        ?>
                                        <li class="list-group-item list-group-item-action" ><?php echo $sendingMoneyNumber['userName']; ?><a href="" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">Update</a></li>

                                        <?php
                                    }
                                }
                                ?>
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add-new-thirdPanel">Add new</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <div id="update-minimum" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group ">

                                                <div class="">
                                                    <input class="form-control" name="balance" type="text" placeholder="Enter Minimum balance" required="1">
                                                </div>
                                            </div>                             

                                            <div class="form-group ">

                                                <div class="">
                                                    <input name="updateMinimum" class="form-control btn btn-success" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="update-wait" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group ">

                                                <div class="">
                                                    <input class="form-control" name="time" type="text" placeholder="Enter Minimum waiting time" required="1">
                                                </div>
                                            </div>                             

                                            <div class="form-group ">

                                                <div class="">
                                                    <input name="updateWait" class="form-control btn btn-success" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="update-wait-deposit" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group ">

                                                <div class="">
                                                    <input class="form-control" name="time" type="text" placeholder="Enter Minimum waiting time" required="1">
                                                </div>
                                            </div>                             

                                            <div class="form-group ">

                                                <div class="">
                                                    <input name="updateWaitDeposit" class="form-control btn btn-success" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="update-club" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group ">

                                                <div class="">
                                                    <input class="form-control" name="balance" type="text" placeholder="Enter club commission" required="1">
                                                </div>
                                            </div>                             

                                            <div class="form-group ">

                                                <div class="">
                                                    <input name="updateClub" class="form-control btn btn-success" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="update-sponsor" class="modal" style=" ">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" >
                                            <div class="form-group ">

                                                <div class="">
                                                    <input class="form-control" name="balance" type="text" placeholder="Enter sponsor" required="1">
                                                </div>
                                            </div>                             

                                            <div class="form-group ">

                                                <div class="">
                                                    <input name="updateSponsor" class="form-control btn btn-success" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6>User rules</h6></li>
                                <?php
                                $query = "SELECT * FROM rule";
                                $resultsendingMoneyNumber = $db->select($query);

                                if ($resultsendingMoneyNumber) {
                                    $rule = $resultsendingMoneyNumber->fetch_assoc()
                                    ?>
                                    <li class="list-group-item list-group-item-action" > Minimum balance <span class="badge badge-info"><?php echo $rule['minimumBalance']; ?> Tk</span><a data-toggle="modal" data-target="#update-minimum" href="" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">Update</a></li>
                                    <li class="list-group-item list-group-item-action" >  Waiting time after win <span class="badge badge-info"><?php echo $rule['waitingTime']; ?> Min</span> <a data-toggle="modal" data-target="#update-wait" href="" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">Update</a></li>
                                    <li class="list-group-item list-group-item-action" >  Waiting time after deposit <span class="badge badge-info"><?php echo $rule['waitingTimeAfterDeposit']; ?> Min</span> <a data-toggle="modal" data-target="#update-wait-deposit" href="" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">Update</a></li>
                                    <li class="list-group-item list-group-item-action" > All club Commission <span class="badge badge-info"><?php echo $rule['clubCommission']; ?> Min</span> <a data-toggle="modal" data-target="#update-club" href="" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">Update</a></li>
                                    <li class="list-group-item list-group-item-action" > All user sponsor <span class="badge badge-info"><?php echo $rule['userSponsor']; ?> Min</span> <a data-toggle="modal" data-target="#update-sponsor" href="" onclick="return confirm('are you sure ?')"class=" btn btn-sm btn-info pull-right">Update</a></li>
                                    <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 15px;">

                        <div class="bs-component">
                            <div class="list-group">
                                <li class="list-group-item list-group-item-action "><h6> Balance </h6></li>
                                <?php
                                $query = "SELECT * FROM admin where type=1";
                                $resultMethod = $db->select($query);
                                $i = 0;
                                if ($resultMethod) {
                                    $method = $resultMethod->fetch_assoc();

                                    $i++;
                                    ?>
                                    <li class="list-group-item list-group-item-action" ><?php echo $method['balance']; ?> </li>

                                    <div id="updateBalance" class="modal" style=" ">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="" class="form-group" method="post">
                                                        <div class="form-group">

                                                            <input name="balance" type="text" value="<?php echo $method['balance']; ?>" class="form-control" id="number" placeholder="Method" autofocus required="1">

                                                        </div>

                                                        <button name="updateBalance"type="submit" class="btn btn-info">Submit</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#updateBalance">Update Balance</a>

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