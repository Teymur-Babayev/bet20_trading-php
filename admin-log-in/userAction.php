<?php include './header.php'; ?>
<?php include './side.php'; ?>
<?php
if (isset($_POST['updateUser'])) {
    // echo '<script>alert()</script>';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $mobileNumber = $_POST['mobileNumber'];
    $userId = $_POST['userId'];
    $sponsorCommission = $_POST['sponsorCommission'];
    $password = $_POST['password'];
    $sponsorUsername = $_POST['sponsorUsername'];
    $clubId = $_POST['clubId'];
    $query = "UPDATE `user` SET"
            . " `name`='$name',"
            . "`userId`='$userId',"
            . "`password`='$password',"
            . "`mobileNumber`='$mobileNumber',"
            . "`email`='$email',"
            . "`sponsorCommission`='$sponsorCommission',"
            . "`clubId`='$clubId',"
            . "`sponsorUsername`='$sponsorUsername'"
            . " WHERE id='$id'";
    $db->update($query);
}
if (isset($_POST['active'])) {
    $id = $_POST['id'];
    $query = "UPDATE `user` SET"
            . " `active`='1'"
            . " WHERE id='$id'";
    $db->update($query);
} else if (isset($_POST['inactive'])) {
    $id = $_POST['id'];
    $query = "UPDATE `user` SET"
            . " `active`='0'"
            . " WHERE id='$id'";
    $db->update($query);
} else if (isset($_POST['userDelete'])) {
   /* $id = $_POST['id'];
    $query = "DELETE FROM `user` WHERE id='$id'";
    $db->delete($query);*/
}
$userN='';
if (isset($_POST['userAction'])) {
    $userN = $_POST['userN'];
}
?>

<main class="app-content">

    <div class="app-title">
        <div>
            <h5><i class="fa fa-th-list"></i>All user</h5>
     
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-lg-2"></div>
               
                        <div class="col-lg-2">

                            <div class="dropdown">

                                <a href="userToUserBalance.php" class="btn btn-sm btn-primary " >
                                    User to user balance transfer
                                </a>

                            </div>
                        </div>


                    </div>
                    <div class="table-responsive">

                                <table class="table table-hover table-bordered" id="sampleTable">
                          
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Id</th>
                                        <th>Club Name</th>
                                        <th>balance</th>
                                        <th>Joining date</th>
                                        <th>Phone no.</th>

                                          <th>Go to user panel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from user where userId='$userN'";
                                    $resultUser = $db->select($query);
                                    $i = 0;
                                    if ($resultUser) {
                                        while ($user = $resultUser->fetch_assoc()) {

                                            $i++;
                                            ?>


                                            <tr>
                                                <td><?php echo $user['name'] ?></td>
                                                <td><?php echo $user['userId'] ?></td>
                                                <td>
                                                    <?php
                                                    $clubByUser = '';
                                                    $query = "select * from club where userId='$user[clubId]'";
                                                    $clubName = $db->select($query);
                                                    $i = 0;
                                                    if ($clubName) {
                                                        $clubNameByUser = $clubName->fetch_assoc();
                                                        $clubByUser = $clubNameByUser['userId'];
                                                        ?>


                                                        <?php echo $clubNameByUser['userId'] ?>


                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>    <?php echo $user['balance'] ?> </td>
                                                <td>    <?php echo $user['time'] ?> </td>
                                                <td>    <?php echo $user['mobileNumber'] ?> </td>
                                                 <td><a href="../index.php?adminVisit=<?php echo $user['userId']; ?>" target="_blank" class="btn btn-primary">visit</a> </td>
                                                <td>  



                                                <div id="info-of-club-<?php echo $user['id'] ?>" class="modal" style="">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">User Information</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="" class="form-group">
                                                                    <table class="table table-bordered">

                                                                        <tr>
                                                                            <th> Full Name</th>
                                                                            <td>

                                                                                <input  name="id" type="hidden" value="<?php echo $user['id'] ?>">
                                                                                <input class="form-control" name="name" type="text" value="<?php echo $user['name'] ?>">

                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th>Username</th>
                                                                            <td>
                                                                                <input class="form-control" name="userId" type="text" value="<?php echo $user['userId'] ?>" readonly="1">
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th> Mobile No.</th>
                                                                            <td>
                                                                                <input class="form-control" name="mobileNumber" type="number" value="<?php echo $user['mobileNumber'] ?>">
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email</th>
                                                                            <td>
                                                                                <input class="form-control" name="email" type="email" value="<?php echo $user['email'] ?>">
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th>Referred By</th>
                                                                            <td>


                                                                                <input class="form-control" name="sponsorUsername" type="text" value="<?php echo $user['sponsorUsername'] ?>">

                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th>Club</th>
                                                                            <td>       
                                                                                <div class="form-group">

                                                                                    <select name="clubId" class="form-control" id="sel1">
                                                                                        <?php
                                                                                        $query = "select * from club";
                                                                                        $club = $db->select($query);

                                                                                        if ($club) {
                                                                                            foreach ($club as $clubUser) {
                                                                                                if ($clubByUser == $clubUser['userId']) {
                                                                                                    ?>
                                                                                                    <option class="active">  <?php echo $clubUser['userId']; ?></option>


                                                                                                    <?php
                                                                                                } else {
                                                                                                    ?>
                                                                                                    <option>  <?php echo $clubUser['userId']; ?></option>


                                                                                                    <?php
                                                                                                }
                                                                                                ?>



                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>

                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th>Sponsor Commission</th>
                                                                            <td>
                                                                                <input class="form-control" name="sponsorCommission" type="number" value="<?php echo $user['sponsorCommission'] ?>">
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th>password</th>
                                                                            <td>
                                                                                <input class="form-control" name="password" type="text" value="<?php echo $user['password'] ?>" >
                                                                            </td>

                                                                        </tr>

                                                                    </table>
                                                                    <div class="row">
                                                                        <div class="col-4"></div>
                                                                        <div class="col-4"> <button type="submit" name="updateUser"  onclick="return confirm('are you sure ?')" class="btn btn-success">Save Change</button></div>
                                                                        <div class="col-4"></div>

                                                                    </div>

                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                                    <table style="border: 0px !important;">
                                                        <tr style="border: 0px !important;">
                                                            <td style="border: 0px !important;"> 
                                                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#info-of-club-<?php echo $user['id'] ?>">View</a>
                                                            </td>
                                                            <td style="border: 0px !important;"> 
                                                                <a class="btn btn-success btn-sm" href="chat.php?userName=<?php echo $user['userId'] ?>" >To chat</a>
                                                            </td>
                                                            <td style="border: 0px !important;"> 
                                                                <form action="" method="post">
                                                                    <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                                                                    <input class="btn btn-primary btn-sm" onclick="return confirm('are you sure ?')"  type="submit" value="delete" name="userDelete" >
                                                                </form>

                                                            </td>
                                                            <td style="border: 0px !important;"> 
                                                                <?php
                                                                if ($user['active'] == 1) {
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                                                                        <input type="submit" onclick="return confirm('are you sure ?')" name="inactive" class="btn btn-primary btn-sm" value="Inactive">
                                                                    </form>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                                                                        <input type="submit" onclick="return confirm('are you sure ?')" name="active" class="btn btn-danger btn-sm" value="Active">
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
<script type="text/javascript">$('#sampleTable').DataTable();
    $('#sampleTable2').dataTable({
        aaSorting: [[3, 'desc']]
    });
</script>
<!-- Google analytics script-->

</body>
</html>