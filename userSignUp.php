<?php

session_start();
include './lib/Database.php';
$db = new Database();

function validate_mobile($mobile) {
    return preg_match('/^[0]?(1)[56789]\d{8}$/', $mobile);
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['name'])) {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $mobileNumber = test_input($_POST['mobileNumber']);
    $userId = test_input($_POST['userId']);
    $confirmPassword = test_input($_POST['confirmPassword']);
    $sponsorUsername = test_input($_POST['sponsor']);
    $clubId = test_input($_POST['club']);
    if ($name != "" && $email != "" && $password != "" && $mobileNumber != "" && $userId != "" && $clubId != "" && $confirmPassword != "") {
        if ($password == $confirmPassword) {
            $query = "select * from `user` where userId='$userId'";
            $result = $db->select($query);
            if (!$result) {
                $query = "select * from `user` where email='$email'";
                $result = $db->select($query);
                if (!$result) {
                    $query = "select * from `user` where  mobileNumber='$mobileNumber'";
                    $result = $db->select($query);
                    if (!$result) {

                        $query = "select * from `club` where userId='$userId'";
                        $result = $db->select($query);
                        if (!$result) {

                            if ($sponsorUsername) {
                                $query = "select * from `user` where userId='$sponsorUsername'";
                                $resultS = $db->select($query);
                                if ($resultS) {

                                    if (validate_mobile($mobileNumber)) {
                                        if (validate_email($email)) {

                                            $query = "INSERT INTO `user`(`name`, `userId`, `password`, `mobileNumber`, `sponsorUsername`, `clubId`, `email`)"
                                                    . " VALUES ('$name','$userId','$password','$mobileNumber','$sponsorUsername','$clubId','$email')";
                                            $resultClubInsert = $db->insert($query);

                                            if ($resultClubInsert) {

//set up cookie
                                                setcookie("userId", $userId, time() + (86400 * 30));
                                                setcookie("password", $password, time() + (86400 * 30));


                                                $_SESSION['userId'] = $userId;
                                                $query = "select * from `user` where userId='$userId' and password='$password'";
                                                $result = $db->select($query);
                                                if ($result) {
                                                    $row = $result->fetch_assoc();

                                                    setcookie("id", $row['id'], time() + (86400 * 30));
                                                }
                                            } else {
                                                echo 'some thing error';
                                            }
                                        } else {
                                            echo 'Email address not valid';
                                        }
                                    } else {
                                        echo 'Mobile Number Not valid';
                                    }
                                } else {
                                    echo 'sponsor not match !';
                                }
                            } else {


                                if (validate_mobile($mobileNumber)) {
                                    if (validate_email($email)) {

                                        $query = "INSERT INTO `user`(`name`, `userId`, `password`, `mobileNumber`, `sponsorUsername`, `clubId`, `email`)"
                                                . " VALUES ('$name','$userId','$password','$mobileNumber','$sponsorUsername','$clubId','$email')";
                                        $resultClubInsert = $db->insert($query);

                                        if ($resultClubInsert) {

//set up cookie
                                            setcookie("userId", $userId, time() + (86400 * 30));
                                            setcookie("password", $password, time() + (86400 * 30));


                                            $_SESSION['userId'] = $userId;
                                            $query = "select * from `user` where userId='$userId' and password='$password'";
                                            $result = $db->select($query);
                                            if ($result) {
                                                $row = $result->fetch_assoc();

                                                setcookie("id", $row['id'], time() + (86400 * 30));
                                            }
                                        } else {
                                            echo 'some thing error';
                                        }
                                    } else {
                                        echo 'Email address not valid';
                                    }
                                } else {
                                    echo 'Mobile Number Not valid';
                                }
                            }
                        } else {
                            echo 'User id already exist ! please insert another user id';
                        }
                    } else {
                        echo 'mobile number exist ! please insert another';
                    }
                } else {
                    echo ' email address already exist ! please insert another';
                }
            } else {
                echo 'User id already exist ! please insert another user id';
            }
        } else {
            echo 'confirm password not match !';
        }
    } else {
        echo 'Field is requred !!';
    }
} else {
    echo 'Field is requred !!';
}
?>