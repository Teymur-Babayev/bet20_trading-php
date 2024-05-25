<?php include './header.php'; ?>
<?php include './side.php'; ?>
<main class="app-content">
    <div class="app-title">
        <div>
             <h5><i class="fa fa-th-list"></i> Mobile number withdraw history</h5>

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
                                    <th>m_number</th>
                                    <th>Amount</th>
                                    <th>start Date</th>
                                    <th>finish Date</th>
                              
                         
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `deposit_and_withdraw_his` WHERE d_or_w='2' order by id desc";
                                $result = $db->select($query);

                                if ($result) {
                                    $i=0;
                                    foreach ($result as $deposit) {
                                        $i++;
                                        ?>
                                        <tr>
                                               <td> <?php echo $i ?></td>
                                            <td> <?php echo $deposit['m_number']; ?></td>
                                            <td> <?php echo $deposit['amount']; ?></td>
                                            <td><?php echo $deposit['startDate']; ?></td>
                                            <td> <?php echo $deposit['finishDate']; ?></td>
                                 
                                            
            
                          

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