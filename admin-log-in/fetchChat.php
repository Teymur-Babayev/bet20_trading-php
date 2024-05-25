<?php
include '../lib/Database.php';
$db = new Database();
$data = array();
$output = ' ';
$data['countChat']='';
$data['list']='';
$query = "SELECT * FROM `admin_notify` where type='1'";
$resulCount = $db->select($query);
if ($resulCount) {
    $data['countChat'] = $resulCount->num_rows;
    foreach ($resulCount as $msg) {
        $output.= '     <li>';
            $output.= ' <a class="app-notification__item" href="chat.php?userName='.$msg['userId'].'">';
        $output.= '  <span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">' . $msg['userId'] . ' sent you a mail</p>
                                     
                                    </div></a>
                            </li>';
    }
} else {
    
}
$data['list'] = $output;
$data = json_encode($data);
echo $data;
//header("Content-type: application/json");
