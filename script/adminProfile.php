<?php include './header.php'; ?>
<?php include './side.php'; ?>

<main class="app-content">

    <div class="container">
        <div class="row">
            <div class="col-md-1 ">

            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($_POST['update'])) {
                            $name = $_POST['name'];
                            $userName = $_POST['userName'];
                            $email = $_POST['email'];

                            $newpass = $_POST['newpass'];
                            $oldpass = $_POST['oldpass'];
                            if ($name != '' && $userName != '' && $email != '' && $newpass != '' && $oldpass != '') {



                                $query = "SELECT * FROM `admin` WHERE password='$oldpass' and type='1'";
                                $result = $db->select($query);

                                if (!$result) {
                                    ?>
                                    <div  class="alert alert-danger errorWithraw" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            ×</button>  <strong>  Opps !!</strong> password not match.
                                    </div>
                                    <?php
                                } else {
                                    $query = "UPDATE `admin` SET"
                                            . " `name`='$name',"
                                            . "`userName`='$userName',"
                                            . "`password`='$newpass',"
                                            . "`email`='$email'"
                                            . " WHERE type='1'";
                                    $resultClubInsert = $db->update($query);

                                    if ($resultClubInsert) {
                                        
                                    } else {
                                        
                                    }
                                }
                            } else {
                                ?>
                                <div  class="alert alert-danger errorWithraw" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>  <strong>  Opps !!</strong> Field is required.
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Your Profile</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $query = "select * from `admin` where type='1'";
                                $result = $db->select($query);
                                if ($result) {
                                    $account = $result->fetch_assoc();
                                    ?>

                                    <form action="" method="post">
                                        <div class = "form-group row">
                                            <label for = "username" class = "col-4 col-form-label"> Name*</label>
                                            <div class = "col-8">
                                                <input value="<?php echo $account['name']; ?>" name="name" placeholder = "Name" class = "form-control here" required = "required" type = "text">
                                            </div>
                                        </div>
                                        <div class = "form-group row">
                                            <label for = "name" class = "col-4 col-form-label">User Name *</label>
                                            <div class = "col-8">
                                                <input id = "name" name = "userName" value="<?php echo $account['userName']; ?>" placeholder = "First Name" class = "form-control here" type = "text" required="1">
                                            </div>
                                        </div>

                                        <div class = "form-group row">
                                            <label for = "email"  class = "col-4 col-form-label">Email*</label>
                                            <div class = "col-8">
                                                <input id = "email"  value="<?php echo $account['email']; ?>" name ="email" placeholder = "Email" class = "form-control here" required = "required" type = "text">
                                            </div>
                                        </div>
                                        <div class = "form-group row">
                                            <label for = "newpass" class = "col-4 col-form-label">Old Password</label>
                                            <div class = "col-8">
                                                <input   name = "oldpass" placeholder = "Old Password" class = "form-control" type ="password" required="1"  value="<?php echo $account['password']; ?>">
                                            </div>
                                        </div>
                                        <div class = "form-group row">
                                            <label for = "newpass" class = "col-4 col-form-label">New Password</label>
                                            <div class = "col-8">
                                                <input  name = "newpass" placeholder = "New Password" class = "form-control" type = "password" required="1">
                                            </div>
                                        </div>
                                        <div class = "form-group row">
                                            <div class = "offset-4 col-8">
                                                <button name = "update" type = "submit" class = "btn btn-primary">Update My Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</main>
<!--Essential javascripts for application to work-->
<script src = "js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
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