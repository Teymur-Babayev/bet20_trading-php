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
?>

<main class="app-content">

    <div class="app-title">
        <div>
            <h5><i class="fa fa-th-list"></i> History</h5>
   
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
            
                    <div class="table-responsive">

                                <table class="table table-hover table-bordered" id="sampleTable">
                       
                                <thead>
                                    <tr>
                                          <th>SN</th>
                                        <th>Match</th>
                                        <th>question</th>
                                        <th>Credit(In)</th>
                                        <th>Debit(out)</th>
                                        <th>Saving</th>
                                        <th>User Balance</th>
                                        <th>Time</th>

                              
                                 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from  bet_history order by id desc";
                                    $resultUser = $db->select($query);
                                    $i = 0;
                                    if ($resultUser) {
                                        while ($user = $resultUser->fetch_assoc()) {

                                            $i++;
                                            ?>

    <tr>
                                                <td><?php echo $i ?></td>
                                              

                                         
                                                <td><?php echo $user['match'] ?></td>
                                                 <td><?php echo $user['question'] ?></td>
                                                <td><?php echo $user['credit'] ?></td>
                                                <td>
                                      
                                                        <?php echo $user['debit'] ?>


                                                </td>
                                                <td>    <?php echo $user['balance'] ?> </td>
                                                <td>    <?php echo $user['userBalance'] ?> </td>
                                                <td>    <?php echo $user['time'] ?> </td>
                                              
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
<script >
    $('#sampleTable').dataTable({
      aaSorting: [[0, 'asc']]
    });
</script>
<!-- Google analytics script-->

</body>
</html>