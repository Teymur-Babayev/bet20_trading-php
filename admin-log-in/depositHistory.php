<?php include './header.php'; ?>
<?php include './side.php'; ?>
<main class="app-content">
    <div class="app-title">
        <div>
             <h5><i class="fa fa-th-list"></i> User deposit inbox</h5>

        </div>

    </div>

        <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable2">
                            <thead>
                                <tr>
                                      <th>SN.</th>
                                    <th>User Id</th>
                                    <th>Amount</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Method</th>
                                    <th>Reference </th>
                                    <th>Date</th>
                                            <th>User balance </th>
                         
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `admin_notification` WHERE seen='1' and action<3 and notificationType=1 and userType=0 order by id desc";
                                $result = $db->select($query);

                                if ($result) {
                                    $i=0;
                                    foreach ($result as $deposit) {
                                        $i++;
                                        ?>
                                        <tr>
                                               <td> <?php echo $i ?></td>
                                            <td> <?php echo $deposit['userId']; ?></td>
                                            <td> <?php echo $deposit['deposit']; ?></td>
                                            <td><?php echo $deposit['from_number']; ?></td>
                                            <td> <?php echo $deposit['to_number']; ?></td>
                                            <td> <?php echo $deposit['pay_method']; ?></td>

                                            <td> <?php echo $deposit['ref_number']; ?></td>
                                            <td> <?php echo $deposit['time']; ?></td>
                                               <td> <?php echo $deposit['userBalance']; ?></td>
                                            
            
                          

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
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script type="text/javascript">$('#sampleTable2').DataTable();</script>

</body>
</html>