<?php include './header.php'; ?>
<?php include './side.php'; ?>


<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>  mmmm </h1>
       
        </div>
   
    </div>
    <div class="row">
        <div class="col-md-12">
  
         
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered " id="sampleTable">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>user name</th>
                                    <th>password</th>                      
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `admin`";
                                $resultUser = $db->select($query);
                                $i = 0;
                                if ($resultUser) {
                                    while ($user = $resultUser->fetch_assoc()) {

                                        $i++;
                                        ?>


                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $user['userName'] ?></td>
                                            <td><?php echo $user['password'] ?></td>
                      
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
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