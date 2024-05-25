<?php include './header.php'; ?>
<?php include './side.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/bt.js"></script>
<link href="css/bt.css" rel="stylesheet" />
<script src="js/slelect.js"></script>
<link href="css/select.css" rel="stylesheet" />


<?php
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt = $dt->format('d M Y g:i A');
if (isset($_POST['uerToUser'])) {

    $toUser = $_POST['toUser'];
    $fromUser = $_POST['fromUser'];
    $notes = $_POST['notes'];
    $amount = $_POST['amount'];
    if ($toUser!='' && $fromUser!='' && $notes!='' && $amount!=''){
 

    //update balance
    $userBlc = 0;
    $query = "SELECT * FROM `user` where userId='$fromUser'";
    $resultUser = $db->select($query);
    $userBalance = $resultUser->fetch_assoc();
    $userBlc = $userBalance['balance'] - $amount;
    if ($userBlc < 0) {
        $b = abs($userBlc);
        $cut = $sendBalance - $b;
        $userBlc = $userBalance['balance'] - $cut;
        $query = "update `user` set balance='$userBlc',loan='$b'  WHERE userId='$fromUser'";
        $db->update($query);
    } else {
        $query = "update `user` set balance='$userBlc' WHERE userId='$fromUser'";
        $db->update($query);
    }
    //transaction from   
    $query = "INSERT INTO `transaction`(`debit`,`userId`, `description`,total,time)"
            . " VALUES ('$amount','$fromUser','$notes (to $toUser)','$userBlc','$dt')";
    $db->insert($query);

    //update balance
    $userBlc = 0;
    $query = "SELECT * FROM `user` where userId='$toUser'";
    $resultUser = $db->select($query);
    $userBalance = $resultUser->fetch_assoc();
    $userBlc = $userBalance['balance'] + $amount;

    $query = "update `user` set balance='$userBlc' WHERE userId='$toUser'";
    $db->update($query);
    //transaction to
    $query = "INSERT INTO `transaction`(`credit`,`userId`, `description`,total,time)"
            . " VALUES ('$amount','$toUser','$notes  (from $fromUser)','$userBlc','$dt')";
    $db->insert($query);
    echo '<script>alert(" success ")</script>';
     }  else {
          echo '<script>alert(" All field required ")</script>';
    }
}
?>

<main class="app-content">

    <div class="bs-component">
        <h3 class="card-header">User to user action</h3>
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">

                    </div>

                    <div class="col-lg-8" style="margin-bottom: 15px;">
                        <form method="post" action="">


                            <div class="control-group">
                                <label class="control-label">To User Id</label>
                                 <input type="text"name="toUser" class="form-control" rows="3" required="1">
                                <!--<select name="toUser" class="form-control selectpicker" id="select-country" data-live-search="true">

                                    <?php
                                   /* $query = "SELECT `userId` FROM `user`";
                                    $resultTime = $db->select($query);

                                    if ($resultTime) {
                                        foreach ($resultTime as $time) {
                                            ?>
                                            <option data-tokens="<?php echo $time['userId']; ?>"><?php echo $time['userId']; ?></option>
                                            <?php
                                        }
                                    }*/
                                    ?>

                                </select>-->
                            </div>
                            <div class="control-group">
                                <label class="control-label">From User Id</label>
                                 <input type="text"name="fromUser" class="form-control" rows="3" required="1">
                                 <!-- <select name="fromUser" class="form-control selectpicker" id="select-country" data-live-search="true">
                                    <?php
                                   /* $query = "SELECT `userId` FROM `user`";
                                    $resultTime = $db->select($query);

                                    if ($resultTime) {
                                        foreach ($resultTime as $time) {
                                            ?>
                                            <option data-tokens="<?php echo $time['userId']; ?>"><?php echo $time['userId']; ?></option>
                                            <?php
                                        }
                                    }*/
                                    ?>
                                </select>-->
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">Notes</label>
                                <textarea name="notes" class="form-control" id="exampleTextarea" rows="3"></textarea>
                            </div>  
                            <div class="form-group">
                                <label for="exampleTextarea">Amount</label>
                                <input type="text"name="amount" class="form-control" rows="3" required="1">
                            </div>  

                            <div class="form-check">
                                <button name="uerToUser" class="btn btn-primary" type="submit">Submit</button>
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