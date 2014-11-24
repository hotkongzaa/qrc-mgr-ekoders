<?php

$config_properties = require 'qrc_conf.properties.php';
//Try to connect domain with username and password
$con = mysqli_connect($config_properties['domain'], $config_properties['username'], $config_properties['password']);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS " . $config_properties['databasename'];
if (mysqli_query($con, $sql)) {
    //Create all table when the program start    
    $con_create_tbl = mysqli_connect($config_properties['domain'], $config_properties['username'], $config_properties['password'], $config_properties['databasename']);
    mysqli_set_charset($con_create_tbl, "utf8");

    $sqlCreatePGSDetail = "CREATE TABLE IF NOT EXISTS QRC_PGS_DETAIL ("
            . "PGS_ID varchar(100) NOT NULL,"
            . "PGS_description varchar(100),"
            . "PGS_quantity varchar(100),"
            . "PGS_unit varchar(100),"
            . "PGS_price_per_unit varchar(100),"
            . "PGS_amount_baht varchar(100),"
            . "PGS_type varchar(100),"
            . "ref_invoice_id varchar(100),"
            . "ref_po_project varchar(100),"
            . "ref_project_order_id varchar(100),"
            . "ref_invoice_main_id varchar(100),"
            . "create_date_time datetime,"
            . "PRIMARY KEY (PGS_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreatePGSDetail);

    $sqlCreateREPTbl = "CREATE TABLE IF NOT EXISTS QRC_RECEIPT ("
            . "inv_id VARCHAR(100),"
            . "customer_id VARCHAR(100),"
            . "project_id VARCHAR(100),"
            . "wo_status_id VARCHAR(100),"
            . "order_type VARCHAR(100),"
            . "create_type VARCHAR(100),"
            . "invoice_status VARCHAR(100),"
            . "create_receipt VARCHAR(100),"
            . "create_progressive VARCHAR(100),"
            . "create_date_time datetime,"
            . "PRIMARY KEY (inv_id)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateREPTbl);

    $sqlCreateINVTbl = "CREATE TABLE IF NOT EXISTS QRC_INVOICE ("
            . "inv_id VARCHAR(100),"
            . "customer_id VARCHAR(100),"
            . "project_id VARCHAR(100),"
            . "wo_status_id VARCHAR(100),"
            . "order_type VARCHAR(100),"
            . "create_type VARCHAR(100),"
            . "invoice_status VARCHAR(100),"
            . "create_receipt VARCHAR(100),"
            . "create_progressive VARCHAR(100),"
            . "create_date_time datetime,"
            . "PRIMARY KEY (inv_id)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateINVTbl);

    $sqlCreateINVDetailTblTmp = "CREATE TABLE IF NOT EXISTS QRC_INVOICE_DETAIL_TMP ("
            . "detail_id varchar(100) NOT NULL,"
            . "detail_description varchar(100),"
            . "detail_quantity varchar(100),"
            . "detail_unit varchar(100),"
            . "detail_price_per_unit varchar(100),"
            . "detail_amount_baht varchar(100),"
            . "detail_type varchar(100),"
            . "ref_invoice_id varchar(100),"
            . "ref_po_project varchar(100),"
            . "ref_project_order_id varchar(100),"
            . "ref_invoice_main_id varchar(100),"
            . "create_date_time datetime,"
            . "PRIMARY KEY (detail_id)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateINVDetailTblTmp);

    $sqlCreateINVDetailTbl = "CREATE TABLE IF NOT EXISTS QRC_INVOICE_DETAIL ("
            . "detail_id varchar(100) NOT NULL,"
            . "detail_description varchar(100),"
            . "detail_quantity varchar(100),"
            . "detail_unit varchar(100),"
            . "detail_price_per_unit varchar(100),"
            . "detail_amount_baht varchar(100),"
            . "detail_type varchar(100),"
            . "ref_invoice_id varchar(100),"
            . "ref_po_project varchar(100),"
            . "ref_project_order_id varchar(100),"
            . "ref_invoice_main_id varchar(100),"
            . "create_date_time datetime,"
            . "PRIMARY KEY (detail_id)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateINVDetailTbl);

    $sqlCreateINVStatusTbl = "CREATE TABLE IF NOT EXISTS QRC_INVOICE_STATUS ("
            . "inv_staus_id VARCHAR(100),"
            . "inv_staus_name VARCHAR(100),"
            . "PRIMARY KEY (inv_staus_id)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateINVStatusTbl);


    $sqlCreateINSStatusTbl = "CREATE TABLE IF NOT EXISTS QRC_ASSIGN_STATUS ("
            . "A_S_ID VARCHAR(100),"
            . "A_S_NAME VARCHAR(100),"
            . "PRIMARY KEY (A_S_ID)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateINSStatusTbl);

    $sqlCreateINSImageTbl = "CREATE TABLE IF NOT EXISTS QRC_INSPECTION_IMAGE ("
            . "IMAGE_ID VARCHAR(100),"
            . "TEMP_INS_ID VARCHAR(100),"
            . "IMAGE_PATH VARCHAR(255),"
            . "PRIMARY KEY (IMAGE_ID)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateINSImageTbl);

    $sqlCreateTblInspection = "CREATE TABLE IF NOT EXISTS QRC_INSPECTION ("
            . "INS_ID VARCHAR(100),"
            . "INS_PROJECT_CODE VARCHAR(10),"
            . "INS_DOCUMENT_NO VARCHAR(100),"
            . "INS_INSPECTION_NO VARCHAR(100),"
            . "INS_DATE DATE,"
            . "INS_ORDER_TYPE VARCHAR(100),"
            . "INS_REMARK VARCHAR(255),"
            . "INS_IMAGE_PATH VARCHAR(255),"
            . "INS_CREATED_DATE_TIME DATETIME,"
            . "PRIMARY KEY (INS_ID)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblInspection);
    $sqlCreateTblAssignWorkOrder = "CREATE TABLE IF NOT EXISTS QRC_ASSIGN_ORDER ("
            . "ASSIGN_ID VARCHAR(100),"
            . "WO_ID VARCHAR(100),"
            . "PROJECT_ID VARCHAR(100),"
            . "TEAM_CODE VARCHAR(100),"
            . "ASSIGN_DATE DATETIME,"
            . "TARGET_DATE VARCHAR(100),"
            . "REMARK VARCHAR(255),"
            . "PRIMARY KEY (ASSIGN_ID)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblAssignWorkOrder);
    $sqlCreatePOImageTbl = "CREATE TABLE IF NOT EXISTS QRC_PO_IMAGE ("
            . "IMAGE_ID VARCHAR(100),"
            . "TEMP_PO_ID VARCHAR(100),"
            . "IMAGE_PATH VARCHAR(255),"
            . "PRIMARY KEY (IMAGE_ID)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreatePOImageTbl);
    $sqlCreateTblPO = "CREATE TABLE IF NOT EXISTS QRC_PO ("
            . "PO_ID VARCHAR(100),"
            . "PO_PROJECT_NAME VARCHAR(100),"
            . "PO_PROJECT_CODE VARCHAR(10),"
            . "PO_DOCUMENT_NO VARCHAR(100),"
            . "PO_PO_NO VARCHAR(100),"
            . "PO_HOME_PLAN VARCHAR(100),"
            . "PO_HOME_PLOT VARCHAR(100),"
            . "PO_OWNER VARCHAR(100),"
            . "PO_SENDER VARCHAR(100),"
            . "PO_ISSUE_DATE DATE,"
            . "PO_ORDER_TYPE_ID VARCHAR(10),"
            . "PO_QUANTITY VARCHAR(100),"
            . "PO_PLAN_SIZE VARCHAR(100),"
            . "PO_UNIT_PRICE VARCHAR(100),"
            . "PO_AMOUNT VARCHAR(100),"
            . "PO_VAT VARCHAR(100),"
            . "PO_FILE_PATH VARCHAR(200),"
            . "PO_PROJECT_MANAGER_ID VARCHAR(100),"
            . "PO_PROJECT_FOREMAN_ID VARCHAR(100),"
            . "PO_SUPERVISOR_ID VARCHAR(100),"
            . "PO_CREATED_DATE_TIME DATETIME,"
            . "PO_REMARK VARCHAR(255),"
            . "PO_NAME VARCHAR(255),"
            . "PO_RETENTION VARCHAR(255),"
            . "PO_RETENTION_REASON VARCHAR(255),"
            . "PO_STATUS VARCHAR(100),"
            . "PRIMARY KEY (PO_ID)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblPO);
    $sqlCreateTblMemerMapping = "CREATE TABLE IF NOT EXISTS QRC_TEAM_MAPPING ("
            . "ID VARCHAR(100),"
            . "TEAM_ID VARCHAR(100),"
            . "MEMBER_ID VARCHAR(100),"
            . "MAPPING_DATE VARCHAR(100),"
            . "PRIMARY KEY (ID)"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblMemerMapping);
    $sqlCreateTblSkillAttr = "CREATE TABLE IF NOT EXISTS QRC_SKILL_ATTR ("
            . "ATTR_ID VARCHAR(100),"
            . "M_T_REF_ID VARCHAR(10),"
            . "SKILL_ID VARCHAR(100),"
            . "PRIMARY KEY (ATTR_ID)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblSkillAttr);
    $sqlCreateTblMember = "CREATE TABLE IF NOT EXISTS QRC_MEMBERS ("
            . "memID varchar(10),"
            . "memName varchar(255),"
            . "memRole varchar(10),"
            . "memTCode varchar(10),"
            . "memTName varchar(200),"
            . "memTel varchar(50),"
            . "memSkill varchar(255),"
            . "memEmail varchar(100),"
            . "memRemark varchar(255),"
            . "created_date_time varchar(255),"
            . "PRIMARY KEY (memID)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblMember);
    $sqlCreateTblTeamTbl = "CREATE TABLE IF NOT EXISTS QRC_TEAM_BUILDER ("
            . "tCode varchar(10),"
            . "tName varchar(200),"
            . "tLead_memid varchar(10),"
            . "tType varchar(10),"
            . "tManager_memid varchar(10),"
            . "tSkill varchar(255),"
            . "tRemark varchar(255),"
            . "created_date_time varchar(255),"
            . "PRIMARY KEY (tCode)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblTeamTbl);
    $sqlCreateTblMemberRole = "CREATE TABLE IF NOT EXISTS QRC_MEMBER_ROLE ("
            . "role_id varchar(10),"
            . "role_name varchar(100),"
            . "PRIMARY KEY (role_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTblMemberRole);

//    $sql_insert_member_role_1 = "INSERT INTO QRC_MEMBER_ROLE (role_id,role_name)
//                        SELECT * FROM (SELECT '60001','Quality Inspector') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT role_id FROM QRC_MEMBER_ROLE WHERE role_id = '60001'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_member_role_1);
//    $sql_insert_member_role_2 = "INSERT INTO QRC_MEMBER_ROLE (role_id,role_name)
//                        SELECT * FROM (SELECT '60002','Quality Controller') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT role_id FROM QRC_MEMBER_ROLE WHERE role_id = '60002'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_member_role_2);
//    $sql_insert_member_role_3 = "INSERT INTO QRC_MEMBER_ROLE (role_id,role_name)
//                        SELECT * FROM (SELECT '60003','Team Manager') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT role_id FROM QRC_MEMBER_ROLE WHERE role_id = '60003'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_member_role_3);
//    $sql_insert_member_role_4 = "INSERT INTO QRC_MEMBER_ROLE (role_id,role_name)
//                        SELECT * FROM (SELECT '60004','Team Leader') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT role_id FROM QRC_MEMBER_ROLE WHERE role_id = '60004'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_member_role_4);
//    $sql_insert_member_role_5 = "INSERT INTO QRC_MEMBER_ROLE (role_id,role_name)
//                        SELECT * FROM (SELECT '60005','Supervisor') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT role_id FROM QRC_MEMBER_ROLE WHERE role_id = '60005'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_member_role_5);
//    $sql_insert_member_role_6 = "INSERT INTO QRC_MEMBER_ROLE (role_id,role_name)
//                        SELECT * FROM (SELECT '60006','Builder') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT role_id FROM QRC_MEMBER_ROLE WHERE role_id = '60006'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_member_role_6);

    $sqlCreateTypeOfService = "CREATE TABLE IF NOT EXISTS QRC_TYPE_OF_SERVICE ("
            . "service_id varchar(50) NOT NULL,"
            . "service_name varchar(100),"
            . "PRIMARY KEY  (service_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTypeOfService);

//    $sql_insert_type_of_service_1 = "INSERT INTO QRC_TYPE_OF_SERVICE (service_id,service_name)
//                        SELECT * FROM (SELECT '50001','Truss (โครงหลังคา)') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT service_id FROM QRC_TYPE_OF_SERVICE WHERE service_id = '50001'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_type_of_service_1);
//    $sql_insert_type_of_service_2 = "INSERT INTO QRC_TYPE_OF_SERVICE (service_id,service_name)
//                        SELECT * FROM (SELECT '50002','Tie beam (เชิงชาย)') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT service_id FROM QRC_TYPE_OF_SERVICE WHERE service_id = '50002'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_type_of_service_2);
//    $sql_insert_type_of_service_3 = "INSERT INTO QRC_TYPE_OF_SERVICE (service_id,service_name)
//                        SELECT * FROM (SELECT '50003','Eaves (มุงหลังคา)') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT service_id FROM QRC_TYPE_OF_SERVICE WHERE service_id = '50003'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_type_of_service_3);
//    $sql_insert_type_of_service_4 = "INSERT INTO QRC_TYPE_OF_SERVICE (service_id,service_name)
//                        SELECT * FROM (SELECT '50004','Roof (อะเส)') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT service_id FROM QRC_TYPE_OF_SERVICE WHERE service_id = '50004'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_type_of_service_4);


    $sqlCreateProjectOrder = "CREATE TABLE IF NOT EXISTS QRC_PROJECT_ORDER ("
            . "project_order_id varchar(100),"
            . "project_order_name varchar(100),"
            . "project_code varchar(10),"
            . "project_order_plan varchar(100),"
            . "project_order_plot varchar(100),"
            . "document_no varchar(100),"
            . "po_no varchar(100),"
            . "po_owner varchar(100),"
            . "po_sender varchar(100),"
            . "created_date_time varchar(100),"
            . "order_type varchar(10),"
            . "plan_size varchar(50),"
            . "unit_price varchar(50),"
            . "amount varchar(50),"
            . "include_vat varchar(50),"
            . "image_name varchar(250),"
            . "project_status varchar(50),"
            . "updated_date_time varchar(100),"
            . "remark varchar(255),"
            . "assign_id varchar(100),"
            . "po_inspection_id varchar(100),"
            . "INV_REP_PGS_ID varchar(100),"
            . "INV_REP_PGS_STATUS_ID varchar(100),"
            . "WO_ORDER_TYPE varchar(100),"
            . "WO_PRICE varchar(100),"
            . "WO_PERC_OF_PO varchar(100),"
            . "WO_RETENTION varchar(100),"
            . "WO_RETENTION_REASON varchar(255),"
            . "COMPLETE_DATE varchar(100),"
            . "PRIMARY KEY  (project_order_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateProjectOrder);

    $sqlCreateProjectOrderType = "CREATE TABLE IF NOT EXISTS QRC_PROJECT_ORDER_TYPE ("
            . "order_type_id varchar(20),"
            . "order_type_name varchar(100),"
            . "PRIMARY KEY  (order_type_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateProjectOrderType);
//    $sql_insert_project_order_type1 = "INSERT INTO QRC_PROJECT_ORDER_TYPE (order_type_id,order_type_name)
//                        SELECT * FROM (SELECT '7001','โครงหลังคา') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT order_type_id FROM QRC_PROJECT_ORDER_TYPE WHERE order_type_id = '7001'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, "SET NAMES utf8");
//    mysqli_query($con_create_tbl, $sql_insert_project_order_type1);
//
//
//    $sql_insert_project_order_type2 = "INSERT INTO QRC_PROJECT_ORDER_TYPE (order_type_id,order_type_name)
//                        SELECT * FROM (SELECT '7002','เชิงชาย') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT order_type_id FROM QRC_PROJECT_ORDER_TYPE WHERE order_type_id = '7002'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, "SET NAMES utf8");
//    mysqli_query($con_create_tbl, $sql_insert_project_order_type2);
//
//    $sql_insert_project_order_type3 = "INSERT INTO QRC_PROJECT_ORDER_TYPE (order_type_id,order_type_name)
//                        SELECT * FROM (SELECT '7003','มุงหลังคา') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT order_type_id FROM QRC_PROJECT_ORDER_TYPE WHERE order_type_id = '7003'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, "SET NAMES utf8");
//    mysqli_query($con_create_tbl, $sql_insert_project_order_type3);
//
//    $sql_insert_project_order_type4 = "INSERT INTO QRC_PROJECT_ORDER_TYPE (order_type_id,order_type_name)
//                        SELECT * FROM (SELECT '7004','อะเส') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT order_type_id FROM QRC_PROJECT_ORDER_TYPE WHERE order_type_id = '7004'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, "SET NAMES utf8");
//    mysqli_query($con_create_tbl, $sql_insert_project_order_type4);

    $sqlCreateProjectTable = "CREATE TABLE IF NOT EXISTS QRC_PROJECT ("
            . "project_code varchar(20),"
            . "project_name varchar(100),"
            . "project_status varchar(10),"
            . "project_owner varchar(100),"
            . "project_type varchar(10),"
            . "customer_id varchar(10),"
            . "project_manager varchar(100),"
            . "project_foreman varchar(250),"
            . "supervisor_control varchar(250),"
            . "team_owner varchar(10),"
            . "quality_inspectors varchar(100),"
            . "address_location varchar(255),"
            . "created_date_time varchar(100),"
            . "project_remark varchar(250),"
            . "updated_date_time varchar(100),"
            . "PRIMARY KEY  (project_code),"
            . "FOREIGN KEY (customer_id) REFERENCES QRC_CUSTOMER_NAME(customer_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";

    mysqli_query($con_create_tbl, $sqlCreateProjectTable);

    $sqlCreateCustomerName = "CREATE TABLE IF NOT EXISTS QRC_CUSTOMER_NAME ("
            . "customer_id varchar(10),"
            . "customer_name varchar(100),"
            . "customer_address varchar(100),"
            . "customer_tel varchar(100),"
            . "customer_fax varchar(100),"
            . "PRIMARY KEY  (customer_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateCustomerName);

//    $sql_insert_customer_name_1 = "INSERT INTO QRC_CUSTOMER_NAME (customer_id,customer_name)
//                        SELECT * FROM (SELECT '40001','Diamond') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT customer_id FROM QRC_CUSTOMER_NAME WHERE customer_id = '40001'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_customer_name_1);
//    $sql_insert_customer_name_2 = "INSERT INTO QRC_CUSTOMER_NAME (customer_id,customer_name)
//                        SELECT * FROM (SELECT '40002','SCG') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT customer_id FROM QRC_CUSTOMER_NAME WHERE customer_id = '40002'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_customer_name_2);
//    $sql_insert_customer_name_3 = "INSERT INTO QRC_CUSTOMER_NAME (customer_id,customer_name)
//                        SELECT * FROM (SELECT '40003','Blue Scope') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT customer_id FROM QRC_CUSTOMER_NAME WHERE customer_id = '40003'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_customer_name_3);
//    $sql_insert_customer_name_4 = "INSERT INTO QRC_CUSTOMER_NAME (customer_id,customer_name)
//                        SELECT * FROM (SELECT '40004','Sam Chai') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT customer_id FROM QRC_CUSTOMER_NAME WHERE customer_id = '40004'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_customer_name_4);
//    $sql_insert_customer_name_5 = "INSERT INTO QRC_CUSTOMER_NAME (customer_id,customer_name)
//                        SELECT * FROM (SELECT '40005','M Truss') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT customer_id FROM QRC_CUSTOMER_NAME WHERE customer_id = '40005'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_customer_name_5);
//    $sql_insert_customer_name_6 = "INSERT INTO QRC_CUSTOMER_NAME (customer_id,customer_name)
//                        SELECT * FROM (SELECT '40006','In-House') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT customer_id FROM QRC_CUSTOMER_NAME WHERE customer_id = '40006'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_customer_name_6);



    $sqlCreateProjectStatus = "CREATE TABLE IF NOT EXISTS PROJECT_STATUS ("
            . "project_status_id varchar(10),"
            . "project_status_name varchar(100),"
            . "PRIMARY KEY  (project_status_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateProjectStatus);

//    $sql_insert_project_status_1 = "INSERT INTO PROJECT_STATUS (project_status_id,project_status_name)
//                        SELECT * FROM (SELECT '30001','Active') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_status_id FROM PROJECT_STATUS WHERE project_status_id = '30001'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_status_1);
//    $sql_insert_project_status_2 = "INSERT INTO PROJECT_STATUS (project_status_id,project_status_name)
//                        SELECT * FROM (SELECT '30002','Close') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_status_id FROM PROJECT_STATUS WHERE project_status_id = '30002'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_status_2);


    $sqlCreateProjectOwner = "CREATE TABLE IF NOT EXISTS PROJECT_OWNER ("
            . "project_owner_id varchar(10),"
            . "project_owner_name varchar(100),"
            . "PRIMARY KEY  (project_owner_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateProjectOwner);

//    $sql_insert_project_owner_1 = "INSERT INTO PROJECT_OWNER (project_owner_id,project_owner_name)
//                        SELECT * FROM (SELECT '20001','Sansiri') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_owner_id FROM PROJECT_OWNER WHERE project_owner_id = '20001'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_owner_1);
//    $sql_insert_project_owner_2 = "INSERT INTO PROJECT_OWNER (project_owner_id,project_owner_name)
//                        SELECT * FROM (SELECT '20002','Land & House') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_owner_id FROM PROJECT_OWNER WHERE project_owner_id = '20002'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_owner_2);
//
//    $sql_insert_project_owner_3 = "INSERT INTO PROJECT_OWNER (project_owner_id,project_owner_name)
//                        SELECT * FROM (SELECT '20003','Quality House') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_owner_id FROM PROJECT_OWNER WHERE project_owner_id = '20003'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_owner_3);
//
//    $sql_insert_project_owner_4 = "INSERT INTO PROJECT_OWNER (project_owner_id,project_owner_name)
//                        SELECT * FROM (SELECT '20004','Pruksa') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_owner_id FROM PROJECT_OWNER WHERE project_owner_id = '20004'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_owner_4);
//
//    $sql_insert_project_owner_5 = "INSERT INTO PROJECT_OWNER (project_owner_id,project_owner_name)
//                        SELECT * FROM (SELECT '20005','Individual') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_owner_id FROM PROJECT_OWNER WHERE project_owner_id = '20005'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_owner_5);

    $sqlCreateProjectType = "CREATE TABLE IF NOT EXISTS PROJECT_TYPE ("
            . "project_type_id varchar(10) NOT NULL,"
            . "project_type_name varchar(50),"
            . "PRIMARY KEY  (project_type_id)"
            . ")ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateProjectType);

//    $sql_insert_project_type_1 = "INSERT INTO PROJECT_TYPE (project_type_id,project_type_name)
//                        SELECT * FROM (SELECT '10001','D (Direct)') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_type_id FROM PROJECT_TYPE WHERE project_type_id = '10001'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_type_1);
//    $sql_insert_project_type_2 = "INSERT INTO PROJECT_TYPE (project_type_id,project_type_name)
//                        SELECT * FROM (SELECT '10002','C (Company)') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT project_type_id FROM PROJECT_TYPE WHERE project_type_id = '10002'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_project_type_2);


    $sqlCreateTableUsers = "CREATE TABLE IF NOT EXISTS QRC_USERS (
                            id varchar(10) NOT NULL,
                            username varchar(30),
                            password varchar(255),
                            fName varchar(50),
                            lName varchar(50),
                            email varchar(100) ,
                            gender varchar(10),
                            age varchar(10),
                            dob date,
                            permission_id varchar(10),
                            PRIMARY KEY  (id),
                            FOREIGN KEY (permission_id) REFERENCES QRC_USER_PERMISSION(P_Id)
                            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTableUsers);

//    $sql_insert_user = "INSERT INTO QRC_USERS (id,username, password, fName, lName,email,gender,age,dob,permission_id)
//                        SELECT * FROM (SELECT '1','administrator', '21232f297a57a5a743894a0e4a801fc3', 'AdministratorFName','AdministratorLName','mail@mail.com','male','55','2014-04-30','999999') AS tmp
//                        WHERE NOT EXISTS (
//                            SELECT username FROM QRC_USERS WHERE username = 'administrator'
//                        ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sql_insert_user);

    $sqlCreateTablePermission = "CREATE TABLE IF NOT EXISTS QRC_USER_PERMISSION (
                                 permission_id varchar(10) ,
                                 permission_name varchar(50),
                                 PRIMARY KEY (permission_id)
                                 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
                                ";
    mysqli_query($con_create_tbl, $sqlCreateTablePermission);

//    $sqlInserTablePermission1 = "    INSERT INTO QRC_USER_PERMISSION (permission_id, permission_name)
//SELECT * FROM (SELECT '999999','Administrator') AS tmp
//WHERE NOT EXISTS (
//    SELECT permission_id FROM QRC_USER_PERMISSION WHERE permission_id = '999999'
//) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sqlInserTablePermission1);
//
//    $sqlInsertTablePermission2 = "INSERT INTO QRC_USER_PERMISSION (permission_id, permission_name)
//    SELECT * FROM (SELECT '111111', 'User Owner') AS tmp
//    WHERE NOT EXISTS (
//    SELECT permission_id FROM QRC_USER_PERMISSION WHERE permission_id = '111111'
//    ) LIMIT 1;";
//    mysqli_query($con_create_tbl, $sqlInsertTablePermission2);
} else {
    echo "Error creating database: " . mysqli_error($con);
}