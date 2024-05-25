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

<?php
$query = "SELECT * FROM `betting_title` where status=2 and close=0 ORDER BY date asc";
$resultBettingTitle = $db->select($query);
$i = 0;
if ($resultBettingTitle) {
    while ($bettingTitle = $resultBettingTitle->fetch_assoc()) {

        $i++;
        $query = "SELECT `id` FROM `hiddenmatch` WHERE adminId='$adminId' and matchId='$bettingTitle[id]'";
        if (!($db->select($query))) {
            ?>
            <!-- Modal -->



            <!-- first label -->

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">

                    <div class="panel-heading" role="tab" id="headingOne<?php echo $bettingTitle['id'] ?>one">
                        <h4 class="panel-title">
                            <a class="upcoming_panel" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $bettingTitle['id'] ?>one" aria-expanded="true" aria-controls="collapseOne<?php echo $bettingTitle['id'] ?>one">

                                <?php
                                if ($bettingTitle['gameType'] == 1) {
                                    ?>
                                    <img src="../img/f_ball.png" width="25px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 


                                    <button class="btn btn-primary  btn-sm matchActionMenu" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#matchActionMenu">action </button>
                                    <button class="btn btn-info  btn-sm matchActiondefault" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#default">d-hidden</button>

                                    <button class="btn btn-primary  btn-sm limitMatch" href="" id="<?php echo $bettingTitle['id'] ?>" data-toggle="modal" data-target="#limitMatch">Limit(<?php echo $bettingTitle['limitedAmount'] ?>) </button>
                                    <button class="btn btn-primary  btn-sm matchWatting" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#matchWatting">Wait(<?php echo $bettingTitle['waittingTime'] ?>) </button>
                                    <button class="btn btn-danger  btn-sm toLive"  id="<?php echo $bettingTitle['id'] ?>">To live </button>
                                    <?php
                                    if ($bettingTitle['showStatus'] == 1) {
                                        ?>                                                                                                          
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchStop"  value="Stop">

                                        <?php
                                    } else {
                                        ?>                                             
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchActive"  value="Active">

                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($bettingTitle['hide'] == 1) {
                                        ?>                                                                                                      
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchHide"  value="hide">

                                        <?php
                                    } else {
                                        ?>                                                                                                   
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchShow"  value="show">

                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($bettingTitle['ariaHide'] == 1) {
                                        ?>
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" name="bettingTitleAriaHide" class="btn btn-primary  btn-sm matchAriaHide"  value="aria hide">

                                        <?php
                                    } else {
                                        ?>  
                                        <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchAriaShow"  value="aria show">

                                        <?php
                                    }
                                    ?>
                                    <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchHideFromPanel"  value="hide from panel">

                                    || <span>operator(<?php echo $bettingTitle['user'] ?>)</span>
                                    <?php
                                } else if ($bettingTitle['gameType'] == 2) {
                                    ?>
                                    <img src="../img/cricket.png" width="25px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                                    <button class="btn btn-primary  btn-sm matchActionMenu" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#matchActionMenu">action </button>
                                    <button class="btn btn-info  btn-sm matchActiondefault" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#default">d-hidden</button>

                                    <button class="btn btn-primary  btn-sm limitMatch" href="" id="<?php echo $bettingTitle['id'] ?>" data-toggle="modal" data-target="#limitMatch">Limit(<?php echo $bettingTitle['limitedAmount'] ?>) </button>
                                    <button class="btn btn-primary  btn-sm matchWatting" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#matchWatting">Wait(<?php echo $bettingTitle['waittingTime'] ?>) </button>

                                    <button class="btn btn-danger  btn-sm toLive"  id="<?php echo $bettingTitle['id'] ?>">To live </button>
                                    <?php
                                    if ($bettingTitle['showStatus'] == 1) {
                                        ?>                                                                                                          
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchStop"  value="Stop">

                                        <?php
                                    } else {
                                        ?>                                             
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchActive"  value="Active">

                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($bettingTitle['hide'] == 1) {
                                        ?>                                                                                                      
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchHide"  value="hide">

                                        <?php
                                    } else {
                                        ?>                                                                                                   
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchShow"  value="show">

                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($bettingTitle['ariaHide'] == 1) {
                                        ?>
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" name="bettingTitleAriaHide" class="btn btn-primary  btn-sm matchAriaHide"  value="aria hide">

                                        <?php
                                    } else {
                                        ?>  
                                        <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchAriaShow"  value="aria show">

                                        <?php
                                    }
                                    ?>
                                    <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchHideFromPanel"  value="hide from panel">
                                    || <span>operator(<?php echo $bettingTitle['user'] ?>)</span>
                                    <?php
                                } else {
                                    ?>
                                    <img src="../img/bas.png" width="30px;">&nbsp; <?php echo $bettingTitle['A_team'] ?> <> <?php echo $bettingTitle['B_team'] ?> ,<?php echo $bettingTitle['title'] ?> || <?php echo substr_replace($bettingTitle['date'], "@", 12, 0) ?> 

                                    <button class="btn btn-primary  btn-sm matchActionMenu" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#matchActionMenu">action </button>
                                    <button class="btn btn-info  btn-sm matchActiondefault" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#default">d-hidden</button>

                                    <button class="btn btn-primary  btn-sm limitMatch" href="" id="<?php echo $bettingTitle['id'] ?>" data-toggle="modal" data-target="#limitMatch">Limit(<?php echo $bettingTitle['limitedAmount'] ?>) </button>
                                    <button class="btn btn-primary  btn-sm matchWatting" href="" data-toggle="modal" id="<?php echo $bettingTitle['id'] ?>" data-target="#matchWatting">Wait(<?php echo $bettingTitle['waittingTime'] ?>) </button>

                                    <button class="btn btn-danger  btn-sm toLive"  id="<?php echo $bettingTitle['id'] ?>">To live </button>
                                    <?php
                                    if ($bettingTitle['showStatus'] == 1) {
                                        ?>                                                                                                          
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchStop"  value="Stop">

                                        <?php
                                    } else {
                                        ?>                                             
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchActive"  value="Active">

                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($bettingTitle['hide'] == 1) {
                                        ?>                                                                                                      
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchHide"  value="hide">

                                        <?php
                                    } else {
                                        ?>                                                                                                   
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchShow"  value="show">

                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($bettingTitle['ariaHide'] == 1) {
                                        ?>
                                        <input type="submit" id="<?php echo $bettingTitle['id'] ?>" name="bettingTitleAriaHide" class="btn btn-primary  btn-sm matchAriaHide"  value="aria hide">

                                        <?php
                                    } else {
                                        ?>  
                                        <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-danger  btn-sm matchAriaShow"  value="aria show">

                                        <?php
                                    }
                                    ?>
                                    <input type="submit"  id="<?php echo $bettingTitle['id'] ?>" class="btn btn-primary  btn-sm matchHideFromPanel"  value="hide from panel">
                                    || <span>operator(<?php echo $bettingTitle['user'] ?>)</span>
                                    <?php
                                }
                                ?>

                                <?php
                                $query = "SELECT * FROM `bet` where matchId='$bettingTitle[id]'";
                                $Count = $db->select($query);

                                if ($Count) {
                                    if ($Count->num_rows > 0) {
                                        ?>
                                        <span style="background: #DD5145;color: #ececec;margin-left: 10px;" class="badge  text-right" > <?php echo $Count->num_rows; ?></span>
                                        <?php
                                    }
                                }
                                ?> 
                                <?php
                                $query = "SELECT sum(betAmount) as total FROM `bet` WHERE matchId='$bettingTitle[id]'";
                                $result = $db->select($query);
                                if ($result) {
                                    $fetch = $result->fetch_assoc();
                                    $total = $fetch['total'];
                                    ?>
                                    <span style="margin-left: 10px;" class="badge badge-info text-right" > <?php echo $total; ?></span>
                                    <?php
                                }
                                ?>

                            </a>

                        </h4>
                    </div>
                    <?php
                    if ($bettingTitle['ariaHide'] == 1) {
                        ?>
                        <div id="collapseOne<?php echo $bettingTitle['id'] ?>one" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne<?php echo $bettingTitle['id'] ?>one">
                            <div class="panel-body" style="">

                                <!-- second label -->
                                <div class="panel-group" id="accordion<?php echo $bettingTitle['id'] ?>one" role="tablist" aria-multiselectable="true">
                                    <?php
                                    $query = "SELECT * FROM `betting_subtitle` WHERE bettingId='$bettingTitle[id]' and close=0 and section_hide=1";
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



                                                            <button class="btn btn-primary  btn-sm questionActionMenu" href="" data-toggle="modal" id="<?php echo $bettingSubTitle['id'] ?>" data-target="#questionActionMenu">action </button>

                                                            <button class="btn btn-primary  btn-sm questionlimit" href="" id="<?php echo $bettingSubTitle['id'] ?>" data-toggle="modal" data-target="#limitQuestion">Limit(<?php echo $bettingSubTitle['limitedAmount'] ?>) </button>
                                                            <button class="btn btn-primary  btn-sm questionWatting" href="" data-toggle="modal" id="<?php echo $bettingSubTitle['id'] ?>" data-target="#questionWatting">Wait(<?php echo $bettingSubTitle['waittingTime'] ?>) </button>

                                                            <?php
                                                            if ($bettingSubTitle['showStatus'] == 1) {
                                                                ?>                                                                                                          
                                                                <input type="submit" id="<?php echo $bettingSubTitle['id'] ?>" class="btn btn-primary  btn-sm questionStop"  value="Stop">

                                                                <?php
                                                            } else {
                                                                ?>

                                                                <input type="submit" id="<?php echo $bettingSubTitle['id'] ?>" class="btn btn-danger  btn-sm questionActive"  value="Active">

                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($bettingSubTitle['hide'] == 1) {
                                                                ?>


                                                                <input type="submit" id="<?php echo $bettingSubTitle['id'] ?>" class="btn btn-primary  btn-sm questionHide"  value="hide">

                                                                <?php
                                                            } else {
                                                                ?>


                                                                <input type="submit" id="<?php echo $bettingSubTitle['id'] ?>" class="btn btn-danger  btn-sm questionShow"  value="show">

                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($bettingSubTitle['ariaHide'] == 1) {
                                                                ?>


                                                                <input type="submit" id="<?php echo $bettingSubTitle['id'] ?>"  class="btn btn-primary  btn-sm questionhAriaHide"  value="aria hide">

                                                                <?php
                                                            } else {
                                                                ?>


                                                                <input type="submit"  id="<?php echo $bettingSubTitle['id'] ?>" class="btn btn-danger  btn-sm questionAriaShow"  value="aria show">

                                                                <?php
                                                            }
                                                            ?>


                                                            <?php
                                                            $query = "SELECT id FROM `bet` where betTitleId='$bettingSubTitle[id]'";
                                                            $Count = $db->select($query);

                                                            if ($Count) {
                                                                if ($Count->num_rows > 0) {
                                                                    ?>
                                                                    <span style="background: #DD5145;color: #ececec;margin-left: 10px;" class="badge  text-right" > <?php echo $Count->num_rows; ?></span>
                                                                    <?php
                                                                }
                                                            }
                                                            ?> 

                                                        </a>

                                                    </h4>

                                                </div>
                                                <?php
                                                if ($bettingSubTitle['ariaHide'] == 1) {
                                                    ?>

                                                    <div id="collapseOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne<?php echo $bettingTitle['id'] ?>one<?php echo $bettingSubTitle['id'] ?>">
                                                        <div class="panel-body-2" style="padding: 10px;margin-bottom: 5px;">
                                                            <!-- third label -->
                                                            <div class="">

                                                                <div class="col-md-12">
                                                                    <div class="">

                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered ">
                                                                                <thead>
                                                                                    <tr>

                                                                                        <th scope="col">Answer</th>
                                                                                        <th scope="col">Bet Rate</th>

                                                                                        <th scope="col">Place bet</th>
                                                                                        <th scope="col">Betting Amount</th>
                                                                                        <th scope="col">Return Amount</th>
                                                                                        <th scope="col">Action</th>
                                                                                        <th scope="col">limit</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $totalBetAmount = 0;
                                                                                    $totalReturnAmount = 0;
                                                                                    $query = "SELECT * FROM `betting_sub_title_option` WHERE  bettingSubTitleId='$bettingSubTitle[id]'";
                                                                                    $resultBettingSubTitleOption = $db->select($query);
                                                                                    $i = 0;
                                                                                    if ($resultBettingSubTitleOption) {
                                                                                        while ($BettingSubTitleOption = $resultBettingSubTitleOption->fetch_assoc()) {

                                                                                            $i++;
                                                                                            ?>
                                                                                            <tr>

                                                                                                <td> <a href="" class="btn btn-primary updateAnsRateT" data-toggle="modal" id="<?php echo $BettingSubTitleOption['id'] ?>" data-target="#updateAnsT">  <?php echo $BettingSubTitleOption['title'] ?></a> </td>
                                                                                                <td> <a href="" class="btn btn-primary updateAnsRate" tt="<?php echo $BettingSubTitleOption['title'] ?>" data-toggle="modal" id="<?php echo $BettingSubTitleOption['id'] ?>" data-target="#updateAnsRate"> <?php echo $BettingSubTitleOption['amount'] ?></a> </td>

                                                                                                <?php
                                                                                                $query = "SELECT * FROM `bet` where betId='$BettingSubTitleOption[id]' and action=0";
                                                                                                $Count = $db->select($query);


                                                                                                if ($Count) {
                                                                                                    if ($Count->num_rows > 0) {
                                                                                                        $sum = 0;
                                                                                                        $sumReturn = 0;

                                                                                                        foreach ($Count as $data) {
                                                                                                            $sum+=$data['betAmount'];
                                                                                                            $sumReturn+=$data['returnAmount'];
                                                                                                        }
                                                                                                        $totalBetAmount+=$sum;
                                                                                                        $totalReturnAmount+=$sum * $BettingSubTitleOption['amount'];
                                                                                                        ?>
                                                                                                        <td>
                                                                                                            <?php echo $Count->num_rows; ?>
                                                                                                        </td>
                                                                                                        <td><?php echo $sum; ?></td>
                                                                                                        <td><?php echo $sumReturn; ?></td>

                                                                                                        <?php
                                                                                                    }
                                                                                                } else {
                                                                                                    ?>
                                                                                                    <td>
                                                                                                        0
                                                                                                    </td>
                                                                                                    <td>0</td>
                                                                                                    <td>0</td>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                                <td>

                                                                                                    <?php
                                                                                                    if ($adminType == 1) {
                                                                                                        ?>

                                                                                                        <?php
                                                                                                        $query = "SELECT * FROM `bet` where betId='$BettingSubTitleOption[id]'";
                                                                                                        $resultUser = $db->select($query);
                                                                                                        if ($resultUser) {


                                                                                                            $user = $resultUser->fetch_assoc();
                                                                                                            if ($user['betStatus'] == 1) {
                                                                                                                ?>
                                                                                                                <a href="betPanelAction.php?match=<?php echo $bettingTitle['id']; ?> && que=<?php echo $bettingSubTitle['id']; ?> && ans=<?php echo $BettingSubTitleOption['id']; ?>" onclick="return confirm('Are you sure ?')" style="color: #fff"  class="btn btn-sm btn-success ">
                                                                                                                    wined
                                                                                                                </a>
                                                                                                                <?php
                                                                                                            } else if ($user['betStatus'] == 2) {
                                                                                                                ?>
                                                                                                                <a href="betPanelAction.php?match=<?php echo $bettingTitle['id']; ?> && que=<?php echo $bettingSubTitle['id']; ?> && ans=<?php echo $BettingSubTitleOption['id']; ?>" onclick="return confirm('Are you sure ?')" style="color: #fff"  class="btn btn-sm btn-danger ">
                                                                                                                    lose
                                                                                                                </a>                                                                                                           
                                                                                                                <?php
                                                                                                            } else {
                                                                                                                ?>
                                                                                                                <a href="betPanelAction.php?match=<?php echo $bettingTitle['id']; ?> && que=<?php echo $bettingSubTitle['id']; ?> && ans=<?php echo $BettingSubTitleOption['id']; ?>" onclick="return confirm('Are you sure ?')" style="color: #fff"  class="btn btn-sm btn-primary ">
                                                                                                                    win
                                                                                                                </a>                                                                                                              
                                                                                                                <?php
                                                                                                            }
                                                                                                        } else {
                                                                                                            ?>
                                                                                                            <a href="betPanelAction.php?match=<?php echo $bettingTitle['id']; ?> && que=<?php echo $bettingSubTitle['id']; ?> && ans=<?php echo $BettingSubTitleOption['id']; ?>" onclick="return confirm('Are you sure ?')" style="color: #fff"  class="btn btn-sm btn-primary ">
                                                                                                                win
                                                                                                            </a>                                                                                                              
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>


                                                                                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                                                        Action
                                                                                                    </button>
                                                                                                    <div class="dropdown-menu">

                                                                                                        <?php
                                                                                                        if ($adminType == 1) {
                                                                                                            ?>
                                                                                                            <a class="dropdown-item" href="searchEngine.php?ans=<?php echo $BettingSubTitleOption['id'] ?>">user action</a>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        if ($BettingSubTitleOption['showStatus'] == 1) {
                                                                                                            ?>
                                                                                                            <button style="cursor: pointer" class="dropdown-item ansStop" id="<?php echo $BettingSubTitleOption['id'] ?>">Stop</button>

                                                                                                            <?php
                                                                                                        } else {
                                                                                                            ?>
                                                                                                            <button style="cursor: pointer" class="dropdown-item ansActive" id="<?php echo $BettingSubTitleOption['id'] ?>">Active</button>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                        <?php
                                                                                                        if ($BettingSubTitleOption['hide'] == 1) {
                                                                                                            ?>

                                                                                                            <button style="cursor: pointer" class="dropdown-item ansHide" id="<?php echo $BettingSubTitleOption['id'] ?>">hide</button>

                                                                                                            <?php
                                                                                                        } else {
                                                                                                            ?>
                                                                                                            <button style="cursor: pointer" class="dropdown-item ansShow" id="<?php echo $BettingSubTitleOption['id'] ?>">Show</button>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>

                                                                                                        <button style="cursor: pointer" class="dropdown-item deleteAns" id="<?php echo $BettingSubTitleOption['id'] ?>">delete</button>

                                                                                                    </div>
                                                                                                    </div>




                                                                                                </td>
                                                                                                <td> <a class="btn btn-primary btn-sm limitAns" href="" data-toggle="modal" id="<?php echo $BettingSubTitleOption['id'] ?>" data-target="#limitAns">Limit (<?php echo $BettingSubTitleOption['limitedAmount'] ?>)</a></td>

                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>


                                                                                    <tr>


                                                                                        <th style="border: 0px;"></th>
                                                                                        <th style="border: 0px;"></th>
                                                                                        <th style="border: 0px;"></th>
                                                                                        <th scope="col">Total=<?php echo $totalBetAmount; ?></th>
                                                                                        <th style="border: 0px;"></th>
                                                                                        <th style="border: 0px;"></th>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>






                                                            </div>

                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>



                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
} else {
    ?>
    <div class="alert alert-dismissible alert-danger">
        <button class="close" type="button" data-dismiss="alert">×</button><strong>Match not Found !!!</strong>
    </div>
    <?php
}
?>