<?php include './header.php'; ?>
<?php include './side.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/bt.js"></script>
<link href="css/bt.css" rel="stylesheet" />
<script src="js/slelect.js"></script>
<link href="css/select.css" rel="stylesheet" />

<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Data Table</h1>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            $resultUser = '';
            $from = '';
            $to = '';
            $totalSponsor='';
            $totalClubCredit='';
            if (isset($_POST['serchByDate'])) {
                $from = $_POST['from'];
                $to = $_POST['to'];

                $query = "select * from transaction where sposor!=0 or clubCredit!=0 and '$from'<=time and '$to'>=time";
                $resultUser = $db->select($query);
                
                  $query = "select sum(sposor) as totalSponsor from transaction where sposor!=0 and '$from'<=time and '$to'>=time";
                $resultSponsor = $db->select($query);
                $totalSponsor=$resultSponsor->fetch_assoc();
                $totalSponsor=$totalSponsor['totalSponsor'];
                
                //
                  $query = "select sum(clubCredit) as totalClubCredit from transaction where clubCredit!=0 and '$from'<=time and '$to'>=time";
                $resultTotalClubCredit = $db->select($query);
                $totalClubCredit=$resultTotalClubCredit->fetch_assoc();
                $totalClubCredit=$totalClubCredit['totalClubCredit'];
            } else {

                $query = "select * from transaction where sposor!=0 or clubCredit!=0";
                $resultUser = $db->select($query);
            }
            ?>
            <?php
         
            if ($from !='' && $to !='') {
                ?>
            <h5>Record <span style="color: red">from</span> <?php echo $from;?> <span style="color: red">to</span> <?php echo $to;?></h5>
             <h5> <span style="font-weight: bold;color: green">Total Sponsor=</span> <?php echo round($totalSponsor,2);?> || <span style="font-weight: bold;color: green">Total Club Commission=</span> <?php echo round($totalClubCredit,2);?></h5>
                <?php
            }
            ?>
            <form class="row" action="" method="post">

                <div class="form-group col-md-3">

                    <label class="control-label">From</label>
                    <select name="from" class="form-control selectpicker" id="select-country" data-live-search="true">

                        <?php
                        $query = "select DISTINCT  time from transaction";
                        $resultTime = $db->select($query);

                        if ($resultTime) {
                            foreach ($resultTime as $id) {
                                ?>
                                <option data-tokens="<?php echo $id['time']; ?>"><?php echo $id['time']; ?></option>
                                <?php
                            }
                        } else {
                            echo 'not found';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">To</label>
                    <select name="to" class="form-control selectpicker" id="select-country" data-live-search="true">
                        <?php
                        $query = "select DISTINCT  time from transaction order by id desc";
                        $resultTime = $db->select($query);

                        if ($resultTime) {
                            foreach ($resultTime as $id) {
                                ?>
                                <option data-tokens="<?php echo $id['time']; ?>"><?php echo $id['time']; ?></option>
                                <?php
                            }
                        } else {
                            echo 'not found';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4 align-self-end">
                    <button name="serchByDate" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                </div>
            </form>
            <div class="tile">
                <div class="tile-body">


                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">

                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>All sponsor</th>
                                    <th>All club commission</th>
                                    <th>time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                   $AllclubCredit = 0;
                                $Allsponsor=0;
                             
                                if ($resultUser) {
                                    while ($user = $resultUser->fetch_assoc()) {
                                        $Allsponsor=$Allsponsor+$user['sposor'];
                                        $AllclubCredit+=$user['clubCredit'];
                                        $i++;
                                        ?>


                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $user['sposor'] ?></td>
                                            <td><?php echo $user['clubCredit'] ?></td>

                                            <td><?php echo $user['time'] ?></td>




                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                        <table class="table">
                            <tr>
                                <td></td>
                                <td style="font-weight: bold;color: green">total sponsor = <?php echo round($Allsponsor,2);?></td>
                                <td  style="font-weight: bold;color: green">total club commission= <?php echo round($AllclubCredit,2) ?></td>

                                <td></td>




                            </tr>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
<?php include './footer.php'; ?>
<script type="text/javascript">$('#sampleTable').DataTable();</script>

<!-- Google analytics script-->
<script type="text/javascript">

    //check
    $('#checkall').change(function () {
        $('.cb-element').prop('checked', this.checked);
    });

    $('.cb-element').change(function () {
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        }
        else {
            $('#checkall').prop('checked', false);
        }
    });
</script>
</body>
</html>