<?php include './header.php'; ?>
<?php include './side.php'; ?>
<?php
if (isset($_GET['matchTrans'])) {
    // echo '<script>alert()</script>';
    $id = $_GET['matchTrans'];
    $query = "UPDATE `betting_title` SET"
            . " `close`='0'"
            . " WHERE id='$id'";
    $db->update($query);
    $query = "UPDATE `betting_subtitle` SET"
            . " `close`='0'"
            . " WHERE bettingId='$id'";
    $db->update($query);
    header("location:bettingPanel.php");
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
                                    <th>SN.</th>
                                    <th>Live Match</th>
                                    <th>Closed time</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `betting_title` where  close=1  ORDER BY close_time desc";
                                $resultBettingTitle = $db->select($query);
                                $i = 0;
                                if ($resultBettingTitle) {
                                    while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {

                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>
                                                <?php
                                                if ($bettingTitle['gameType'] == 1) {
                                                    ?>
                                                    <img src="../img/1393757333.png" width="27px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo $bettingTitle['date']; ?>  
                                                    <?php
                                                } else if ($bettingTitle['gameType'] == 2) {
                                                    ?>
                                                    <img src="../img/ka-pl.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo $bettingTitle['date']; ?> 

                                                    <?php
                                                } else {
                                                    ?>

                                                    <img src="../img/basket.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php $bettingTitle['date']; ?> 

                                                    <?php
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $bettingTitle['close_time']; ?> </td>

                                            <td><a href="?matchTrans=<?php echo $bettingTitle['id']; ?>" class="btn btn-primary">To</a> </td>




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
        //  aaSorting: [[3, 'desc']]
    });
</script>
<!-- Google analytics script-->

</body>
</html>