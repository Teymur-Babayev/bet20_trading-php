
<?php
include '../lib/Database.php';
$db = new Database();
$hiddenId =$_REQUEST['hiddenId'];

$match_id =$_REQUEST['match_id'];
?>

<div class="table-responsive">
    <table  class="table table-bordered table-hover" id="clubMember">
        <thead>
            <tr>
                <th>SN.</th>
                <th>Live Match </th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `betting_subtitle` where section_ct='$hiddenId' and bettingId='$match_id' and section_hide=0";
            $resultBettingTitle = $db->select($query);
            $i = 0;
            if ($resultBettingTitle) {
                while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td>
                          
                        <p><input type="text" name="name" placeholder="Enter Name" 
required value="  <?php echo $bettingTitle['title'] ?> " /></p>
                      
                        </td>
                        <td>


                            <input type="submit" match-id="<?php echo $match_id ?>" hidden-id="<?php echo $hiddenId ?>"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm defaultHiddenToLive"  value="To Panel">


                        </td>

                    </tr>
                    <?php
                }
            }
            ?>



        </tbody>


    </table>
</div><!--end of .table-responsive-->