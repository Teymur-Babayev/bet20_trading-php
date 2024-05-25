<?php
session_start();
include '../lib/Database.php';
$db = new Database();
$data = array();
$output = ' ';
if (isset($_COOKIE['adminType'])) {
$adminType = $_COOKIE['adminType'];
} else {
$adminType = $_SESSION['adminType'];
}
$query = "SELECT * FROM `admin_notification` where seen=0 and action<3 and wAction<3 ";
$resulCount = $db->select($query);
if ($resulCount) {


    $data['count'] = $resulCount->num_rows;

if($adminType==3){
        foreach ($resulCount as $msg) {
        $output.= '     <li>';
        if ($msg['notificationType'] == 1) {
            $output.= '<a class="app-notification__item" href="thirdDeposit.php">';

            $output.= '  <span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">' . $msg['userId'] . ' sent you a deposit</p>
                                    
                                    </div></a>
                            </li>';
        } else {
            if ($msg['userType'] == 2) {
      
            } else {
                $output.= ' <a  class="app-notification__item" href="thirdWithdraw.php">';

                $output.= '  <span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p  class="app-notification__message">' . $msg['userId'] . ' sent you a withdraw</p>
                                    
                                    </div></a>
                            </li>';
            }
        }
    }
}  else {
        foreach ($resulCount as $msg) {
        $output.= '     <li>';
        if ($msg['notificationType'] == 1) {
            $output.= '<a class="app-notification__item" href="deposit.php">';

            $output.= '  <span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">' . $msg['userId'] . ' sent you a deposit</p>
                                    
                                    </div></a>
                            </li>';
        } else {
            if ($msg['userType'] == 2) {
                $output.= ' <a style="color:#E45829;" class="app-notification__item" href="clubInbox.php">';

                $output.= '  <span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">' . $msg['userId'] . ' sent you a withdraw</p>
                                    
                                    </div></a>
                            </li>';
            } else {
                $output.= ' <a  class="app-notification__item" href="withdrawInbox.php">';

                $output.= '  <span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p  class="app-notification__message">' . $msg['userId'] . ' sent you a withdraw</p>
                                    
                                    </div></a>
                            </li>';
            }
        }
    }
}

}
$data['list'] = $output;
$data = json_encode($data);
echo $data;
//header("Content-type: application/json");
