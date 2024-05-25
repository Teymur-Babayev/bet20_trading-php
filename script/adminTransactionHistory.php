<?php include './header.php'; ?>
<?php include './side.php'; ?>


<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Transaction History </h1>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">


            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered " id="sampleTable">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>debit (Out)</th>
                                    <th>Credit (In)</th>
                                    <th>Description</th>
                                    <th>Time</th>
                                    <th>Balance</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalClubWithdraw = 0;
                                $totalUserWithdraw = 0;
                                $totalUserDeposit = 0;
                                $totalClubWithdrawOfPersonal=0;
                                $query = "SELECT * FROM `admintransaction` order by id desc";
                                $resultUser = $db->select($query);
                                $i = 0;
                                if ($resultUser) {
                                    while ($user = $resultUser->fetch_assoc()) {

                                        $i++;
                                        ?>


                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <?php
                                                echo $user['debit'];
                                                $totalUserDeposit+=$user['debit'];
                                                ?>

                                            </td>
                                            <td><?php echo $user['credit'] ?></td>
                                            <td>
                                                <?php echo $user['description'] ?>
                                                <?php
                                                if ($user['credit'] != 0) {
                                                    $clubName = substr($user['description'], 13);

                                                    $query = "select * from club where userId='$clubName'";
                                                    if ($db->select($query)) {
                                                        $totalClubWithdraw+=$user['credit'];
                                                        ?>
                                                        <span style="color: red;">(club)</span>
                                                        <?php
                                                    } else {
                                                   
                                                        $query = "select * from club where personalIdOfClub='$clubName'";
                                                        if ($db->select($query)) {
                                                            $totalClubWithdrawOfPersonal+=$user['credit'];
                                                            ?>
                                                            <span style="color: green;">(club personal AC)</span>
                                                            <?php
                                                        } else {
                                                            $totalUserWithdraw+=$user['credit'];
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $user['time'] ?></td>
                                            <td><?php echo $user['total'] ?></td>


                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <span style="color: red;"> total club withdraw (<?php echo $totalClubWithdraw ?>)||
                        total user withdraw (<?php echo $totalUserWithdraw ?>)||
                        total user deposit (<?php echo $totalUserDeposit ?>)||
                        total club personal AC WD (<?php echo   $totalClubWithdrawOfPersonal ?>)||
                      
                    </span>
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
<!-- Google analytics script-->
<script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>
</body>
</html>