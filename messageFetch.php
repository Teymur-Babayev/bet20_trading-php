<?php
include './lib/Database.php';
$db = new Database();
$data = array();
$st = '';
if (isset($_COOKIE["userId"])) {
    
       $query = "SELECT * FROM `user_notify` where userId='$_COOKIE[userId]'";
    $resulCount = $db->select($query);
    if ($resulCount) {
    $data['msgCount']=$resulCount->num_rows;
    }  else {
         $data['msgCount']='';
    }
 
    $query = "SELECT * FROM `chat` where userId='$_COOKIE[userId]'";
    $resulMsg = $db->select($query);
    if ($resulMsg) {

        foreach ($resulMsg as $msg) {
            if ($msg['admin'] == 1) {
                $st.='
                    <li>
                        <div class="left-chat">
                          <img src="img/admin.png">
                            <p>' . $msg['msg'] . '
                            </p>
                            
                        </div>
                    </li>';
            } else {

                $st.=' <li>
                        <div class="right-chat">
                             <img src="img/user.png">
                         <p>' . $msg['msg'] . '</p>
                       
                        </div>
                    </li>
          


                ';
            }
        }
    }
} else {
      $data["error"]="error";
}
$data['inbox'] = $st;
$data = json_encode($data);
echo $data;
//header("Content-type: application/json");
?>
