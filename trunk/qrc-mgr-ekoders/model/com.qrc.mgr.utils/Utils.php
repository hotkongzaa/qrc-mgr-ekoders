<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author krisada.thiangtham
 */
class Utils {

    private $resultCallBack;

    public function getResultCallBack() {
        return $this->resultCallBack;
    }

    public function setResultCallBack($inputString, $template, $isDate /* Identify is date or not */) {
        if ($isDate) {
            
        } else {
            if (is_null($inputString) || is_nan($inputString) || $inputString == "null") {
                $strResults = !empty($inputString) ? $template . " '%$inputString%'" : "";
            }
        }
        $this->resultCallBack = $strResults;
    }

    public function rebuildMultiProjectSelect($multi_sel_project_name) {
        $newStrProTmp = "";
        if ($multi_sel_project_name != null || $multi_sel_project_name != "" || $multi_sel_project_name != "null") {
            $projects = explode(",", $multi_sel_project_name);
            if (count($projects) == 1) {
                $newStrProTmp = "'" . $multi_sel_project_name . "'";
            } else {
                for ($i = 0; $i < count($projects); $i++) {
                    if ($i != 0) {
                        $newStrProTmp .= ",'" . $projects[$i] . "'";
                    } else {
                        $newStrProTmp .= "'" . $projects[$i] . "'";
                    }
                }
            }
        }
        return $newStrProTmp;
    }

    public function rebuildWOStatusSelect($wo_status) {
        $newStrWoStatus = "";
        if ($wo_status != "null" || $wo_status != "" || $wo_status != null) {
            $wo_statuss = explode(",", $wo_status);
            if (count($wo_statuss) == 1) {
                $newStrWoStatus = "'" . $wo_status . "'";
            } else {
                for ($i = 0; $i < count($wo_statuss); $i++) {
                    if ($i != 0) {
                        $newStrWoStatus .= ",'" . $wo_statuss[$i] . "'";
                    } else {
                        $newStrWoStatus .= "'" . $wo_statuss[$i] . "'";
                    }
                }
            }
        }
        return $newStrWoStatus;
    }

}
