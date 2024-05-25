<?php include './secondHeader.php'; ?>
<?php include './secondSite.php'; ?>
<link rel="stylesheet" type="text/css" href="css/betPanel.css">
<main class="app-content">

    <div class="app-title">
        <div>
            <h5><i class="fa fa-th-list"></i>
                <?php
                $query = "SELECT * FROM `betclosehistory`";
                $amount = $db->select($query);

                if ($amount) {
                  
                    $totalGain = 0;
                    $totalSending = 0;
                    $i=0;
                    foreach ($amount as $total) {
                        $i++;
                        $totalGain+=$total['gainAmunt'];
                        $totalSending+=$total['SendingAmount'];
                    
                    }
                    ?>
                    Total Gaining Amount= <?php echo $totalGain; ?>
                    || Total Sending Amount= <?php echo $totalSending; ?>
                    <?php
                }
                ?>

            </h5>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">


            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table" id="sampleTable">
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>



                            <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        $query = "SELECT * FROM `betting_title` where status=1 ORDER BY id desc";
                                        $resultBettingTitle = $db->select($query);
                                        $i = 0;
                                        if ($resultBettingTitle) {
                                            while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {

                                                $i++;
                                                ?>


                                                <!-- first label -->

                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">

                                                        <div class="panel-heading" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>one">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $bettingTitle['id'] ?>one" aria-expanded="true" aria-controls="collapseOne<?php echo $bettingTitle['id'] ?>one">

                                                                    <?php
                                                                    if ($bettingTitle['gameType'] == 1) {
                                                                        ?>
                                                                        <img src="../img/1393757333.png" width="25px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo $bettingTitle['date'] ?> 

                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <img src="../img/ka-pl.png" width="25px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo $bettingTitle['date'] ?> 

                                                                        <?php
                                                                    }
                                                                    ?>


                                                                    <?php
                                                                    $query = "SELECT * FROM `betclosehistory` WHERE matchId='$bettingTitle[id]'";
                                                                    $amount = $db->select($query);

                                                                    if ($amount) {
                                                                   
                                                                        $totalGain = 0;
                                                                        $totalSending = 0;
                                                                        foreach ($amount as $total) {
                                                                            $totalGain+=$total['gainAmunt'];
                                                                            $totalSending+=$total['SendingAmount'];
                                                                        }
                                                                        ?>
                                                                        &nbsp;&nbsp;|| Sending Amount  <span class="badge badge-info  text-right" > <?php echo $totalSending; ?></span>
                                                                        &nbsp;&nbsp;  || Gain Amount  <span  class="badge badge-info  text-right" > <?php echo $totalGain; ?></span>
                                                                        <?php
                                                                    }
                                                                    ?>    

                                                                </a>

                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne<?php echo $bettingTitle['id'] ?>one" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne<?php echo $bettingTitle['id'] ?>one">
                                                            <div class="panel-body" style="">

                                                                <!-- second label -->
                                                                <div class="panel-group" id="accordion<?php echo $bettingTitle['id'] ?>one" role="tablist" aria-multiselectable="true">
                                                                    <?php
                                                                    $query = "SELECT * FROM `betting_subtitle` WHERE bettingId='$bettingTitle[id]' and close=1";
                                                                    $resultBettingSubTitle = $db->select($query);
                                                                    $i = 0;
                                                                    if ($resultBettingSubTitle) {
                                                                        while ($bettingSubTitle = $resultBettingSubTitle->fetch_assoc()) {

                                                                            $i++;
                                                                            ?>


                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a  style="background:#E7E7E7 !important;color: #212529;padding: 1%;border-bottom: 1px solid #979797;" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $bettingTitle['id'] ?>one" href="#collapseOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>">
                                                                                            <?php echo $bettingSubTitle['title'] ?> 


                                                                                            <?php
                                                                                            $query = "SELECT * FROM `betclosehistory` WHERE queId='$bettingSubTitle[id]'";
                                                                                            $Count = $db->select($query);

                                                                                            if ($Count) {
                                                                                                $amount = $Count->fetch_assoc();
                                                                                                ?>
                                                                                                &nbsp;&nbsp;|| Sending Amount  <span class="badge badge-info  text-right" > <?php echo $amount['SendingAmount']; ?></span>
                                                                                                &nbsp;&nbsp;  || Gain Amount  <span  class="badge badge-info  text-right" > <?php echo $amount['gainAmunt']; ?></span>
                                                                                                <?php
                                                                                            }
                                                                                            ?> 

                                                                                        </a>

                                                                                    </h4>

                                                                                </div>

                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>



                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>

<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->


<!-- won-->  
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/select2.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var add_input_button = $('.add_input_button');
        var field_wrapper = $('.field_wrapper');
        var new_field_html = '<div class="form-group row"> <label class="control-label col-md-2">Bet </label><div class="col-md-6"><input class="form-control" name="input_field[]"  placeholder="Enter Bet Statement"> <a href="javascript:void(0);" class="remove_input_button" title="Remove field"> <i style="background: red;color: white;padding: 9px;border-radius: 43%;margin-top: 6px;" class="fa fa-minus" ></i></a></div><div class="col-md-4"><input class="form-control" name="betRate[]"  placeholder="Bet Rate"></div></div>';
        var input_count = 1;
// Add button dynamically
        $(add_input_button).click(function () {
            if (input_count < max_fields) {
                input_count++;
                $(field_wrapper).append(new_field_html);
            }
        });
// Remove dynamically added button
        $(field_wrapper).on('click', '.remove_input_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            input_count--;
        });
    });


    $('.editRate').on('shown.bs.modal', function () {
        $(this).find('.rate').focus();
    });


</script>


</body>

</html>