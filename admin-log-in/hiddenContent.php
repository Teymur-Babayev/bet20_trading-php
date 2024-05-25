<?php 
session_start();
 if (isset($_COOKIE['adminPanel'])) {

    $adminId = $_COOKIE['adminId'];
    $adminType = $_COOKIE['adminType'];
} else {

    $adminId = $_SESSION['adminId'];
    $adminType = $_SESSION['adminType'];
}
?>
<?php
include '../lib/Database.php';
$db = new Database();
?>

<div class="table-responsive">
    <table  class="table table-bordered table-hover" id="clubMember">
        <thead>
            <tr>
                <th>SN.</th>
                <th>Live Match</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `betting_title` where status=1 and close=0  ORDER BY date asc";
            $resultBettingTitle = $db->select($query);
            $i = 0;
            if ($resultBettingTitle) {
                while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {

                    $i++;
                           $query = "SELECT `id` FROM `hiddenmatch` WHERE adminId='$adminId' and matchId='$bettingTitle[id]'";
                                if (($db->select($query))) {
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>
                            <?php
                        if ($bettingTitle['gameType'] == 1) {
                            ?>
                            <img src="../img/1393757333.png" width="27px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?>  
                            <?php
                        } else  if ($bettingTitle['gameType']==2) {
                            ?>
                            <img src="../img/ka-pl.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                            <?php
                        }  else {
                              ?>
                        
                            <img src="../img/basket.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                        <?php
                        }
                        ?>
                        </td>
                        <td>


                            <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm hiddenToLive"  value="To Panel">


                        </td>

                    </tr>
                    <?php
                }
                }
            }
        ?>



        </tbody>
        <thead>
            <tr>
                <th>SN.</th>
                <th>Upcoming match</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
          $query = "SELECT * FROM `betting_title` where status=2 and close=0  ORDER BY date asc";
            $resultBettingTitle = $db->select($query);
            $i = 0;
            if ($resultBettingTitle) {
                while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {

                    $i++;
                           $query = "SELECT `id` FROM `hiddenmatch` WHERE adminId='$adminId' and matchId='$bettingTitle[id]'";
                                if (($db->select($query))) {
                    ?>


                    <tr>
                        <td><?php echo $i ?></td>
                        <td>
                               <?php
                        if ($bettingTitle['gameType'] == 1) {
                            ?>
                            <img src="../img/1393757333.png" width="27px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?>  
                            <?php
                        } else  if ($bettingTitle['gameType']==2) {
                            ?>
                            <img src="../img/ka-pl.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                            <?php
                        }  else {
                              ?>
                        
                            <img src="../img/basket.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <span style="color: #EFA71D">VS</span> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                        <?php
                        }
                        ?>
                        </td>
                        <td>
                         <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm hiddenToLive"  value="To Panel">



                        </td>

                    </tr>
                    <?php
                }
                }
            }
        ?>



        </tbody>

    </table>
</div><!--end of .table-responsive-->