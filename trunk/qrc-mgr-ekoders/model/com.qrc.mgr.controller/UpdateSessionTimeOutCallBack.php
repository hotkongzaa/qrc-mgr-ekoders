<?php

session_start();
require './VerifySessionTimeOut.php';
$verifySessionTimeOut = new VerifySessionTimeOut();
echo $verifySessionTimeOut->updateNewTimeout(time(), $_SESSION['username'], $_SESSION['permission_id']);
