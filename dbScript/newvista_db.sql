/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.37-MariaDB : Database - newvista_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`newvista_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `newvista_db`;

/*Table structure for table `academic_details` */

DROP TABLE IF EXISTS `academic_details`;

CREATE TABLE `academic_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `acdm_session_id` int(10) DEFAULT NULL COMMENT 'Table:academic_session_master',
  `class_id` int(10) DEFAULT NULL COMMENT 'Table:class_master',
  `section_id` int(10) DEFAULT NULL COMMENT 'Table:section_master',
  `rollno` int(10) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `academic_details` */

/*Table structure for table `academic_session_master` */

DROP TABLE IF EXISTS `academic_session_master`;

CREATE TABLE `academic_session_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `year` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `academic_session_master` */

insert  into `academic_session_master`(`id`,`year`) values (1,'2018');

/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activity_module` varchar(255) DEFAULT NULL,
  `module_master_id` int(20) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `from_method` varchar(100) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_browser` varchar(255) DEFAULT NULL,
  `user_platform` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `activity_log` */

insert  into `activity_log`(`id`,`activity_date`,`activity_module`,`module_master_id`,`action`,`from_method`,`user_id`,`ip_address`,`user_browser`,`user_platform`) values (1,'2018-12-26 21:33:57','ClassList',NULL,'Insert','ClassList/class_action',1,'::1','Firefox','Windows 10'),(2,'2018-12-26 21:38:05','Classlist',NULL,'Update','classlist/class_action',1,'::1','Firefox','Windows 10'),(3,'2018-12-26 21:38:15','Classlist',NULL,'Update','classlist/class_action',1,'::1','Firefox','Windows 10'),(4,'2018-12-26 22:18:02','section',NULL,'Insert','section/section_action',1,'::1','Firefox','Windows 10'),(5,'2018-12-26 22:18:12','section',NULL,'Update','section/section_action',1,'::1','Firefox','Windows 10'),(6,'2018-12-26 22:18:23','section',NULL,'Update','section/section_action',1,'::1','Firefox','Windows 10'),(7,'2018-12-26 22:18:53','section',NULL,'Update','section/section_action',1,'::1','Firefox','Windows 10'),(8,'2018-12-26 22:19:42','section',NULL,'Insert','section/section_action',1,'::1','Firefox','Windows 10'),(9,'2018-12-26 22:43:34','occupation',NULL,'Insert','occupation/occupation_action',1,'::1','Firefox','Windows 10'),(10,'2018-12-26 22:44:04','occupation',NULL,'Update','occupation/occupation_action',1,'::1','Firefox','Windows 10'),(11,'2018-12-26 23:03:20','religion',NULL,'Insert','religion/religion_action',1,'::1','Firefox','Windows 10'),(12,'2018-12-26 23:04:19','religion',NULL,'Update','religion/religion_action',1,'::1','Firefox','Windows 10'),(13,'2018-12-26 23:04:29','religion',NULL,'Update','religion/religion_action',1,'::1','Firefox','Windows 10'),(14,'2018-12-26 23:04:35','religion',NULL,'Insert','religion/religion_action',1,'::1','Firefox','Windows 10'),(15,'2018-12-26 23:59:05','caste',NULL,'Insert','caste/caste_action',1,'::1','Firefox','Windows 10'),(16,'2018-12-26 23:59:19','caste',NULL,'Insert','caste/caste_action',1,'::1','Firefox','Windows 10'),(17,'2018-12-26 23:59:48','caste',NULL,'Insert','caste/caste_action',1,'::1','Firefox','Windows 10'),(18,'2018-12-27 00:00:34','caste',NULL,'Insert','caste/caste_action',1,'::1','Firefox','Windows 10'),(19,'2018-12-27 00:04:04','caste',NULL,'Update','caste/caste_action',1,'::1','Firefox','Windows 10'),(20,'2018-12-27 00:30:10','Relationship',NULL,'Update','Relationship/relation_action',1,'::1','Firefox','Windows 10'),(21,'2018-12-27 00:30:17','Relationship',NULL,'Update','Relationship/relation_action',1,'::1','Firefox','Windows 10'),(22,'2018-12-27 00:30:26','Relationship',NULL,'Insert','Relationship/relation_action',1,'::1','Firefox','Windows 10'),(23,'2018-12-27 00:38:45','occupation',NULL,'Update','occupation/occupation_action',1,'::1','Firefox','Windows 10'),(24,'2018-12-27 00:39:20','caste',NULL,'Insert','caste/caste_action',1,'::1','Firefox','Windows 10'),(25,'2018-12-27 00:39:28','caste',NULL,'Insert','caste/caste_action',1,'::1','Firefox','Windows 10'),(26,'2018-12-27 00:42:27','caste',NULL,'Insert','caste/caste_action',1,'::1','Firefox','Windows 10');

/*Table structure for table `admin_menu_master` */

DROP TABLE IF EXISTS `admin_menu_master`;

CREATE TABLE `admin_menu_master` (
  `adm_menu_id` int(10) NOT NULL AUTO_INCREMENT,
  `adm_menu_name` varchar(255) DEFAULT NULL,
  `adm_menu_link` varchar(255) DEFAULT NULL,
  `is_parent` enum('P','SM','SSM','C') DEFAULT NULL COMMENT 'P= Parent,SM=Sub Menu, SSM= Sub Sub Menu',
  `parent_id` int(10) DEFAULT NULL,
  `menu_srl` int(10) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`adm_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `admin_menu_master` */

insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (1,'Get Ready',NULL,'P',NULL,1,'Y','2018-12-26 17:14:21'),(3,'Class','classlist','C',1,1,'Y','2018-12-26 17:56:03'),(4,'Section','section','C',1,2,'Y','2018-12-26 18:04:30'),(5,'Occupation','occupation','C',1,3,'Y','2018-12-26 18:04:54'),(6,'Religion','religion','C',1,4,'Y','2018-12-26 18:05:27'),(7,'Caste','caste','C',1,5,'Y','2018-12-26 18:09:12'),(8,'Relationship','relationship','C',1,6,'Y','2018-12-26 18:10:08'),(9,'Student','student/addstudent','C',1,7,'Y','2018-12-26 18:10:31');

/*Table structure for table `admin_user` */

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `school_master_id` int(10) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `admin_user` */

insert  into `admin_user`(`user_id`,`username`,`password`,`school_master_id`,`is_active`,`mobile_no`,`created_on`,`created_by`,`last_modified`) values (1,'admin','admin',1,'Y',NULL,'2018-12-26 18:37:27',NULL,NULL);

/*Table structure for table `blood_group` */

DROP TABLE IF EXISTS `blood_group`;

CREATE TABLE `blood_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `blood_group` */

insert  into `blood_group`(`id`,`group`) values (1,'A'),(2,'B'),(3,'AB'),(4,'O'),(5,'A-'),(6,'B-'),(7,'AB-'),(8,'O-');

/*Table structure for table `caste_master` */

DROP TABLE IF EXISTS `caste_master`;

CREATE TABLE `caste_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `caste` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `caste_master` */

insert  into `caste_master`(`id`,`caste`,`is_active`,`created_on`,`created_by`,`last_modified`) values (1,'General',1,'2018-12-26 23:59:05',1,NULL),(2,'ST',1,'2018-12-26 23:59:19',1,'2018-12-26 00:00:00'),(5,'SC',1,'2018-12-27 00:39:20',1,NULL),(6,'OBC',1,'2018-12-27 00:39:28',1,NULL),(7,'Others',1,'2018-12-27 00:42:27',1,NULL);

/*Table structure for table `class_master` */

DROP TABLE IF EXISTS `class_master`;

CREATE TABLE `class_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `classname` varbinary(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `class_master` */

insert  into `class_master`(`id`,`classname`,`created_on`,`created_by`,`last_modified`,`is_active`) values (1,'One','2018-12-26 18:38:49',1,'2018-12-26 00:00:00',1),(2,'Two','2018-12-26 21:33:57',1,NULL,1);

/*Table structure for table `gender_master` */

DROP TABLE IF EXISTS `gender_master`;

CREATE TABLE `gender_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `gender_master` */

insert  into `gender_master`(`id`,`gender`) values (1,'Male'),(2,'Female'),(3,'Other');

/*Table structure for table `occupation_master` */

DROP TABLE IF EXISTS `occupation_master`;

CREATE TABLE `occupation_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `occupation` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `occupation_master` */

insert  into `occupation_master`(`id`,`occupation`,`is_active`,`created_on`,`created_by`,`last_modified`) values (1,'Teacher',1,'2018-12-26 22:43:34',1,'2018-12-26 00:00:00');

/*Table structure for table `relationship_master` */

DROP TABLE IF EXISTS `relationship_master`;

CREATE TABLE `relationship_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `relation` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `relationship_master` */

insert  into `relationship_master`(`id`,`relation`,`is_active`,`created_on`,`created_by`,`last_modified`) values (1,'Father',NULL,'2018-12-27 00:15:04',1,NULL),(2,'Mother',NULL,'2018-12-27 00:15:04',1,NULL),(3,'Son',NULL,'2018-12-27 00:15:04',1,NULL),(4,'Daughter',NULL,'2018-12-27 00:15:04',1,NULL),(5,'Husband',NULL,'2018-12-27 00:15:04',1,NULL),(6,'Wife',NULL,'2018-12-27 00:15:04',1,NULL),(7,'Brother',NULL,'2018-12-27 00:15:04',1,NULL),(8,'Sister',NULL,'2018-12-27 00:15:04',1,NULL),(9,'Grandfather',NULL,'2018-12-27 00:15:04',1,NULL),(10,'Grandmother',NULL,'2018-12-27 00:15:04',1,NULL),(11,'Grandson',NULL,'2018-12-27 00:15:04',1,NULL),(12,'Granddaughter',NULL,'2018-12-27 00:15:04',1,NULL),(13,'Uncle',NULL,'2018-12-27 00:15:04',1,NULL),(14,'Aunt',NULL,'2018-12-27 00:15:04',1,'2018-12-26 00:00:00'),(15,'Nephew',NULL,'2018-12-27 00:15:04',1,NULL),(16,'Niece',NULL,'2018-12-27 00:15:04',1,NULL),(17,'Cousin',NULL,'2018-12-27 00:15:04',1,NULL),(18,'Self',NULL,'2018-12-27 00:15:04',1,NULL),(19,'Non Worker',NULL,'2018-12-27 00:15:04',1,NULL);

/*Table structure for table `religion_master` */

DROP TABLE IF EXISTS `religion_master`;

CREATE TABLE `religion_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `religion` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `religion_master` */

insert  into `religion_master`(`id`,`religion`,`is_active`,`created_on`,`created_by`,`last_modified`) values (1,'Hindu',1,'2018-12-26 23:03:20',1,'2018-12-26 00:00:00');

/*Table structure for table `school_master` */

DROP TABLE IF EXISTS `school_master`;

CREATE TABLE `school_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `school_master` */

insert  into `school_master`(`id`,`school_name`,`is_active`,`created_on`,`created_by`,`last_modified`) values (1,'New Vista Academy','Y','2018-12-26 18:36:27',NULL,NULL);

/*Table structure for table `section_master` */

DROP TABLE IF EXISTS `section_master`;

CREATE TABLE `section_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `section_master` */

insert  into `section_master`(`id`,`section`,`is_active`,`created_on`,`created_by`,`last_modified`) values (1,'A',1,'2018-12-26 18:48:52',1,NULL),(2,'B',1,'2018-12-26 18:48:56',1,NULL),(3,'C',1,'2018-12-26 18:49:06',1,NULL);

/*Table structure for table `student_master` */

DROP TABLE IF EXISTS `student_master`;

CREATE TABLE `student_master` (
  `student_id` int(10) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(255) DEFAULT NULL,
  `form_sl_no` varchar(255) DEFAULT NULL,
  `admission_dt` datetime DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender_id` int(10) DEFAULT NULL,
  `blood_gr_id` int(10) DEFAULT NULL,
  `caste_id` int(10) DEFAULT NULL,
  `religion_id` int(10) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_contact_no` varchar(25) DEFAULT NULL,
  `father_occupation_id` int(10) DEFAULT NULL,
  `fathers_income` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_contact_no` varchar(25) DEFAULT NULL,
  `mother_occupation_id` int(10) DEFAULT NULL,
  `mother_income` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `reg_no` (`reg_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_master` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
