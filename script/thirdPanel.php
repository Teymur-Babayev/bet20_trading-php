<?php include './thirdHeader.php'; ?>
<?php include './thirdSite.php'; ?>

<main class="app-content">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user-circle "></i>
                <div class="info">
                    <h6>Total user balance</h6>
                    <p>
                        <?php
                        $query = "select sum(balance) as total from user";
                        $UserTotalBalance = $db->select($query);

                        if ($UserTotalBalance) {
                            $UserTotalBalance = $UserTotalBalance->fetch_assoc();

                            echo round($UserTotalBalance['total'], 2);
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user-secret "></i>
                <div class="info">
                    <h6>Total club balance</h6>
                    <p>
                        <?php
                        $query = "select sum(balance) as total from club";
                        $UserTotalBalance = $db->select($query);

                        if ($UserTotalBalance) {
                            $UserTotalBalance = $UserTotalBalance->fetch_assoc();

                            echo round($UserTotalBalance['total'], 2);
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-vcard "></i>
                <div class="info">
                    <h6>Total withdraw</h6>
                    <p>
                        <?php
                        $query = "select sum(balance) as total from club";
                        $UserTotalBalance = $db->select($query);

                        if ($UserTotalBalance) {
                            $UserTotalBalance = $UserTotalBalance->fetch_assoc();

                            //echo round($UserTotalBalance['total'],2);
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
                <div class="info">
                    <h6>Total deposit</h6>
                    <p>
                        <?php
                        $query = "select sum(balance) as total from club";
                        $UserTotalBalance = $db->select($query);

                        if ($UserTotalBalance) {
                            $UserTotalBalance = $UserTotalBalance->fetch_assoc();

                            //echo round($UserTotalBalance['total'],2);
                        }
                        ?>

                    </p>
                </div>
            </div>
        </div>
    </div>

</main>
<?php include './footer.php'; ?>
<script type="text/javascript">
    $('#clubMember').DataTable();

</script>