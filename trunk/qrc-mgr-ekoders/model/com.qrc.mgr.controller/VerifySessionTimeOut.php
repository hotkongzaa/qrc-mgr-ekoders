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

    public function initiateTimeOut($username, $permission_id) {
        $_SESSION['expire'] = time() + (60 * 30);
        $_SESSION['username'] = $username;
        $_SESSION['permission_id'] = $permission_id;
    }

    public function updateNewTimeout($newTimeOut, $username, $permission_id) {
        $_SESSION['expire'] = $newTimeOut + (60 * 30);
        $_SESSION['username'] = $username;
        $_SESSION['permission_id'] = $permission_id;
        //1=success,0=fail;
        return 'SUCCESS';
    }

    public function checkTimeOut($currentTime) {
        if ($currentTime > $_SESSION['expire']) {
            session_destroy();
            return 'TIMEOUT';
        } else {
            return 'NOT_TIMEOUT';
        }
    }

}
