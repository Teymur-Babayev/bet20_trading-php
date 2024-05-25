<footer class="footer-basic-centered ">
    <div class="container">


        <div class="row">

            <div class="col-lg-3">
                <a  class="" href=""><img style="width: 150px;height: 70px;margin-left: 10px;" src="img/kkk.png"></a>
                <p style="font-size: 15px;color: #dcdcdc;" class="footer-company-name">Bet20.live &copy; <?php echo date("Y"); ?>  all right reserved.</p>
            </div>
            <div class="col-lg-6">
                <p class="footer-links">

                    <a href="index.php">Home</a>
                    |
                    <a href="#"> Contact-us</a>
                    |
                    <a href="#"> Rules & Regulations</a>
                    |
                    <a href="#"> FAQ</a>
                    |
                    <a href="#"> About Us</a>

                </p>


            </div>
            <div class="col-lg-3">
                <span class="userAlert"> </span>
            </div>
     
        </div>
    </div>

</footer>
</div>


<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min_1.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/validation/placeBet.js"></script>

<script src="js/validation/validated.js"></script>
<script src="js/validation/siteRefresh.js"></script>
<script src="js/validation/deposit_and_withdraw.js"></script>


<script type="text/javascript">


</script>


<?php
if (isset($_COOKIE["userId"]) AND ( isset($_COOKIE["password"]))) {

    include './chatBox.php';
}
?>



<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script src="js/validation/deposit_and_withdraw.js"></script>
<script src="js/validation/fetchChat.js"></script>
<!-- Google analytics script-->
<script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>

</body>
</html>