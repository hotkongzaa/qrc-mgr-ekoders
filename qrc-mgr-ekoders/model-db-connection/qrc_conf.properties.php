<?php

$conf = parse_ini_file("configuration.ini");
/* for local server */
return array(
    'username' => $conf['dataBaseUsername'],
    'password' => $conf['dataBasePassword'],
    'domain' => $conf['dataBaseDomain'],
    'databasename' => $conf['dataBaseName'],
    'connection_error_msg' => 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้',
    'msg_encode' => $conf['dataEncodeing'],
    'root_path' => $conf['applicationRootPath']
);


/* for production server */
//return array(
//    'username' => 'qrccoth_qrcmgr',
//    'password' => 'qrcmgrdb',
//    'domain' => 'localhost',
//    'databasename' => 'qrccoth_qrcmgr',
//    'connection_error_msg' => 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้',
//    'msg_encode' => 'SET NAMES utf8',
//    'root_path' => 'qrc-mgr-ekoders',
//    'application_timeout' => '30'
//);
