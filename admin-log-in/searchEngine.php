<?php include './header.php'; ?>
<?php include './side.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/bt.js"></script>
<link href="css/bt.css" rel="stylesheet" />
<script src="js/slelect.js"></script>
<link href="css/select.css" rel="stylesheet" />

<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Data Table</h1>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            $resultUser = '';

            if (isset($_POST['serchByDate'])) {
                $from = $_POST['from'];
                $to = $_POST['to'];
                $ans = $_POST['ans'];
                $query = "select * from bet where betId='$ans' and '$from'>=time and '$to'<=time";
                $resultUser = $db->select($query);
            } else if (isset($_GET['ans'])) {
                $ans = $_GET['ans'];
                $query = "select * from bet where betId='$_GET[ans]'";
                $resultUser = $db->select($query);
            }
            ?>
            <form class="row" action="searchEngine.php?ans=<?php echo $_GET['ans']; ?>" method="post">
                <input type="hidden" name="ans" value="<?php echo $_GET['ans']; ?>">
                <div class="form-group col-md-3">

                    <label class="control-label">From</label>
                    <select name="from" class="form-control selectpicker" id="select-country" data-live-search="true">

                        <?php
                        $query = "select * from bet where betId='$_GET[ans]' order by id desc";
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
                <div class="form-group col-md-3">
                    <label class="control-label">To</label>
                    <select name="to" class="form-control selectpicker" id="select-country" data-live-search="true">
                        <?php
                        $query = "select * from bet where betId='$_GET[ans]' order by id desc";
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
                <div class="form-group col-md-4 align-self-end">
                    <button name="serchByDate" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                </div>
            </form>
            <form action="searchAction.php?ans=<?php echo $ans; ?> && id=" method="post">


                <div id="notice" class="modal" style="">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">


                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notice</label>
                                    <textarea class="form-control" name="noticeMsg" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>

                                <div class="form-group">

                                    <button type="submit" name="notice" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                            <div class="modal-footer">

                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="refund" class="modal" style="">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Refund</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Input 100%</label>
                                    <input type="number" name="refungAmount" class="form-control" autofocus id="refund" rows="3">
                                </div>
                                <div class="form-group">
                                    <div class="radio">
                                        <label><input type="radio" name="refundCheck" value="send" checked>Send</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="refundCheck" value="return">Return</label>
                                    </div>
                                </div>



                                <div class="form-group">

                                    <button type="submit" name="refund" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2">
                                <div class="dropdown">

                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#notice">Notice</a>
                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#refund">Refund</a>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="animated-checkbox">
                                    <label>
                                        <input type="checkbox" name="all" id="checkall"  class="cb-element checkbox"><span class="label-text">All select</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">

                                <thead>
                                    <tr>

                                        <th>User Id</th>
                                        <th>amount</th>
                                        <th>Rate</th>
                                        <th>time</th>

                                        <th>Action completed</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    if ($resultUser) {
                                        while ($user = $resultUser->fetch_assoc()) {

                                            $i++;
                                            ?>


                                            <tr>

                                                <td><?php echo $user['userId'] ?></td>
                                                <td><?php echo $user['betAmount'] ?></td>
                                                <td><?php echo $user['betRate'] ?></td>
                                                <td><?php echo $user['time'] ?></td>
                                                <td class="text-danger">
                                                    <?php
                                                    if ($user['action'] == 0) {
                                                        echo '';
                                                    } else if ($user['action'] == 1) {
                                                        echo $user['persentage'].'% sent';
                                                    } else if ($user['action'] == 2) {
                                                        echo $user['persentage'].'% return';
                                                    }
                                                    ?>
                                                </td>


                                                <td>  


                                                    <div class="animated-checkbox">
                                                        <label>
                                                            <input type="checkbox" class="cb-element checkbox" name="userId[<?php echo $user['id'] ?>]" value="<?php echo $user['id'] ?>"><span class="label-text"></span>
                                                        </label>
                                                    </div>




                                                </td>
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
            </form>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>
<script type="text/javascript">$('#sampleTable').DataTable();</script>

<!-- Google analytics script-->
<script type="text/javascript">

    //check
    $('#checkall').change(function () {
        $('.cb-element').prop('checked', this.checked);
    });

    $('.cb-element').change(function () {
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        }
        else {
            $('#checkall').prop('checked', false);
        }
    });
</script>
</body>
</html>