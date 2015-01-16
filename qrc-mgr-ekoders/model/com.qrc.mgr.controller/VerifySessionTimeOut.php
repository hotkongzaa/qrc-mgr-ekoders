<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VerifySessionTimeOut
 *
 * @author krisada.thiangtham
 */
class VerifySessionTimeOut {

    //put your code here
    public function __construct() {
        
    }

    public function verifySession() {
        $_SESSION['expire'] = time() + (10 * 30);
        $_SESSION['username'] = $row['username'];
        $_SESSION['permission_id'] = $row['permission_id'];
    }

    public function updateNewTimeout($newTimeOut) {
        $_SESSION['expire'] = $newTimeOut + (10 * 30);
        $_SESSION['username'] = $row['username'];
        $_SESSION['permission_id'] = $row['permission_id'];
    }

}
