<?php include './thirdHeader.php'; ?>
<?php include './thirdSite.php'; ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h5><i class="fa fa-th-list"></i> User withdraw inbox</h5>

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
                                    <th>Amount</th>
                                    <th>To</th>
                                    <th>Method</th>
                                    <th>Account </th>
                                    <th>Date</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `admin_notification` WHERE seen='0' and wAction<3 and notificationType=2 and userType=0 order by id asc";
                                $result = $db->select($query);
                                if ($result) {
                                    $i = 0;
                                    foreach ($result as $deposit) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td> <?php echo $i ?></td>
                                            <td> <?php echo $deposit['userId']; ?></td>
                                            <td> <?php echo $deposit['withdraw']; ?></td>

                                            <td> <?php echo $deposit['to_number']; ?></td>
                                            <td> <?php echo $deposit['pay_method']; ?></td>
                                            <td> <?php echo $deposit['acc_type']; ?></td>
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

                                                            <button type="submit" name="withdrawNotice" class="btn btn-primary">Submit</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <td>
                                        <form action="depositWithdrawAction.php" method="post">
                                            <?php
                                            if ($deposit['wAction'] == 0) {
                                                ?>


                                                <div  class="btn-group" role="group">
                                                    <button class="btn btn-info btn-sm dropdown-toggle" id="btnGroupDrop3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Requested</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="depositWithdrawAction.php?userId=<?php echo $deposit['userId']; ?> && wAction=1&& ref_number=<?php echo $deposit['id']; ?>" >Processing</a>

                                                        <input type="hidden" name="userId" value="<?php echo $deposit['userId']; ?>">
                                                        <input type="hidden" name="wAction" value="2">
                                                        <input type="hidden" name="ref_number" value="<?php echo $deposit['id']; ?>">
                                                        <input type="hidden" name="withdraw" value="<?php echo $deposit['withdraw']; ?>">
                                                        <input type="hidden" name="userType" value="<?php echo $deposit['userType']; ?>">
                                                        <input type="hidden" name="seen" value="1">
                                                        <input class="dropdown-item" type="submit" value="Processed">




                                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#notice">Notice</a>
                                                        <a class="dropdown-item" href="depositWithdrawAction.php?Wcancel=<?php echo $deposit['id']; ?>" >Cancel</a>
                                                    </div>
                                                </div>



                                                <?php
                                            } elseif ($deposit['wAction'] == 1) {
                                                ?>


                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" id="btnGroupDrop3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Processing</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="depositWithdrawAction.php?userId=<?php echo $deposit['userId']; ?> && wAction=1&& ref_number=<?php echo $deposit['id']; ?>" >Processing</a>
                                                        <input type="hidden" name="userId" value="<?php echo $deposit['userId']; ?>">
                                                        <input type="hidden" name="wAction" value="2">
                                                        <input type="hidden" name="ref_number" value="<?php echo $deposit['id']; ?>">
                                                        <input type="hidden" name="seen" value="1">
                                                        <input class="dropdown-item" type="submit" value="Processed">


                                                        <input type="hidden" name="withdraw" value="<?php echo $deposit['withdraw']; ?>">
                                                        <input type="hidden" name="userType" value="<?php echo $deposit['userType']; ?>">

                                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#notice">Notice</a>
                                                        <a class="dropdown-item" href="depositWithdrawAction.php?Wcancel=<?php echo $deposit['id']; ?>" >Cancel</a>
                                                    </div>
                                                </div>



                                                <?php
                                            }
                                            ?>


                                            <select name="confirm_number" class="form-control" id="sel1">

                                                <option >Select number</option>
                                                <?php
                                                $query = "SELECT * FROM `sending_money_number`";
                                                $result = $db->select($query);

                                                if ($result) {
                                                    foreach ($result as $Send) {
                                                        ?>
                                                        <option><?php echo $Send['phone']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </form>
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
                                    <th>To</th>
                                    <th>Method</th>
                                    <th>Account </th>
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `admin_notification` WHERE seen='1' and wAction<3 and notificationType=2 and userType=0 order by id desc";
                                $result = $db->select($query);

                                if ($result) {
                                    $i=0;
                                    foreach ($result as $deposit) {
                                        $i++;
                                        ?>
                                        <tr>
                                               <td> <?php echo $i ?></td>
                                            <td> <?php echo $deposit['userId']; ?></td>
                                            <td> <?php echo $deposit['withdraw']; ?></td>

                                            <td> <?php echo $deposit['to_number']; ?></td>
                                            <td> <?php echo $deposit['pay_method']; ?></td>
                                            <td> <?php echo $deposit['acc_type']; ?></td>
                                            <td> <?php echo $deposit['time']; ?></td>


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