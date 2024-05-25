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
      $db->delete($query); */
}
?>

<main class="app-content">

    <div class="app-title">
        <div>
            <h5><i class="fa fa-th-list"></i>All user</h5>
            <?php
            $query = "select sum(balance) as total from user";
            $UserTotalBalance = $db->select($query);

            if ($UserTotalBalance) {
                $UserTotalBalance = $UserTotalBalance->fetch_assoc();
                ?>
                <span style="color: green">Total user balance=<?php
                    echo round($UserTotalBalance['total'], 2);
                }
                ?>
            </span>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2">
                            <a class="btn btn-primary btn-sm icon-btn" href="?sortByBalance"><i class="fa fa-refresh"></i>sort By Balance	</a>
                        </div>
                        <div class="col-lg-2">

                            <div class="dropdown">

                                <a href="userToUserBalance.php" class="btn btn-sm btn-primary " >
                                    User to user balance transfer
                                </a>

                            </div>
                        </div>


                    </div>
                    <div class="table-responsive">

                        <?php
                        if (isset($_GET['sortByBalance'])) {
                            ?>
                            <table class="table table-hover table-bordered" id="sampleTable2">
                                <?php
                            } else {
                                ?>
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <?php
                                }
                                ?>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Id</th>
                                        <th>Club Name</th>
                                        <th>balance</th>
                                        <th>Joining date</th>
                                        <th>Phone no.</th>

                                        <th>SN.</th>
                                        <th>Go to user panel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from user";
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
                                                <td>   
                                                    <?php
                                                    $query = "select id from user where sponsorUsername='$user[userId]'";
                                                    $resultS = $db->select($query);

                                                    if ($resultS) {
                                                        $nn = $resultS->num_rows;
                                                        echo $nn;
                                                    }
                                                    ?>
                                                </td>

                                                <td><a href="../index.php?adminVisit=<?php echo $user['userId']; ?>" target="_blank" class="btn btn-primary">visit</a> </td>
                                                <td>  





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