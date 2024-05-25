<?php include './header.php'; ?>

<style>

    @font-face {
        font-family: myFirstFont;
        //   src: url('fonts/Open_Sans/OpenSans-SemiBold.ttf');
    }
    *{
        font-family: myFirstFont;
    }
    /* accordian*/




    /*live*/
    .livem {
        background: #4F555B !important;
        padding: 5px !important;
        border: 1px solid #9F9F9F;
        color: #D7D7D7 !important;
    }
    .upcoming {

        background: #4F555B !important;
        padding: 5px !important;
        border: 1px solid #9F9F9F;
        color: #D7D7D7 !important;
    }

    .first-lebal {
        background: #14805E  !important;

        color: #dadada !important;
        font-size: 14px !important;
    }
    .second-lebal {
        background: #666666 !important;

        color: #EBEBEB !important;
        font-size: 13px !important;
    }
    .panel-body{
        background: #fcfcfc;
    }
    .mrq {
        color: #2E2E2E;
        background: #dbdbdb;
        padding: 9px;
        border-left: 3px solid #ED4F4F;
        border-right: 3px solid #14805E;
        font-size: 15px;
    }
    .content-container {

        margin-left: auto;
        margin-right: auto;
    }
    .pr-0 {
        padding-right: 0 !important;
    }
    .pl-0 {
        padding-left: 0 !important;
    }
    .p-0 {
        padding: 0 !important;
    }
    .panel2 {
        margin-bottom: 0px;
        background-color: #fff;
        border: 0px solid transparent;
        border-radius: 0px;
        -webkit-box-shadow: 0 0px 0px rgba(0,0,0,.05);
        box-shadow: 0 0px 0px rgba(0,0,0,.05);
    }
    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid #929292 !important;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
    .button-rate {
        width: 120px;
        border-bottom: 3px solid #DD5246;
        background: #F1F1F1;
        color: #14805E;
    }
    .bg {
        background: #D24437 !important;
        margin-left: 16px;
        font-size: 11px;
    }
    .bgu {
        background: #1CA261 !important;
        margin-left: 16px;
        font-size: 11px;
    }

</style>

<section class="callaction " style="border-bottom: 1px solid #5F5F5F;min-height: 430px;">

    <div class="content-container mx-auto p-0 container">

        <div class="" >



            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12  pl-0 pr-0 " >

                <div class="table-responsive" style="background: #ffffff;">
                    <table  class="table table-bordered table-hover" id="sampleTable2">

                        <thead>
                            <tr>
                                <th scope="col" class="text-center">SN.</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">User Id</th>

                                <th scope="col">Match</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>

                                <th scope="col" class="text-center">Amount</th>
                                <th scope="col" class="text-center">Return Rate</th>
                                <th scope="col" class="text-center">Return Amount(Won)</th>

                                <th scope="col" class="text-center">Win/Lose</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "select * from `bet` where club='$_COOKIE[userId]' order by id desc";
                            $resultBet = $db->select($query);
                            if ($resultBet) {
                                $i = 0;
                                foreach ($resultBet as $bet) {
                                    $i++;
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $bet['time']; ?></td>
                                        <td><?php echo $bet['userId']; ?></td>

                                        <td>
                                            <?php
                                            $query = "select * from `betting_title` where id='$bet[matchId]'";
                                            $resultMatch = $db->select($query);
                                            if ($resultMatch) {
                                                $match = $resultMatch->fetch_assoc();
                                                echo $match['A_team'] . ' vs ' . $match['B_team'] . ' <> ' . $match['title'] . ' <> ' . $match['date'];
                                                ;
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $bet['matchTitle']; ?></td>
                                        <td><?php echo $bet['betTitle']; ?></td>

                                        <td><?php echo $bet['betAmount']; ?></td>
                                        <td><?php echo $bet['betRate']; ?></td>
                                        <td><?php echo $bet['betAmount'] * $bet['betRate']; ?></td>

                                        <td>

                                            <?php
                                            if ($bet['betStatus'] == 0) {
                                                ?>

                                                <button class="btn btn-default btn-sm ">
                                                    <i class="fa fa-spinner fa-spin" style="font-size:20px"></i> </button>

                                                <?php
                                            } else if ($bet['betStatus'] == 1) {
                                                ?>

                                                <button style="" class="btn btn-default btn-sm "><span><i style="font-size: 20px; color: green" class="fa fa-circle"></i></span>
                                                </button>



                                                <?php
                                            } else if ($bet['betStatus'] == 2) {
                                                ?>

                                                <button style="" class="btn btn-default btn-sm "><span><i style="font-size: 20px;color: red;" class="fa fa-circle"></i></span>
                                                </button>



                                                <?php
                                            }
                                            ?>
                                        </td>


                                    </tr>
                                    <?php
                                }
                            }
                            ?>


                        </tbody>

                    </table>
                </div><!--end of .table-responsive-->
            </div><!-- ./ endcol-lg-6 col-lg-offset-3 -->
            <div class="col-lg-2">

            </div>
        </div><!-- ./ end row -->

    </div>
</section>




<footer class="footer-basic-centered">

    <p class="footer-company-motto">The company motto.</p>

    <p class="footer-links">
        <a href="#">Home</a>
        ·
        <a href="#">Blog</a>
        ·
        <a href="#">Pricing</a>
        ·
        <a href="#">About</a>
        ·
        <a href="#">Faq</a>
        ·
        <a href="#">Contact</a>
    </p>

    <p class="footer-company-name">Company Name &copy; 2015</p>

</footer>
</div>


<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min_1.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/validation/placeBet.js"></script>
<script src="js/animate.js"></script>
<script src="js/validation/validated.js"></script>


    <script type="text/javascript" src="a99nz/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="a99nz/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
        $('#sampleTable2').DataTable();
        $('#sampleTable3').DataTable();
        $('#sampleTable4').DataTable();
    </script>


</body>
</html>

