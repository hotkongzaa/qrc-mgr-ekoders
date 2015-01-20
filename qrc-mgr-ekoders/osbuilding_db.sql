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
-- Table structure for 'PROJECT_OWNER'
-- ----------------------------
DROP TABLE IF EXISTS 'PROJECT_OWNER';
CREATE TABLE 'PROJECT_OWNER' (
  'PROJECT_OWNER_id' VARCHAR(10) NOT NULL DEFAULT '',
  'PROJECT_OWNER_name' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('PROJECT_OWNER_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of PROJECT_OWNER
-- ----------------------------
INSERT INTO 'PROJECT_OWNER' VALUES ('20001', 'Sansiri');
INSERT INTO 'PROJECT_OWNER' VALUES ('20002', 'Land & House');
INSERT INTO 'PROJECT_OWNER' VALUES ('20003', 'Quality House');
INSERT INTO 'PROJECT_OWNER' VALUES ('20004', 'Pruksa');
INSERT INTO 'PROJECT_OWNER' VALUES ('20005', 'Individual');

-- ----------------------------
-- Table structure for 'PROJECT_STATUS'
-- ----------------------------
DROP TABLE IF EXISTS 'PROJECT_STATUS';
CREATE TABLE 'PROJECT_STATUS' (
  'PROJECT_STATUS_id' VARCHAR(10) NOT NULL DEFAULT '',
  'PROJECT_STATUS_name' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('PROJECT_STATUS_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of PROJECT_STATUS
-- ----------------------------
INSERT INTO 'PROJECT_STATUS' VALUES ('30001', 'Active');
INSERT INTO 'PROJECT_STATUS' VALUES ('30002', 'Close');

-- ----------------------------
-- Table structure for 'PROJECT_TYPE'
-- ----------------------------
DROP TABLE IF EXISTS 'PROJECT_TYPE';
CREATE TABLE 'PROJECT_TYPE' (
  'PROJECT_TYPE_id' VARCHAR(10) NOT NULL,
  'PROJECT_TYPE_name' VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY  ('PROJECT_TYPE_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of PROJECT_TYPE
-- ----------------------------
INSERT INTO 'PROJECT_TYPE' VALUES ('10001', 'D (Direct)');
INSERT INTO 'PROJECT_TYPE' VALUES ('10002', 'C (Company)');

-- ----------------------------
-- Table structure for 'QRC_ASSIGN_ORDER'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_ASSIGN_ORDER';
CREATE TABLE 'QRC_ASSIGN_ORDER' (
  'assign_id' VARCHAR(100) NOT NULL DEFAULT '',
  'wo_id' VARCHAR(100) DEFAULT NULL,
  'project_id' VARCHAR(100) DEFAULT NULL,
  'team_code' VARCHAR(100) DEFAULT NULL,
  'assign_date' DATETIME DEFAULT NULL,
  'target_date' VARCHAR(100) DEFAULT NULL,
  'remark' VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  ('assign_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_ASSIGN_STATUS'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_ASSIGN_STATUS';
CREATE TABLE 'QRC_ASSIGN_STATUS' (
  'a_s_id' VARCHAR(100) NOT NULL DEFAULT '',
  'a_s_name' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('a_s_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_ASSIGN_STATUS
-- ----------------------------
INSERT INTO 'QRC_ASSIGN_STATUS' VALUES ('80001', 'New');
INSERT INTO 'QRC_ASSIGN_STATUS' VALUES ('80002', 'Assign');
INSERT INTO 'QRC_ASSIGN_STATUS' VALUES ('80003', 'Pending');
INSERT INTO 'QRC_ASSIGN_STATUS' VALUES ('80004', 'Cancel');
INSERT INTO 'QRC_ASSIGN_STATUS' VALUES ('80005', 'Complete');
INSERT INTO 'QRC_ASSIGN_STATUS' VALUES ('80006', 'Close');

-- ----------------------------
-- Table structure for 'QRC_CUSTOMER_NAME'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_CUSTOMER_NAME';
CREATE TABLE 'QRC_CUSTOMER_NAME' (
  'customer_id' VARCHAR(10) NOT NULL DEFAULT '',
  'customer_name' VARCHAR(100) DEFAULT NULL,
  'customer_address' VARCHAR(100) DEFAULT NULL,
  'customer_tel' VARCHAR(100) DEFAULT NULL,
  'customer_fax' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('customer_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_INSPECTION'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_INSPECTION';
CREATE TABLE 'QRC_INSPECTION' (
  'ins_id' VARCHAR(100) NOT NULL DEFAULT '',
  'ins_project_code' VARCHAR(10) DEFAULT NULL,
  'ins_document_no' VARCHAR(100) DEFAULT NULL,
  'ins_inspection_no' VARCHAR(100) DEFAULT NULL,
  'ins_date' DATE DEFAULT NULL,
  'ins_order_type' VARCHAR(100) DEFAULT NULL,
  'ins_remark' VARCHAR(255) DEFAULT NULL,
  'ins_image_path' VARCHAR(255) DEFAULT NULL,
  'ins_created_date_time' DATETIME DEFAULT NULL,
  PRIMARY KEY  ('ins_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;
-- ----------------------------
-- Table structure for 'QRC_INSPECTION_IMAGE'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_INSPECTION_IMAGE';
CREATE TABLE 'QRC_INSPECTION_IMAGE' (
  'image_id' VARCHAR(100) NOT NULL DEFAULT '',
  'temp_ins_id' VARCHAR(100) DEFAULT NULL,
  'image_path' VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  ('image_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_INSPECTION_IMAGE
-- ----------------------------

-- ----------------------------
-- Table structure for 'QRC_INVOICE'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_INVOICE';
CREATE TABLE 'QRC_INVOICE' (
  'inv_id' VARCHAR(100) NOT NULL DEFAULT '',
  'customer_id' VARCHAR(100) DEFAULT NULL,
  'project_id' VARCHAR(100) DEFAULT NULL,
  'wo_status_id' VARCHAR(100) DEFAULT NULL,
  'order_type' VARCHAR(100) DEFAULT NULL,
  'create_type' VARCHAR(100) DEFAULT NULL,
  'invoice_status' VARCHAR(100) DEFAULT NULL,
  'create_receipt' VARCHAR(100) DEFAULT NULL,
  'create_progressive' VARCHAR(100) DEFAULT NULL,
  'create_date_time' DATETIME DEFAULT NULL,
  PRIMARY KEY  ('inv_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_INVOICE
-- ----------------------------

-- ----------------------------
-- Table structure for 'QRC_INVOICE_DETAIL'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_INVOICE_DETAIL';
CREATE TABLE 'QRC_INVOICE_DETAIL' (
  'detail_id' VARCHAR(100) NOT NULL,
  'detail_description' VARCHAR(100) DEFAULT NULL,
  'detail_quantity' VARCHAR(100) DEFAULT NULL,
  'detail_unit' VARCHAR(100) DEFAULT NULL,
  'detail_price_per_unit' VARCHAR(100) DEFAULT NULL,
  'detail_amount_baht' VARCHAR(100) DEFAULT NULL,
  'detail_type' VARCHAR(100) DEFAULT NULL,
  'ref_invoice_id' VARCHAR(100) DEFAULT NULL,
  'ref_po_project' VARCHAR(100) DEFAULT NULL,
  'ref_project_order_id' VARCHAR(100) DEFAULT NULL,
  'ref_invoice_main_id' VARCHAR(100) DEFAULT NULL,
  'create_date_time' DATETIME DEFAULT NULL,
  PRIMARY KEY  ('detail_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_INVOICE_DETAIL
-- ----------------------------

-- ----------------------------
-- Table structure for 'QRC_INVOICE_DETAIL_TMP'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_INVOICE_DETAIL_TMP';
CREATE TABLE 'QRC_INVOICE_DETAIL_TMP' (
  'detail_id' VARCHAR(100) NOT NULL,
  'detail_description' VARCHAR(100) DEFAULT NULL,
  'detail_quantity' VARCHAR(100) DEFAULT NULL,
  'detail_unit' VARCHAR(100) DEFAULT NULL,
  'detail_price_per_unit' VARCHAR(100) DEFAULT NULL,
  'detail_amount_baht' VARCHAR(100) DEFAULT NULL,
  'detail_type' VARCHAR(100) DEFAULT NULL,
  'ref_invoice_id' VARCHAR(100) DEFAULT NULL,
  'ref_po_project' VARCHAR(100) DEFAULT NULL,
  'ref_project_order_id' VARCHAR(100) DEFAULT NULL,
  'ref_invoice_main_id' VARCHAR(100) DEFAULT NULL,
  'create_date_time' DATETIME DEFAULT NULL,
  PRIMARY KEY  ('detail_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_INVOICE_STATUS'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_INVOICE_STATUS';
CREATE TABLE 'QRC_INVOICE_STATUS' (
  'inv_staus_id' VARCHAR(100) NOT NULL DEFAULT '',
  'inv_staus_name' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('inv_staus_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_INVOICE_STATUS
-- ----------------------------
INSERT INTO 'QRC_INVOICE_STATUS' VALUES ('44001', 'New');
INSERT INTO 'QRC_INVOICE_STATUS' VALUES ('44002', 'Open');
INSERT INTO 'QRC_INVOICE_STATUS' VALUES ('44003', 'Pending');
INSERT INTO 'QRC_INVOICE_STATUS' VALUES ('44004', 'In progress');
INSERT INTO 'QRC_INVOICE_STATUS' VALUES ('44005', 'Closed');

-- ----------------------------
-- Table structure for 'QRC_MEMBERS'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_MEMBERS';
CREATE TABLE 'QRC_MEMBERS' (
  'memid' VARCHAR(10) NOT NULL DEFAULT '',
  'memname' VARCHAR(255) DEFAULT NULL,
  'memrole' VARCHAR(10) DEFAULT NULL,
  'memtcode' VARCHAR(10) DEFAULT NULL,
  'memtname' VARCHAR(200) DEFAULT NULL,
  'memtel' VARCHAR(50) DEFAULT NULL,
  'memskill' VARCHAR(255) DEFAULT NULL,
  'mememail' VARCHAR(100) DEFAULT NULL,
  'memremark' VARCHAR(255) DEFAULT NULL,
  'created_date_time' VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  ('memid'),
  KEY 'membertcode' ('memtcode'),
  KEY 'membermemrole' ('memrole')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;
-- ----------------------------
-- Table structure for 'QRC_MEMBER_ROLE'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_MEMBER_ROLE';
CREATE TABLE 'QRC_MEMBER_ROLE' (
  'role_id' VARCHAR(10) NOT NULL DEFAULT '',
  'role_name' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('role_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_MEMBER_ROLE
-- ----------------------------
INSERT INTO 'QRC_MEMBER_ROLE' VALUES ('60001', 'Quality Inspector');
INSERT INTO 'QRC_MEMBER_ROLE' VALUES ('60002', 'Quality Controller');
INSERT INTO 'QRC_MEMBER_ROLE' VALUES ('60003', 'Team Manager');
INSERT INTO 'QRC_MEMBER_ROLE' VALUES ('60004', 'Team Leader');
INSERT INTO 'QRC_MEMBER_ROLE' VALUES ('60005', 'Supervisor');
INSERT INTO 'QRC_MEMBER_ROLE' VALUES ('60006', 'Builder');

-- ----------------------------
-- Table structure for 'QRC_PGS_DETAIL'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_PGS_DETAIL';
CREATE TABLE 'QRC_PGS_DETAIL' (
  'pgs_id' VARCHAR(100) NOT NULL,
  'pgs_description' VARCHAR(100) DEFAULT NULL,
  'pgs_quantity' VARCHAR(100) DEFAULT NULL,
  'pgs_unit' VARCHAR(100) DEFAULT NULL,
  'pgs_price_per_unit' VARCHAR(100) DEFAULT NULL,
  'pgs_amount_baht' VARCHAR(100) DEFAULT NULL,
  'pgs_type' VARCHAR(100) DEFAULT NULL,
  'ref_invoice_id' VARCHAR(100) DEFAULT NULL,
  'ref_po_project' VARCHAR(100) DEFAULT NULL,
  'ref_project_order_id' VARCHAR(100) DEFAULT NULL,
  'ref_invoice_main_id' VARCHAR(100) DEFAULT NULL,
  'create_date_time' DATETIME DEFAULT NULL,
  PRIMARY KEY  ('pgs_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;
-- ----------------------------
-- Table structure for 'QRC_PO'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_PO';
CREATE TABLE 'QRC_PO' (
  'po_id' VARCHAR(100) NOT NULL DEFAULT '',
  'po_project_name' VARCHAR(100) DEFAULT NULL,
  'po_project_code' VARCHAR(10) DEFAULT NULL,
  'po_document_no' VARCHAR(100) DEFAULT NULL,
  'po_po_no' VARCHAR(100) DEFAULT NULL,
  'po_home_plan' VARCHAR(100) DEFAULT NULL,
  'po_home_plot' VARCHAR(100) DEFAULT NULL,
  'po_owner' VARCHAR(100) DEFAULT NULL,
  'po_sender' VARCHAR(100) DEFAULT NULL,
  'po_issue_date' DATE DEFAULT NULL,
  'po_order_type_id' VARCHAR(10) DEFAULT NULL,
  'po_quantity' VARCHAR(100) DEFAULT NULL,
  'po_plan_size' VARCHAR(100) DEFAULT NULL,
  'po_unit_price' VARCHAR(100) DEFAULT NULL,
  'po_amount' VARCHAR(100) DEFAULT NULL,
  'po_vat' VARCHAR(100) DEFAULT NULL,
  'po_file_path' VARCHAR(200) DEFAULT NULL,
  'po_project_manager_id' VARCHAR(100) DEFAULT NULL,
  'po_project_foreman_id' VARCHAR(100) DEFAULT NULL,
  'po_supervisor_id' VARCHAR(100) DEFAULT NULL,
  'po_created_date_time' DATETIME DEFAULT NULL,
  'po_remark' VARCHAR(255) DEFAULT NULL,
  'po_name' VARCHAR(255) DEFAULT NULL,
  'po_retention' VARCHAR(255) DEFAULT NULL,
  'po_retention_reason' VARCHAR(255) DEFAULT NULL,
  'po_status' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('po_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;
-- ----------------------------
-- Table structure for 'QRC_PO_IMAGE'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_PO_IMAGE';
CREATE TABLE 'QRC_PO_IMAGE' (
  'image_id' VARCHAR(100) NOT NULL DEFAULT '',
  'temp_po_id' VARCHAR(100) DEFAULT NULL,
  'image_path' VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  ('image_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;
-- ----------------------------
-- Table structure for 'QRC_PROJECT'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_PROJECT';
CREATE TABLE 'QRC_PROJECT' (
  'project_code' VARCHAR(20) NOT NULL DEFAULT '',
  'project_name' VARCHAR(100) DEFAULT NULL,
  'PROJECT_STATUS' VARCHAR(10) DEFAULT NULL,
  'PROJECT_OWNER' VARCHAR(100) DEFAULT NULL,
  'PROJECT_TYPE' VARCHAR(10) DEFAULT NULL,
  'customer_id' VARCHAR(10) DEFAULT NULL,
  'project_manager' VARCHAR(100) DEFAULT NULL,
  'project_foreman' VARCHAR(250) DEFAULT NULL,
  'supervisor_control' VARCHAR(250) DEFAULT NULL,
  'team_owner' VARCHAR(10) DEFAULT NULL,
  'quality_inspectors' VARCHAR(100) DEFAULT NULL,
  'address_location' VARCHAR(255) DEFAULT NULL,
  'created_date_time' VARCHAR(100) DEFAULT NULL,
  'project_remark' VARCHAR(250) DEFAULT NULL,
  'updated_date_time' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('project_code'),
  KEY 'customer_id' ('customer_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_PROJECT_image'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_PROJECT_IMAGE';
CREATE TABLE 'QRC_PROJECT_IMAGE' (
  'image_id' VARCHAR(100) NOT NULL DEFAULT '',
  'temp_project_id' VARCHAR(100) DEFAULT NULL,
  'image_path' VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  ('image_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_PROJECT_order'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_PROJECT_ORDER';
CREATE TABLE 'QRC_PROJECT_ORDER' (
  'project_order_id' VARCHAR(100) NOT NULL DEFAULT '',
  'project_order_name' VARCHAR(100) DEFAULT NULL,
  'project_code' VARCHAR(10) DEFAULT NULL,
  'project_order_plan' VARCHAR(100) DEFAULT NULL,
  'project_order_plot' VARCHAR(100) DEFAULT NULL,
  'document_no' VARCHAR(100) DEFAULT NULL,
  'po_no' VARCHAR(100) DEFAULT NULL,
  'po_owner' VARCHAR(100) DEFAULT NULL,
  'po_sender' VARCHAR(100) DEFAULT NULL,
  'created_date_time' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  'order_type' VARCHAR(10) DEFAULT NULL,
  'plan_size' VARCHAR(50) DEFAULT NULL,
  'unit_price' VARCHAR(50) DEFAULT NULL,
  'amount' VARCHAR(50) DEFAULT NULL,
  'include_vat' VARCHAR(50) DEFAULT NULL,
  'image_name' VARCHAR(250) DEFAULT NULL,
  'PROJECT_STATUS' VARCHAR(50) DEFAULT NULL,
  'updated_date_time' VARCHAR(100) DEFAULT NULL,
  'remark' VARCHAR(255) DEFAULT NULL,
  'assign_id' VARCHAR(100) DEFAULT NULL,
  'po_inspection_id' VARCHAR(100) DEFAULT NULL,
  'inv_rep_pgs_id' VARCHAR(100) DEFAULT NULL,
  'inv_rep_pgs_status_id' VARCHAR(100) DEFAULT NULL,
  'wo_order_type' VARCHAR(100) DEFAULT NULL,
  'wo_price' VARCHAR(100) DEFAULT NULL,
  'wo_perc_of_po' VARCHAR(100) DEFAULT NULL,
  'wo_retention' VARCHAR(100) DEFAULT NULL,
  'wo_retention_reason' VARCHAR(255) DEFAULT NULL,
  'complete_date' VARCHAR(100) DEFAULT NULL,
  'real_wo_price' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('project_order_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_PROJECT_order_type'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_PROJECT_ORDER_TYPE';
CREATE TABLE 'QRC_PROJECT_ORDER_TYPE' (
  'order_type_id' VARCHAR(20) NOT NULL DEFAULT '',
  'order_type_name' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('order_type_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_PROJECT_order_type
-- ----------------------------
INSERT INTO 'QRC_PROJECT_ORDER_TYPE' VALUES ('7001', 'à¹?à¸?à¸£à¸?à¸«à¸¥à¸±à¸?à¸?à¸²');
INSERT INTO 'QRC_PROJECT_ORDER_TYPE' VALUES ('7002', 'à¹€à¸?à¸´à¸?à¸?à¸²à¸¢');
INSERT INTO 'QRC_PROJECT_ORDER_TYPE' VALUES ('7003', 'à¸¡à¸¸à¸?à¸«à¸¥à¸±à¸?à¸?à¸²');
INSERT INTO 'QRC_PROJECT_ORDER_TYPE' VALUES ('7004', 'à¸­à¸°à¹€à¸ª');

-- ----------------------------
-- Table structure for 'QRC_RECEIPT'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_RECEIPT';
CREATE TABLE 'QRC_RECEIPT' (
  'inv_id' VARCHAR(100) NOT NULL DEFAULT '',
  'customer_id' VARCHAR(100) DEFAULT NULL,
  'project_id' VARCHAR(100) DEFAULT NULL,
  'wo_status_id' VARCHAR(100) DEFAULT NULL,
  'order_type' VARCHAR(100) DEFAULT NULL,
  'create_type' VARCHAR(100) DEFAULT NULL,
  'invoice_status' VARCHAR(100) DEFAULT NULL,
  'create_receipt' VARCHAR(100) DEFAULT NULL,
  'create_progressive' VARCHAR(100) DEFAULT NULL,
  'create_date_time' DATETIME DEFAULT NULL,
  PRIMARY KEY  ('inv_id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_RECEIPT
-- ----------------------------

-- ----------------------------
-- Table structure for 'QRC_SKILL_ATTR'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_SKILL_ATTR';
CREATE TABLE 'QRC_SKILL_ATTR' (
  'attr_id' VARCHAR(100) NOT NULL DEFAULT '',
  'm_t_ref_id' VARCHAR(10) DEFAULT NULL,
  'skill_id' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('attr_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_TEAM_BUILDER'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_TEAM_BUILDER';
CREATE TABLE 'QRC_TEAM_BUILDER' (
  'tcode' VARCHAR(10) NOT NULL DEFAULT '',
  'tname' VARCHAR(200) DEFAULT NULL,
  'tlead_memid' VARCHAR(10) DEFAULT NULL,
  'ttype' VARCHAR(10) DEFAULT NULL,
  'tmanager_memid' VARCHAR(10) DEFAULT NULL,
  'tskill' VARCHAR(255) DEFAULT NULL,
  'tremark' VARCHAR(255) DEFAULT NULL,
  'created_date_time' VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  ('tcode'),
  KEY 'membertlead_memid' ('tlead_memid')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_TEAM_MAPPING'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_TEAM_MAPPING';
CREATE TABLE 'QRC_TEAM_MAPPING' (
  'id' VARCHAR(100) NOT NULL DEFAULT '',
  'team_id' VARCHAR(100) DEFAULT NULL,
  'member_id' VARCHAR(100) DEFAULT NULL,
  'mapping_date' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('id')
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Table structure for 'QRC_TYPE_OF_SERVICE'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_TYPE_OF_SERVICE';
CREATE TABLE 'QRC_TYPE_OF_SERVICE' (
  'service_id' VARCHAR(50) NOT NULL,
  'service_name' VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY  ('service_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_TYPE_OF_SERVICE
-- ----------------------------
INSERT INTO 'QRC_TYPE_OF_SERVICE' VALUES ('50001', 'à¹?à¸?à¸£à¸?à¸«à¸¥à¸±à¸?à¸?à¸²');
INSERT INTO 'QRC_TYPE_OF_SERVICE' VALUES ('50002', 'à¸­à¸°à¹€à¸ª');
INSERT INTO 'QRC_TYPE_OF_SERVICE' VALUES ('50003', 'à¹€à¸?à¸´à¸?à¸?à¸²à¸¢');
INSERT INTO 'QRC_TYPE_OF_SERVICE' VALUES ('50004', 'à¸«à¸¥à¸±à¸?à¸?à¸²');

-- ----------------------------
-- Table structure for 'QRC_USERS'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_USERS';
CREATE TABLE 'QRC_USERS' (
  'id' VARCHAR(10) NOT NULL,
  'username' VARCHAR(30) DEFAULT NULL,
  'password' VARCHAR(255) DEFAULT NULL,
  'fname' VARCHAR(50) DEFAULT NULL,
  'lname' VARCHAR(50) DEFAULT NULL,
  'email' VARCHAR(100) DEFAULT NULL,
  'gender' VARCHAR(10) DEFAULT NULL,
  'age' VARCHAR(10) DEFAULT NULL,
  'dob' DATE DEFAULT NULL,
  'permission_id' VARCHAR(10) DEFAULT NULL,
  PRIMARY KEY  ('id'),
  KEY 'permission_id' ('permission_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_USERS
-- ----------------------------
INSERT INTO 'QRC_USERS' VALUES ('1', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 'AdministratorFName', 'AdministratorLName', 'mail@mail.com', 'male', '55', '2014-04-30', '999999');

-- ----------------------------
-- Table structure for 'QRC_USER_PERMISSION'
-- ----------------------------
DROP TABLE IF EXISTS 'QRC_USER_PERMISSION';
CREATE TABLE 'QRC_USER_PERMISSION' (
  'permission_id' VARCHAR(10) NOT NULL DEFAULT '',
  'permission_name' VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY  ('permission_id')
) ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- ----------------------------
-- Records of QRC_USER_PERMISSION
-- ----------------------------
INSERT INTO 'QRC_USER_PERMISSION' VALUES ('999999', 'Administrator');
INSERT INTO 'QRC_USER_PERMISSION' VALUES ('111111', 'User Owner');
