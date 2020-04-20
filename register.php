<?php

// Include configuration file
require_once "register_function.php";

$register_html = "./register.html";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

//  Validate if request is POST
//  arg is redirect location
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
    register($username,$password);
}
