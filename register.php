<?php

// Include configuration file
require_once "register_function.php";

$register_html = "./register.html";

//Inputs are trimmed '\s' begging or end
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$birthdate = trim($_POST['birthdate']);
$gender = trim($_POST['gender']);
$country = trim($_POST['country']);
$occupation = trim($_POST['occupation']);

//  Validate if request is POST
//  arg is redirect link in case of failure
validatePOST($register_html);

$usernameErrMsg = usernameValidity($username);
if ($usernameErrMsg != null){
    echo $usernameErrMsg;
}

$passwordErrMsg = passwordValidity($password);
if ($passwordErrMsg != null){
    echo $passwordErrMsg;
}

if (($usernameErrMsg and $passwordErrMsg) == null){
    register($username,$password,$birthdate,$gender,$country,$occupation);
}
