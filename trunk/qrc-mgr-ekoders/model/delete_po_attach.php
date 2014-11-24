<?php

require '../model-db-connection/config.php';
$output_dir = "../images/uploads/";
if (isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name'])) {
    $fileName = $_POST['name'];
    $filePath = $output_dir . $fileName;
    if (file_exists($filePath)) {
        unlink($filePath);
        $sqlDelete = "DELETE FROM QRC_PO_IMAGE WHERE IMAGE_PATH like '$fileName';";
        mysql_query($sqlDelete);
    }
    echo "Deleted File " . $fileName . "<br>";
}
?>