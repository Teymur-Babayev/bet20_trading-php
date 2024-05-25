<?php include './header.php'; ?>
<?php include './side.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/bt.js"></script>
<link href="css/bt.css" rel="stylesheet" />
<script src="js/slelect.js"></script>
<link href="css/select.css" rel="stylesheet" />

<main class="app-content">

    <div class="app-title">
        <div>
            <h5><i class="fa fa-th-list"></i> All Club</h5>
            <?php
            $query = "select sum(balance) as total from club";
            $UserTotalBalance = $db->select($query);
            if ($UserTotalBalance) {
                $UserTotalBalance = $UserTotalBalance->fetch_assoc();
                ?>
                <span style="color: green">Total club balance=<?php
                    echo round($UserTotalBalance['total'], 2);
                }
                ?></span>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_POST['addClub'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $mobileNumber = $_POST['mobileNumber'];
                $userId = $_POST['userId'];
                $commissionRate = $_POST['commissionRate'];

                $query = "SELECT * FROM `user` WHERE userId='$userId'";
                $result = $db->select($query);

                if ($result) {
                    ?>
                    <div  class="alert alert-danger errorWithraw" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>  <strong>  Opps !!</strong> User Id Already exist.
                    </div>
                    <?php
                } else {
                    $query = "SELECT * FROM `club` WHERE userId='$userId'";
                    $result = $db->select($query);

                    if ($result) {
                        ?>
                        <div  class="alert alert-danger errorWithraw" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                ×</button>  <strong>  Opps !!</strong> User Id Already exist.
                        </div>
                        <?php
                    } else {
                        $query = "INSERT INTO `club`(`name`, `userId`, `password`, `mobileNumber`, `email`,rate)"
                                . " VALUES ('$name','$userId','$password','$mobileNumber','$email','$commissionRate')";
                        $resultClubInsert = $db->insert($query);

                        if ($resultClubInsert) {
                            
                        }
                    }
                }
            }
            if (isset($_POST['updateClub'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $id = $_POST['id'];
                $mobileNumber = $_POST['mobileNumber'];
                $userId = $_POST['userId'];
                $commissionRate = $_POST['rate'];
                $password = $_POST['password'];



                $query = "UPDATE `club` SET"
                        . " `name`='$name',"
                        . "`userId`='$userId',"
                        . "`password`='$password',"
                        . "`mobileNumber`='$mobileNumber',"
                        . "`email`='$email',"
                        . "`rate`='$commissionRate'"
                        . " WHERE id='$id'";
                $resultClubInsert = $db->update($query);

                if ($resultClubInsert) {
                    
                } else {
                    
                }
            }
            if (isset($_POST['active'])) {
                $id = $_POST['id'];
                $query = "UPDATE `club` SET"
                        . " `active`='1'"
                        . " WHERE id='$id'";
                $db->update($query);
            } else if (isset($_POST['inactive'])) {
                $id = $_POST['id'];
                $query = "UPDATE `club` SET"
                        . " `active`='0'"
                        . " WHERE id='$id'";
                $db->update($query);
            } else if (isset($_POST['setPersonalId'])) {
                $id = $_POST['id'];
                $personalId = $_POST['personalId'];
                $query = "UPDATE `club` SET"
                        . " `personalIdOfClub`='$personalId'"
                        . " WHERE id='$id'";
                $db->update($query);
            } else if (isset($_POST['changePersonalId'])) {
                $id = $_POST['id'];
                $personalId = $_POST['personalId'];
                $query = "UPDATE `club` SET"
                        . " `personalIdOfClub`='$personalId'"
                        . " WHERE id='$id'";
                $db->update($query);
            } else if (isset($_POST['clubDelete'])) {
                /*  $id = $_POST['id'];
                  $query = "DELETE FROM `club` WHERE id='$id'";
                  $db->delete($query); */
            }
            ?>
            <div id="add-club" class="modal" style="">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Club</h5>
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
                                    <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-8">
                                        <input class="form-control col-md-8" name="email" type="email" placeholder="Enter email address" required="1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Mobile Number</label>
                                    <div class="col-md-8">
                                        <input class="form-control col-md-8" name="mobileNumber" type="text" placeholder="Enter Mobile Number" required="1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Commission Rate</label>
                                    <div class="col-md-8">
                                        <input class="form-control col-md-8" name="commissionRate" type="text" placeholder="Commission Rate" required="1">
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
                                        <input name="addClub" class="form-control btn btn-success" type="submit" value="Submit">
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <a class="btn btn-primary icon-btn" href="" data-toggle="modal" data-target="#add-club"><i class="fa fa-plus"></i>Add Item	</a>
            <a class="btn btn-primary icon-btn" href="?sortByBalance"><i class="fa fa-refresh"></i>sort By Balance	</a>
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <?php
                        $resultClub = '';
                        if (isset($_GET['sortByBalance'])) {
                            ?>
                            <table class="table table-hover table-bordered" id="sampleTable2">
                                <?php
                            } else {
                                ?>
                                <table class="table table-hover table-bordered" id="sampleTable11">
                                    <?php
                                }
                                ?>



                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Id</th>
                                        <th>Amount of Member</th>
                                        <th>Balance</th>

                                        <th>Personal Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from club";
                                    $resultClub = $db->select($query);



                                    $i = 0;
                                    if ($resultClub) {
                                        while ($club = $resultClub->fetch_assoc()) {

                                            $i++;
                                            ?>


                                            <tr>
                                                <td><?php echo $club['name'] ?></td>
                                                <td><?php echo $club['userId'] ?></td>
                                                <td>

                                                    <?php
                                                    $mem = 0;
                                                    $query = "select * from user where clubId='$club[userId]'";
                                                    $clubMember = $db->select($query);
                                                    $i = 0;

                                                    if ($clubMember) {
                                                        $mem = $clubMember->num_rows;
                                                    }
                                                    ?>
                                                    <?php echo $mem; ?>


                                                    <div id="info-of-club-<?php echo $club['id'] ?>" class="modal" style="">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Club Information</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="" class="form-group">
                                                                        <table class="table table-bordered">

                                                                            <tr>
                                                                                <th> Full Name</th>
                                                                                <td>

                                                                                    <input  name="id" type="hidden" value="<?php echo $club['id'] ?>">
                                                                                    <input class="form-control" name="name" type="text" value="<?php echo $club['name'] ?>">

                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <th>Username</th>
                                                                                <td>
                                                                                    <input class="form-control" name="userId" type="text" value="<?php echo $club['userId'] ?>">
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <th> Mobile No.</th>
                                                                                <td>
                                                                                    <input class="form-control" name="mobileNumber" type="number" value="<?php echo $club['mobileNumber'] ?>">
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <th>Email</th>
                                                                                <td>
                                                                                    <input class="form-control" type="email" name="email" value="<?php echo $club['email'] ?>">
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <th>password</th>
                                                                                <td>
                                                                                    <input class="form-control" type="text" name="password" value="<?php echo $club['password'] ?>">
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <th>Commission Rate</th>
                                                                                <td>
                                                                                    <input class="form-control" name="rate" type="text" value="<?php echo $club['rate'] ?>">
                                                                                </td>

                                                                            </tr>


                                                                        </table>
                                                                        <div class="row">
                                                                            <div class="col-4"></div>
                                                                            <div class="col-4"> <button type="submit" name="updateClub" onclick="return confirm('are you sure ?')" class="btn btn-success">Save Change</button></div>
                                                                            <div class="col-4"></div>

                                                                        </div>

                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </td>
                                                <td><?php echo $club['balance'] ?></td>
                                                <td><?php echo $club['personalIdOfClub'] ?></td>

                                                <td>  

                                                    <table style="border: 0px !important;">
                                                        <tr style="border: 0px !important;">
                                                            <td style="border: 0px !important;"> 
                                                                <a  class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#member-of-club-<?php echo $club['id'] ?>">All Member</a>
                                                            </td>
                                                            <td style="border: 0px !important;"> 
                                                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#info-of-club-<?php echo $club['id'] ?>">Club Details</a>
                                                            </td>
                                                            <td style="border: 0px !important;"> 
                                                                <a  class="btn btn-success btn-sm" href="chat.php?userName=<?php echo $club['userId'] ?>" >To chat</a>
                                                            </td>


                                                            <td style="border: 0px !important;"> 
                                                                <?php
                                                                if ($club['active'] == 1) {
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" value="<?php echo $club['id'] ?>" name="id">
                                                                        <input type="submit" name="inactive" class="btn btn-primary btn-sm" value="Inactive">
                                                                    </form>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" value="<?php echo $club['id'] ?>" name="id">
                                                                        <input type="submit" name="active" class="btn btn-danger btn-sm" value="Active">
                                                                    </form>
                                                                    <?php
                                                                }
                                                                ?>


                                                            </td>
                                                            <td style="border: 0px !important;"> 
                                                                <form action="" method="post">
                                                                    <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                                                                    <input class="btn btn-primary btn-sm" onclick="return confirm('are you sure ?')"  type="submit" value="delete" name="clubDelete" >
                                                                </form>
                                                            </td>
                                                            <td style="border: 0px !important;"> 
                                                                <?php
                                                                if ($club['personalIdOfClub'] == '') {
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" value="<?php echo $club['id'] ?>" name="id">

                                                                        <input  class="form-control" type="text" name="personalId" placeholder="enter personal user id">
                                                         
                                                                        <input type="submit" name="setPersonalId" class="btn btn-success btn-sm" value="Set id">
                                                                    </form>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" value="<?php echo $club['id'] ?>" name="id">
                                                                        <input  class="form-control" type="text" name="personalId" placeholder="enter personal user id">
                                                                        <input onclick="return confirm('are you sure ?')"  type="submit" name="changePersonalId" class="btn btn-default btn-sm" value="change id">
                                                                    </form>
                                                                    <?php
                                                                }
                                                                ?>


                                                            </td>
                                                        </tr>
                                                    </table>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>
<script type="text/javascript">
    $('#sampleTable11').DataTable();
    $('#sampleTable2').dataTable();
</script>
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>
<!-- Google analytics script-->
