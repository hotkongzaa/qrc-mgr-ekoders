/*
Navicat MySQL Data Transfer

Source Server         : MySQLConnection
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : osbuilding_db

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2015-01-11 12:29:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `project_owner`
-- ----------------------------
DROP TABLE IF EXISTS `project_owner`;
CREATE TABLE `project_owner` (
  `project_owner_id` varchar(10) NOT NULL default '',
  `project_owner_name` varchar(100) default NULL,
  PRIMARY KEY  (`project_owner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_owner
-- ----------------------------
INSERT INTO `project_owner` VALUES ('20001', 'Sansiri');
INSERT INTO `project_owner` VALUES ('20002', 'Land & House');
INSERT INTO `project_owner` VALUES ('20003', 'Quality House');
INSERT INTO `project_owner` VALUES ('20004', 'Pruksa');
INSERT INTO `project_owner` VALUES ('20005', 'Individual');

-- ----------------------------
-- Table structure for `project_status`
-- ----------------------------
DROP TABLE IF EXISTS `project_status`;
CREATE TABLE `project_status` (
  `project_status_id` varchar(10) NOT NULL default '',
  `project_status_name` varchar(100) default NULL,
  PRIMARY KEY  (`project_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_status
-- ----------------------------
INSERT INTO `project_status` VALUES ('30001', 'Active');
INSERT INTO `project_status` VALUES ('30002', 'Close');

-- ----------------------------
-- Table structure for `project_type`
-- ----------------------------
DROP TABLE IF EXISTS `project_type`;
CREATE TABLE `project_type` (
  `project_type_id` varchar(10) NOT NULL,
  `project_type_name` varchar(50) default NULL,
  PRIMARY KEY  (`project_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_type
-- ----------------------------
INSERT INTO `project_type` VALUES ('10001', 'D (Direct)');
INSERT INTO `project_type` VALUES ('10002', 'C (Company)');

-- ----------------------------
-- Table structure for `qrc_assign_order`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_assign_order`;
CREATE TABLE `qrc_assign_order` (
  `ASSIGN_ID` varchar(100) NOT NULL default '',
  `WO_ID` varchar(100) default NULL,
  `PROJECT_ID` varchar(100) default NULL,
  `TEAM_CODE` varchar(100) default NULL,
  `ASSIGN_DATE` datetime default NULL,
  `TARGET_DATE` varchar(100) default NULL,
  `REMARK` varchar(255) default NULL,
  PRIMARY KEY  (`ASSIGN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_assign_status`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_assign_status`;
CREATE TABLE `qrc_assign_status` (
  `A_S_ID` varchar(100) NOT NULL default '',
  `A_S_NAME` varchar(100) default NULL,
  PRIMARY KEY  (`A_S_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_assign_status
-- ----------------------------
INSERT INTO `qrc_assign_status` VALUES ('80001', 'New');
INSERT INTO `qrc_assign_status` VALUES ('80002', 'Assign');
INSERT INTO `qrc_assign_status` VALUES ('80003', 'Pending');
INSERT INTO `qrc_assign_status` VALUES ('80004', 'Cancel');
INSERT INTO `qrc_assign_status` VALUES ('80005', 'Complete');
INSERT INTO `qrc_assign_status` VALUES ('80006', 'Close');

-- ----------------------------
-- Table structure for `qrc_customer_name`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_customer_name`;
CREATE TABLE `qrc_customer_name` (
  `customer_id` varchar(10) NOT NULL default '',
  `customer_name` varchar(100) default NULL,
  `customer_address` varchar(100) default NULL,
  `customer_tel` varchar(100) default NULL,
  `customer_fax` varchar(100) default NULL,
  PRIMARY KEY  (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_inspection`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_inspection`;
CREATE TABLE `qrc_inspection` (
  `INS_ID` varchar(100) NOT NULL default '',
  `INS_PROJECT_CODE` varchar(10) default NULL,
  `INS_DOCUMENT_NO` varchar(100) default NULL,
  `INS_INSPECTION_NO` varchar(100) default NULL,
  `INS_DATE` date default NULL,
  `INS_ORDER_TYPE` varchar(100) default NULL,
  `INS_REMARK` varchar(255) default NULL,
  `INS_IMAGE_PATH` varchar(255) default NULL,
  `INS_CREATED_DATE_TIME` datetime default NULL,
  PRIMARY KEY  (`INS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `qrc_inspection_image`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_inspection_image`;
CREATE TABLE `qrc_inspection_image` (
  `IMAGE_ID` varchar(100) NOT NULL default '',
  `TEMP_INS_ID` varchar(100) default NULL,
  `IMAGE_PATH` varchar(255) default NULL,
  PRIMARY KEY  (`IMAGE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_inspection_image
-- ----------------------------

-- ----------------------------
-- Table structure for `qrc_invoice`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_invoice`;
CREATE TABLE `qrc_invoice` (
  `inv_id` varchar(100) NOT NULL default '',
  `customer_id` varchar(100) default NULL,
  `project_id` varchar(100) default NULL,
  `wo_status_id` varchar(100) default NULL,
  `order_type` varchar(100) default NULL,
  `create_type` varchar(100) default NULL,
  `invoice_status` varchar(100) default NULL,
  `create_receipt` varchar(100) default NULL,
  `create_progressive` varchar(100) default NULL,
  `create_date_time` datetime default NULL,
  PRIMARY KEY  (`inv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_invoice
-- ----------------------------

-- ----------------------------
-- Table structure for `qrc_invoice_detail`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_invoice_detail`;
CREATE TABLE `qrc_invoice_detail` (
  `detail_id` varchar(100) NOT NULL,
  `detail_description` varchar(100) default NULL,
  `detail_quantity` varchar(100) default NULL,
  `detail_unit` varchar(100) default NULL,
  `detail_price_per_unit` varchar(100) default NULL,
  `detail_amount_baht` varchar(100) default NULL,
  `detail_type` varchar(100) default NULL,
  `ref_invoice_id` varchar(100) default NULL,
  `ref_po_project` varchar(100) default NULL,
  `ref_project_order_id` varchar(100) default NULL,
  `ref_invoice_main_id` varchar(100) default NULL,
  `create_date_time` datetime default NULL,
  PRIMARY KEY  (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_invoice_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `qrc_invoice_detail_tmp`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_invoice_detail_tmp`;
CREATE TABLE `qrc_invoice_detail_tmp` (
  `detail_id` varchar(100) NOT NULL,
  `detail_description` varchar(100) default NULL,
  `detail_quantity` varchar(100) default NULL,
  `detail_unit` varchar(100) default NULL,
  `detail_price_per_unit` varchar(100) default NULL,
  `detail_amount_baht` varchar(100) default NULL,
  `detail_type` varchar(100) default NULL,
  `ref_invoice_id` varchar(100) default NULL,
  `ref_po_project` varchar(100) default NULL,
  `ref_project_order_id` varchar(100) default NULL,
  `ref_invoice_main_id` varchar(100) default NULL,
  `create_date_time` datetime default NULL,
  PRIMARY KEY  (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_invoice_status`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_invoice_status`;
CREATE TABLE `qrc_invoice_status` (
  `inv_staus_id` varchar(100) NOT NULL default '',
  `inv_staus_name` varchar(100) default NULL,
  PRIMARY KEY  (`inv_staus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_invoice_status
-- ----------------------------
INSERT INTO `qrc_invoice_status` VALUES ('44001', 'New');
INSERT INTO `qrc_invoice_status` VALUES ('44002', 'Open');
INSERT INTO `qrc_invoice_status` VALUES ('44003', 'Pending');
INSERT INTO `qrc_invoice_status` VALUES ('44004', 'In progress');
INSERT INTO `qrc_invoice_status` VALUES ('44005', 'Closed');

-- ----------------------------
-- Table structure for `qrc_members`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_members`;
CREATE TABLE `qrc_members` (
  `memID` varchar(10) NOT NULL default '',
  `memName` varchar(255) default NULL,
  `memRole` varchar(10) default NULL,
  `memTCode` varchar(10) default NULL,
  `memTName` varchar(200) default NULL,
  `memTel` varchar(50) default NULL,
  `memSkill` varchar(255) default NULL,
  `memEmail` varchar(100) default NULL,
  `memRemark` varchar(255) default NULL,
  `created_date_time` varchar(255) default NULL,
  PRIMARY KEY  (`memID`),
  KEY `MemberTCode` (`memTCode`),
  KEY `MemberMemRole` (`memRole`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `qrc_member_role`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_member_role`;
CREATE TABLE `qrc_member_role` (
  `role_id` varchar(10) NOT NULL default '',
  `role_name` varchar(100) default NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_member_role
-- ----------------------------
INSERT INTO `qrc_member_role` VALUES ('60001', 'Quality Inspector');
INSERT INTO `qrc_member_role` VALUES ('60002', 'Quality Controller');
INSERT INTO `qrc_member_role` VALUES ('60003', 'Team Manager');
INSERT INTO `qrc_member_role` VALUES ('60004', 'Team Leader');
INSERT INTO `qrc_member_role` VALUES ('60005', 'Supervisor');
INSERT INTO `qrc_member_role` VALUES ('60006', 'Builder');

-- ----------------------------
-- Table structure for `qrc_pgs_detail`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_pgs_detail`;
CREATE TABLE `qrc_pgs_detail` (
  `PGS_ID` varchar(100) NOT NULL,
  `PGS_description` varchar(100) default NULL,
  `PGS_quantity` varchar(100) default NULL,
  `PGS_unit` varchar(100) default NULL,
  `PGS_price_per_unit` varchar(100) default NULL,
  `PGS_amount_baht` varchar(100) default NULL,
  `PGS_type` varchar(100) default NULL,
  `ref_invoice_id` varchar(100) default NULL,
  `ref_po_project` varchar(100) default NULL,
  `ref_project_order_id` varchar(100) default NULL,
  `ref_invoice_main_id` varchar(100) default NULL,
  `create_date_time` datetime default NULL,
  PRIMARY KEY  (`PGS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `qrc_po`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_po`;
CREATE TABLE `qrc_po` (
  `PO_ID` varchar(100) NOT NULL default '',
  `PO_PROJECT_NAME` varchar(100) default NULL,
  `PO_PROJECT_CODE` varchar(10) default NULL,
  `PO_DOCUMENT_NO` varchar(100) default NULL,
  `PO_PO_NO` varchar(100) default NULL,
  `PO_HOME_PLAN` varchar(100) default NULL,
  `PO_HOME_PLOT` varchar(100) default NULL,
  `PO_OWNER` varchar(100) default NULL,
  `PO_SENDER` varchar(100) default NULL,
  `PO_ISSUE_DATE` date default NULL,
  `PO_ORDER_TYPE_ID` varchar(10) default NULL,
  `PO_QUANTITY` varchar(100) default NULL,
  `PO_PLAN_SIZE` varchar(100) default NULL,
  `PO_UNIT_PRICE` varchar(100) default NULL,
  `PO_AMOUNT` varchar(100) default NULL,
  `PO_VAT` varchar(100) default NULL,
  `PO_FILE_PATH` varchar(200) default NULL,
  `PO_PROJECT_MANAGER_ID` varchar(100) default NULL,
  `PO_PROJECT_FOREMAN_ID` varchar(100) default NULL,
  `PO_SUPERVISOR_ID` varchar(100) default NULL,
  `PO_CREATED_DATE_TIME` datetime default NULL,
  `PO_REMARK` varchar(255) default NULL,
  `PO_NAME` varchar(255) default NULL,
  `PO_RETENTION` varchar(255) default NULL,
  `PO_RETENTION_REASON` varchar(255) default NULL,
  `PO_STATUS` varchar(100) default NULL,
  PRIMARY KEY  (`PO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `qrc_po_image`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_po_image`;
CREATE TABLE `qrc_po_image` (
  `IMAGE_ID` varchar(100) NOT NULL default '',
  `TEMP_PO_ID` varchar(100) default NULL,
  `IMAGE_PATH` varchar(255) default NULL,
  PRIMARY KEY  (`IMAGE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `qrc_project`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_project`;
CREATE TABLE `qrc_project` (
  `project_code` varchar(20) NOT NULL default '',
  `project_name` varchar(100) default NULL,
  `project_status` varchar(10) default NULL,
  `project_owner` varchar(100) default NULL,
  `project_type` varchar(10) default NULL,
  `customer_id` varchar(10) default NULL,
  `project_manager` varchar(100) default NULL,
  `project_foreman` varchar(250) default NULL,
  `supervisor_control` varchar(250) default NULL,
  `team_owner` varchar(10) default NULL,
  `quality_inspectors` varchar(100) default NULL,
  `address_location` varchar(255) default NULL,
  `created_date_time` varchar(100) default NULL,
  `project_remark` varchar(250) default NULL,
  `updated_date_time` varchar(100) default NULL,
  PRIMARY KEY  (`project_code`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_project_image`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_project_image`;
CREATE TABLE `qrc_project_image` (
  `IMAGE_ID` varchar(100) NOT NULL default '',
  `TEMP_PROJECT_ID` varchar(100) default NULL,
  `IMAGE_PATH` varchar(255) default NULL,
  PRIMARY KEY  (`IMAGE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_project_order`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_project_order`;
CREATE TABLE `qrc_project_order` (
  `project_order_id` varchar(100) NOT NULL default '',
  `project_order_name` varchar(100) default NULL,
  `project_code` varchar(10) default NULL,
  `project_order_plan` varchar(100) default NULL,
  `project_order_plot` varchar(100) default NULL,
  `document_no` varchar(100) default NULL,
  `po_no` varchar(100) default NULL,
  `po_owner` varchar(100) default NULL,
  `po_sender` varchar(100) default NULL,
  `created_date_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `order_type` varchar(10) default NULL,
  `plan_size` varchar(50) default NULL,
  `unit_price` varchar(50) default NULL,
  `amount` varchar(50) default NULL,
  `include_vat` varchar(50) default NULL,
  `image_name` varchar(250) default NULL,
  `project_status` varchar(50) default NULL,
  `updated_date_time` varchar(100) default NULL,
  `remark` varchar(255) default NULL,
  `assign_id` varchar(100) default NULL,
  `po_inspection_id` varchar(100) default NULL,
  `INV_REP_PGS_ID` varchar(100) default NULL,
  `INV_REP_PGS_STATUS_ID` varchar(100) default NULL,
  `WO_ORDER_TYPE` varchar(100) default NULL,
  `WO_PRICE` varchar(100) default NULL,
  `WO_PERC_OF_PO` varchar(100) default NULL,
  `WO_RETENTION` varchar(100) default NULL,
  `WO_RETENTION_REASON` varchar(255) default NULL,
  `COMPLETE_DATE` varchar(100) default NULL,
  `REAL_WO_PRICE` varchar(100) default NULL,
  PRIMARY KEY  (`project_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_project_order_type`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_project_order_type`;
CREATE TABLE `qrc_project_order_type` (
  `order_type_id` varchar(20) NOT NULL default '',
  `order_type_name` varchar(100) default NULL,
  PRIMARY KEY  (`order_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_project_order_type
-- ----------------------------
INSERT INTO `qrc_project_order_type` VALUES ('7001', 'โครงหลังคา');
INSERT INTO `qrc_project_order_type` VALUES ('7002', 'เชิงชาย');
INSERT INTO `qrc_project_order_type` VALUES ('7003', 'มุงหลังคา');
INSERT INTO `qrc_project_order_type` VALUES ('7004', 'อะเส');

-- ----------------------------
-- Table structure for `qrc_receipt`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_receipt`;
CREATE TABLE `qrc_receipt` (
  `inv_id` varchar(100) NOT NULL default '',
  `customer_id` varchar(100) default NULL,
  `project_id` varchar(100) default NULL,
  `wo_status_id` varchar(100) default NULL,
  `order_type` varchar(100) default NULL,
  `create_type` varchar(100) default NULL,
  `invoice_status` varchar(100) default NULL,
  `create_receipt` varchar(100) default NULL,
  `create_progressive` varchar(100) default NULL,
  `create_date_time` datetime default NULL,
  PRIMARY KEY  (`inv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_receipt
-- ----------------------------

-- ----------------------------
-- Table structure for `qrc_skill_attr`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_skill_attr`;
CREATE TABLE `qrc_skill_attr` (
  `ATTR_ID` varchar(100) NOT NULL default '',
  `M_T_REF_ID` varchar(10) default NULL,
  `SKILL_ID` varchar(100) default NULL,
  PRIMARY KEY  (`ATTR_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_team_builder`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_team_builder`;
CREATE TABLE `qrc_team_builder` (
  `tCode` varchar(10) NOT NULL default '',
  `tName` varchar(200) default NULL,
  `tLead_memid` varchar(10) default NULL,
  `tType` varchar(10) default NULL,
  `tManager_memid` varchar(10) default NULL,
  `tSkill` varchar(255) default NULL,
  `tRemark` varchar(255) default NULL,
  `created_date_time` varchar(255) default NULL,
  PRIMARY KEY  (`tCode`),
  KEY `MemberTLead_memid` (`tLead_memid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_team_mapping`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_team_mapping`;
CREATE TABLE `qrc_team_mapping` (
  `ID` varchar(100) NOT NULL default '',
  `TEAM_ID` varchar(100) default NULL,
  `MEMBER_ID` varchar(100) default NULL,
  `MAPPING_DATE` varchar(100) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `qrc_type_of_service`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_type_of_service`;
CREATE TABLE `qrc_type_of_service` (
  `service_id` varchar(50) NOT NULL,
  `service_name` varchar(100) default NULL,
  PRIMARY KEY  (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_type_of_service
-- ----------------------------
INSERT INTO `qrc_type_of_service` VALUES ('50001', 'โครงหลังคา');
INSERT INTO `qrc_type_of_service` VALUES ('50002', 'อะเส');
INSERT INTO `qrc_type_of_service` VALUES ('50003', 'เชิงชาย');
INSERT INTO `qrc_type_of_service` VALUES ('50004', 'หลังคา');

-- ----------------------------
-- Table structure for `qrc_users`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_users`;
CREATE TABLE `qrc_users` (
  `id` varchar(10) NOT NULL,
  `username` varchar(30) default NULL,
  `password` varchar(255) default NULL,
  `fName` varchar(50) default NULL,
  `lName` varchar(50) default NULL,
  `email` varchar(100) default NULL,
  `gender` varchar(10) default NULL,
  `age` varchar(10) default NULL,
  `dob` date default NULL,
  `permission_id` varchar(10) default NULL,
  PRIMARY KEY  (`id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_users
-- ----------------------------
INSERT INTO `qrc_users` VALUES ('1', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 'AdministratorFName', 'AdministratorLName', 'mail@mail.com', 'male', '55', '2014-04-30', '999999');

-- ----------------------------
-- Table structure for `qrc_user_permission`
-- ----------------------------
DROP TABLE IF EXISTS `qrc_user_permission`;
CREATE TABLE `qrc_user_permission` (
  `permission_id` varchar(10) NOT NULL default '',
  `permission_name` varchar(50) default NULL,
  PRIMARY KEY  (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrc_user_permission
-- ----------------------------
INSERT INTO `qrc_user_permission` VALUES ('999999', 'Administrator');
INSERT INTO `qrc_user_permission` VALUES ('111111', 'User Owner');
