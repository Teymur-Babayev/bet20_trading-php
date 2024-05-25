<?php

$ar=array();
$myObj=array("name"=>["ap","au","mp"]);
$ar=$myObj;
$users = json_encode($ar);
echo $users;
header("Content-type: application/json");
