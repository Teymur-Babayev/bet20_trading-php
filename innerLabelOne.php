           <?php
                    $query = "SELECT * FROM `betting_subtitle` WHERE bettingId='$bettingTitle[id]'";
                    $resultBettingSubTitle = $db->select($query);
                    $i = 0;
                    if ($resultBettingSubTitle) {
                        while ($bettingSubTitle = $resultBettingSubTitle->fetch_assoc()) {

                            $i++;
                            ?>

                            <a  href="#" class="list-group-item second-lebal">
                                <?php echo $bettingSubTitle['title'] ?> <span style="color: #FF4D55">Live</span>

                                <span class="glyphicon glyphicon-menu-right mg-icon pull-right"></span></a>
                            <div class="panel list-sub" style="border: 1px solid #3A465F;border-bottom: 0px">
                                <div class="panel-body" >
                                    <!-- third label -->
                                    <!-- third label -->
                                    <ul class="" style="list-style: none;">
                                        <?php
                                        $query = "SELECT `title`, `amount` FROM `betting_sub_title_option` WHERE  bettingSubTitleId='$bettingSubTitle[id]'";
                                        $resultBettingSubTitleOption = $db->select($query);
                                        $i = 0;
                                        if ($resultBettingSubTitleOption) {
                                            while ($BettingSubTitleOption = $resultBettingSubTitleOption->fetch_assoc()) {

                                                $i++;
                                                ?>
                                                <li style="float: left;margin-right: 20px;"> <h5  style="text-align: center;width: 100%;color: #3A465F">  <?php echo $BettingSubTitleOption['title'] ?>  </h5>
                                                    <button style="width: 120px;border-bottom: 3px solid #DD5246;" class="btn btn-default "> <?php echo $BettingSubTitleOption['amount'] ?></button>
                                                </li>

                                                <?php
                                            }
                                        }
                                        ?>


                                    </ul>

                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>


