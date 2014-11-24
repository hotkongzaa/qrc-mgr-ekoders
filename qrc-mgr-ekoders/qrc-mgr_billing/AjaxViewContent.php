<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo '<script type="text/javascript">var r=confirm("Session expire (30 mins)!"); if(r==true){window.location.href="../index.php";}else{window.location.href="index.php";}</script>';
    } else {
        require '../model-db-connection/config.php';
        $config = require '../model-db-connection/qrc_conf.properties.php';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo '<div class="well no-padding no-border-bottom no-margin-bottom">';
        echo '<ul class="lists">';
        echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $_GET['inv_id'] . '",' . $_GET['customer_id'] . ',"Copy")><i class = "fa fa-download"></i> Download Invoice Copy</a></li>';
        echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $_GET['inv_id'] . '",' . $_GET['customer_id'] . ',"Original")><i class = "fa fa-download"></i> Download Invoice Original</a></li>';
        echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $_GET['create_receipt'] . '",' . $_GET['customer_id'] . ',"Copy")><i class = "fa fa-download"></i> Download Receipt Copy</a></li>';
        echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $_GET['create_receipt'] . '",' . $_GET['customer_id'] . ',"Original")><i class = "fa fa-download"></i> Download Receipt Original</a></li>';
        echo '<li><a href = "#" class="btn-xs" onclick=generateProgressive("' . $_GET['inv_id'] . '",' . $_GET['customer_id'] . ',"Copy")><i class = "fa fa-download"></i> Download progressive Copy</a></li>';
        echo '<li><a href = "#" class="btn-xs" onclick=generateProgressive("' . $_GET['inv_id'] . '",' . $_GET['customer_id'] . ',"Original")><i class = "fa fa-download"></i> Download progressive Original</a></li>';

        echo '</ul>';
        echo '</div>';
        ?>
    </body>
</html>
