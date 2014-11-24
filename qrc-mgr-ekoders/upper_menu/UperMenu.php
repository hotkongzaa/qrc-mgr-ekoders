<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo '<script type="text/javascript">var r=confirm("Session expire (30 mins)!"); if(r==true){window.location.href="../index.php";}else{window.location.href="../index.php";}</script>';
    } else {
        require '../model-db-connection/config.php';
        $config = require '../model-db-connection/qrc_conf.properties.php';
    }
}
?>
<div class = "col-lg-3 col-sm-4">
    <a href = "../qrc-mgr_project/project-index.php" id="upper_menu_project" class = "tile-button btn btn-primary">
        <div class = "tile-content-wrapper">
            <i class = "fa fa-comments"></i>
            <div class = "tile-content">
                <?php
                $sqlCountProject = "SELECT count(*) as count_project FROM QRC_PROJECT ";
                $queryGetCountProject = mysql_query($sqlCountProject);
                while ($rowproject = mysql_fetch_assoc($queryGetCountProject)) {
                    echo '<div class="huge">' . $rowproject['count_project'] . '</div>';
                }
                ?>                        
            </div>
            <small>
                Projects
            </small>
        </div>
    </a>												
</div>

<div class="col-lg-3 col-sm-4">
    <a href="../qrc-mgr_po/po-index.php" class="tile-button btn btn-white">
        <div class="tile-content-wrapper">
            <i class="fa fa-shopping-cart"></i>
            <div class="tile-content">
                <?php
                $sqlCountPO = "SELECT count(*) as count_po FROM QRC_PO";
                $sqlCountInspection = "SELECT count(*) as count_inspec FROM QRC_INSPECTION";
                $queryGetCountPO = mysql_query($sqlCountPO);
                $queryGetCountInspec = mysql_query($sqlCountInspection);
                while ($rowPO = mysql_fetch_assoc($queryGetCountPO)) {
                    while ($rowInspec = mysql_fetch_assoc($queryGetCountInspec)) {
                        echo '<div class="huge">' . $rowPO['count_po'] . '/' . $rowInspec['count_inspec'] . ' </div>';
                    }
                }
                ?>
            </div>
            <small>
                PO/Inspection
            </small>												
        </div>
    </a>												
</div>

<div class="col-lg-3 col-sm-4">
    <a href="../qrc-mgr_assign/assign-index.php" class="tile-button btn btn-primary">
        <div class="tile-content-wrapper">
            <i class="fa fa-tasks fa-5x"></i>
            <div class="tile-content">
                <?php
                $sqlCountProject = "SELECT count(*) as count_assign FROM QRC_PROJECT_ORDER ";
                $queryGetCountProject = mysql_query($sqlCountProject);
                while ($rowproject = mysql_fetch_assoc($queryGetCountProject)) {
                    echo '<div class="huge">' . $rowproject['count_assign'] . '</div>';
                }
                ?>
            </div>
            <small>
                Work Order
            </small>												
        </div>
    </a>												
</div>

<div class="col-lg-3 col-sm-4">
    <a href="../qrc-mgr_team/team-index.php" class="tile-button btn btn-white">
        <div class="tile-content-wrapper">
            <i class="fa fa-warning text-primary"></i>
            <div class="tile-content text-primary">
                <?php
                $sqlCountBuilder = "SELECT count(*) as count_builder FROM QRC_TEAM_BUILDER ";
                $sqlCountTeam = "SELECT count(*) as count_member FROM QRC_MEMBERS ";
                $queryGetCountBuilder = mysql_query($sqlCountBuilder);
                $queryGetCountMembers = mysql_query($sqlCountTeam);
                while ($rowBuilder = mysql_fetch_assoc($queryGetCountBuilder)) {
                    while ($rowMember = mysql_fetch_assoc($queryGetCountMembers)) {
                        echo '<div class="huge">' . $rowBuilder['count_builder'] . '/' . $rowMember['count_member'] . '</div>';
                    }
                }
                ?>
            </div>
            <small>
                Team(s)/Member(s)
            </small>
        </div>
    </a>												
</div>
