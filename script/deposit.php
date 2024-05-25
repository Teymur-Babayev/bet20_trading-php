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
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                     <th>SN.</th>
                                    <th>User Id</th>
                                      <th>User balance</th>
                                    <th>Amount</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Method</th>
                                    <th>Reference </th>
                                    <th>Date</th>                                     
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `admin_notification` WHERE seen='0' and action<3 and notificationType=1 and userType=0 order by id asc";
                                $result = $db->select($query);

                                if ($result) {
                                    $i=0;
                                    foreach ($result as $deposit) {
                                        $i++;
                                        ?>
                                        <tr>
                                                    <td> <?php echo $i ?></td>
                                            <td> <?php echo $deposit['userId']; ?></td>
                                                           <td>
                                                <?php
                                                $query = "SELECT balance FROM `user` WHERE userId='$deposit[userId]'";
                                                $resultB = $db->select($query);
                                               $B= $resultB->fetch_assoc();
                                                echo $B['balance'];
                                                ?>
                                            </td>
                                            <td> <?php echo $deposit['deposit']; ?></td>
                                            <td><?php echo $deposit['from_number']; ?></td>
                                            <td> <?php echo $deposit['to_number']; ?></td>
                                            <td> <?php echo $deposit['pay_method']; ?></td>

                                            <td> <?php echo $deposit['ref_number']; ?></td>
                                            <td> <?php echo $deposit['time']; ?></td>
                                               

                                    <div id="notice" class="modal" style="">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">

                                            
                                                    <form  action="searchAction.php" method="post">



                                                        <div class="form-group">
                                                            <input type="hidden" name="noticeId" value=" <?php echo $deposit['id']; ?>">
                                                            <label for="exampleFormControlTextarea1">Notice</label>
                                                            <textarea class="form-control" name="noticeMsg" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>

                                                        <div class="form-group">

                                                            <button type="submit" name="depositeNotice" class="btn btn-primary">Submit</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($deposit['action'] == 0) {
                                        ?>
                                        <td>

                                            <div class="btn-group" role="group">
                                                <button class="btn btn-info btn-sm dropdown-toggle" id="btnGroupDrop3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Requested</button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="depositWithdrawAction.php?userId=<?php echo $deposit['userId']; ?> && action=1&& ref_number=<?php echo $deposit['ref_number']; ?>" >Processing</a>
                                                    <a class="dropdown-item" href="depositWithdrawAction.php?userId=<?php echo $deposit['userId']; ?>&& amount=<?php echo $deposit['deposit']; ?> && action=2 && to=<?php echo $deposit['to_number']; ?> && ref_number=<?php echo $deposit['ref_number']; ?>&& rate=<?php echo $deposit['rate']; ?> && seen=1" >Processed</a>

                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#notice">Notice</a>
                                                 <a class="dropdown-item" href="depositWithdrawAction.php?Dcancel=<?php echo $deposit['id']; ?>" >Cancel</a>
                                                </div>
                                            </div>


                                        </td>
                                        <?php
                                    } elseif ($deposit['action'] == 1) {
                                        ?>
                                        <td>

                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-sm dropdown-toggle" id="btnGroupDrop3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Processing</button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="depositWithdrawAction.php?userId=<?php echo $deposit['userId']; ?> && action=1&& ref_number=<?php echo $deposit['ref_number']; ?>" >Processing</a>
                                                    <a class="dropdown-item" href="depositWithdrawAction.php?userId=<?php echo $deposit['userId']; ?>&& amount=<?php echo $deposit['deposit']; ?> && action=2 && to=<?php echo $deposit['to_number']; ?> && ref_number=<?php echo $deposit['ref_number']; ?>&& rate=<?php echo $deposit['rate']; ?> && seen=1" >Processed</a>

                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#notice">Notice</a>
                                                  <a class="dropdown-item" href="depositWithdrawAction.php?Dcancel=<?php echo $deposit['id']; ?>" >Cancel</a>
                                                </div>
                                            </div>


                                        </td>
                                        <?php
                                    }
                                    ?>

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
                                       <th>User balance</th>
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
                                $query = "SELECT * FROM `admin_notification` WHERE seen='1' and action<3 and notificationType=1 and userType=0 order by id desc limit 200";
                                $result = $db->select($query);

                                if ($result) {
                                    $i=0;
                                    foreach ($result as $deposit) {
                                        $i++;
                                        ?>
                                        <tr>
                                               <td> <?php echo $i ?></td>
                                            <td> <?php echo $deposit['userId']; ?></td>
                                                           <td>
                                                <?php
                                                $query = "SELECT balance FROM `user` WHERE userId='$deposit[userId]'";
                                                $resultB = $db->select($query);
                                               $B= $resultB->fetch_assoc();
                                                echo $B['balance'];
                                                ?>
                                            </td>
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