<?php include './header.php'; ?>
<?php include './side.php'; ?>


<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>  History </h1>

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
                                    <th scope="col">SN.</th>
                                    <th scope="col">From_userId</th>
                                    <th scope="col">to_userId</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">all userBalance</th>
                                    <th scope="col">Time</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $query = "select * from `balance_transfer` order by id desc";
                                $resultBet = $db->select($query);
                                if ($resultBet) {
                                    foreach ($resultBet as $bet) {
                                        $i++;
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $bet['userId']; ?></td>
                                            <td><?php echo $bet['to_userId']; ?></td>
                                            <td><?php echo $bet['amount']; ?></td>
                                            <td><?php echo $bet['userBalance']; ?></td>
                                            <td><?php echo $bet['time']; ?></td>


                                        </tr>
                                        <?php
                                    }
                                }
                                ?>


                            </tbody>

                        </table>
                    </div><!--end of .table-responsive-->

                </div>
            </div>
        </div>
    </div>
</main>
<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>

</body>
</html>