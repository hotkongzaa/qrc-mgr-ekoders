<?php

require '../model-db-connection/config.php';
$output_dir = "../images/uploads/";
if (isset($_FILES["myfile"])) {
    $ret = array();

    $error = $_FILES["myfile"]["error"];
    //You need to handle  both cases
    //If Any browser does not support serializing of multiple files using FormData() 
    if (!is_array($_FILES["myfile"]["name"])) { //single file
        $fileName = uniqid() . "_" . $_FILES["myfile"]["name"];
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
        $sqlSaveImage = "INSERT INTO QRC_INSPECTION_IMAGE (IMAGE_ID,TEMP_INS_ID,IMAGE_PATH) VALUES ('" . md5(date('m/d/Y h:i:s a', time()) . "$fileName") . "',NULL,'" . $fileName . "')";
        mysql_query($sqlSaveImage);
        $ret[] = $fileName;
    } else {  //Multiple files, file[]
        $fileCount = count($_FILES["myfile"]["name"]);
        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES["myfile"]["name"][$i];
            move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
            $sqlSaveImage = "INSERT INTO QRC_INSPECTION_IMAGE (IMAGE_ID,TEMP_PO_ID,IMAGE_PATH) VALUES ('" . md5(date('m/d/Y h:i:s a', time())) . $i . "',NULL,'" . $fileName . "')";
            mysql_query($sqlSaveImage);
            $ret[] = $fileName;
        }
    }
    echo json_encode($ret);
}
?>
