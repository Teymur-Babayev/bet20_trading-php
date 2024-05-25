<?php include './header.php'; ?>
<?php include './side.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/bt.js"></script>
<link href="css/bt.css" rel="stylesheet" />
<script src="js/slelect.js"></script>
<link href="css/select.css" rel="stylesheet" />



<main class="app-content">
    <?php
    if (isset($_POST['aSubmit'])) {

        $clearAdmin = $_POST['clearAdmin'];
        if ($clearAdmin == 2) {
            $aTrans = $_POST['aTrans'];
            $query = "delete from `admintransaction` WHERE time <='$aTrans'";
            $db->delete($query);
        } else if ($clearAdmin == 1) {
            $bet = $_POST['bet'];
            $deleteQues = 0;
            $deleteAns = 0;
            $query = "SELECT * FROM `betting_title` where time <='$bet' order by id desc limit 1";
            $resultBettingTitle = $db->select($query);

            if ($resultBettingTitle) {
                $bettingTitle = $resultBettingTitle->fetch_assoc();
                $deleteMatch = $bettingTitle['id'];
                //select ques id
                $query = "SELECT * FROM `betting_subtitle` where bettingId<='$deleteMatch' order by id desc limit 1";
                $resultQues = $db->select($query);

                if ($resultQues) {

                    $resultQues = $resultQues->fetch_assoc();
                    $deleteQues = $resultQues['id'];
                    //select ans id
                    $query = "SELECT * FROM `betting_sub_title_option` where bettingSubTitleId<='$deleteQues' order by id desc limit 1";
                    $resultAns = $db->select($query);

                    if ($resultAns) {
                        $resultAns = $resultAns->fetch_assoc();
                        $deleteAns = $resultAns['id'];
                    }
                }

                //delete match

                $query = "delete from `betting_title` WHERE time <='$bet'";
                $db->delete($query);
                //delete ques
                $query = "delete from `betting_subtitle` WHERE id <='$deleteQues'";
                $db->delete($query);
                //delete ans
                $query = "delete from `betting_sub_title_option` WHERE id <='$deleteAns'";
                $db->delete($query);
            }
        } else if ($clearAdmin == 3) {
            $chat = $_POST['chat'];
            $query = "delete from `chat` WHERE time <='$chat'";
            $db->delete($query);
        }
    } else if (isset($_POST['uSubmit'])) {

        $clearUser = $_POST['clearUser'];
        if ($clearUser == 1) {
            $uTran = $_POST['uTran'];
            $query = "delete from `transaction` WHERE time <='$uTran'";
            $db->delete($query);
        } else if ($clearUser == 2) {
            $dw = $_POST['dw'];
            $query = "delete from `admin_notification` WHERE time <='$dw'";
            $db->delete($query);
        } else if ($clearUser == 3) {
            $blncTran = $_POST['blncTran'];
            $query = "delete from `balance_transfer` WHERE time <='$blncTran'";
            $db->delete($query);
        } else if ($clearUser == 4) {
            $uBet = $_POST['uBet'];
            $query = "delete from `bet` WHERE time <='$uBet'";
            $db->delete($query);
        }
    }
    ?>

    <div class="bs-component">
        <h3 class="card-header">Clear history panel</h3>
        <div class="card">

            <div class="card-body">

                <div class="">


                    <div class="col-lg-5" style="margin-bottom: 15px;padding: 30px;background: #E9EBEE">
                        <div class="badge badge-primary text-center" style="background: #0A7654;">Admin history clear</div>
                        <form method="post" action="">


                            <div class="control-group">
                                <label class="control-label">Bet history date</label>
                                <select name="bet" class="form-control selectpicker" id="select-country" data-live-search="true">
                                    <?php
                                    $query = "SELECT `time` FROM `betting_title` order by id desc";
                                    $resultTimeA = $db->select($query);

                                    if ($resultTimeA) {
                                        foreach ($resultTimeA as $id) {
                                            ?>
                                            <option data-tokens="<?php echo $id['time']; ?>"><?php echo $id['time']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Transaction history date</label>
                                <select name="aTrans" class="form-control selectpicker" id="select-country" data-live-search="true">

                                    <?php
                                    $query = "SELECT `time` FROM `admintransaction` order by id desc";
                                    $resultTimeA = $db->select($query);

                                    if ($resultTimeA) {
                                        foreach ($resultTimeA as $id) {
                                            ?>
                                            <option data-tokens="<?php echo $id['time']; ?>"><?php echo $id['time']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Chat to user history date</label>
                                <select name="chat" class="form-control selectpicker" id="select-country" data-live-search="true">
                                    <?php
                                    $query = "SELECT `time` FROM `chat` order by id desc";
                                    $resultTimeA = $db->select($query);

                                    if ($resultTimeA) {
                                        foreach ($resultTimeA as $id) {
                                            ?>
                                            <option data-tokens="<?php echo $id['time']; ?>"><?php echo $id['time']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                  
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="clearAdmin"  value="1"><span class="label-text">Clear bet</span>

                                    </label>
                                </div>
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="clearAdmin" value="2"><span class="label-text">clear transaction</span>

                                    </label>
                                </div>
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="clearAdmin" value="3" ><span class="label-text">Clear chat</span>

                                    </label>
                                </div>
                            </div>



                            <div class="form-check">
                                <button name="aSubmit" class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-2" >

                    </div>
                    <div class="col-lg-5" style="margin-bottom: 15px;padding: 30px;background: #E9EBEE">
                        <div class="badge badge-primary text-center" style="background: #0A7654;">User history clear</div>
                        <form method="post" action="">


                            <div class="control-group">
                                <label class="control-label">Transaction history</label>
                                <select name="uTran" class="form-control selectpicker" id="select-country" data-live-search="true">
                                    <?php
                                    $query = "SELECT `time` FROM `transaction` order by id desc";
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

                            <div class="control-group">
                                <label class="control-label">Deposit & withdraw history </label>
                                <select name="dw" class="form-control selectpicker" id="select-country" data-live-search="true">

                                    <?php
                                    $query = "SELECT `time` FROM `admin_notification` order by id desc";
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

                            <div class="control-group">
                                <label class="control-label">Balance transfer history</label>
                                <select name="blncTran" class="form-control selectpicker" id="select-country" data-live-search="true">
                                    <?php
                                    $query = "SELECT `time` FROM `balance_transfer` order by id desc";
                                    $resultTime = $db->select($query);

                                    if ($resultTime) {
                                        foreach ($resultTime as $id) {
                                            ?>
                                            <option data-tokens="<?php echo $id['time']; ?>"><?php echo $id['time']; ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option data-tokens="not found">not found</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="control-group">
                                <label class="control-label">place bet history</label>
                                <select name="uBet" class="form-control selectpicker" id="select-country" data-live-search="true">
                                    <?php
                                    $query = "SELECT `time` FROM `bet` order by id desc";
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
                            <div class="form-group">
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="clearUser"  value="1"><span class="label-text">Clear transaction</span>

                                    </label>
                                </div>
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="clearUser" value="2"><span class="label-text">clear d & w </span>

                                    </label>
                                </div>
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="clearUser" value="3" ><span class="label-text">Clear balance transfer</span>

                                    </label>
                                </div>
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="clearUser" value="4" ><span class="label-text">Clear place bet</span>

                                    </label>
                                </div>
                            </div>



                            <div class="form-check">
                                <button name="uSubmit" class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>



                </div>


            </div>

            <div class="card-footer text-muted">



            </div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    });

</script>