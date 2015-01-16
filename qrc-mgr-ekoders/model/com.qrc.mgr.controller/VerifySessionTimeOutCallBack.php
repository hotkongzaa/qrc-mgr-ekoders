<?php
session_start();
require './VerifySessionTimeOut.php';
$verifySessionTimeOut = new VerifySessionTimeOut();
echo $verifySessionTimeOut->checkTimeOut(time());
