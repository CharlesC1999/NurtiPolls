-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Member'
-- 
-- ---

DROP TABLE IF EXISTS `Member`;
		
CREATE TABLE `Member` (
  `Member_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `User_name` VARCHAR(20) NOT NULL,
  `Account` VARCHAR(20) NOT NULL,
  `Password` VARCHAR(55) NOT NULL,
  `Email` VARCHAR(50) NOT NULL,
  `Phone` VARCHAR(255) NOT NULL,
  `Gender` ENUM('M','F','Other') NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `Create_date` DATETIME NOT NULL,
  `Last_login` DATETIME NOT NULL,
  `valid` TINYINT(2) NOT NULL,
  `User_image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Member_ID`)
);

-- ---
-- Table 'Product'
-- 
-- ---

DROP TABLE IF EXISTS `Product`;
		
CREATE TABLE `Product` (
  `Product_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `Category_ID` INTEGER(5) NOT NULL,
  `Product_name` VARCHAR(20) NOT NULL,
  `Description` MEDIUMTEXT NULL DEFAULT NULL,
  `Price` INTEGER(8) NOT NULL,
  `Stock_quantity` INTEGER(5) NOT NULL,
  `F_coupon_id` INTEGER(5) NOT NULL,
  `Product_upload_date` DATETIME NOT NULL,
  PRIMARY KEY (`Product_ID`)
);

-- ---
-- Table 'Product_image'
-- 
-- ---

DROP TABLE IF EXISTS `Product_image`;
		
CREATE TABLE `Product_image` (
  `Image_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `F_Product_ID` INTEGER(5) NOT NULL,
  `Image_URL` VARCHAR(255) NOT NULL,
  `Description` VARCHAR(255) NOT NULL,
  `Sort_order` INTEGER(5) NOT NULL DEFAULT 0,
  `Upload_date` DATETIME NOT NULL,
  PRIMARY KEY (`Image_ID`)
);

-- ---
-- Table 'Product_categories'
-- 
-- ---

DROP TABLE IF EXISTS `Product_categories`;
		
CREATE TABLE `Product_categories` (
  `Product_cate_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `Product_cate_name` VARCHAR(55) NOT NULL,
  `P_Description` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`Product_cate_ID`)
);

-- ---
-- Table 'Order'
-- 
-- ---

DROP TABLE IF EXISTS `Order`;
		
CREATE TABLE `Order` (
  `Order_ID` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `Product_ID` INTEGER(10) NOT NULL,
  `Member_ID` INTEGER(5) NOT NULL,
  `Order_date` DATETIME NOT NULL,
  `Amount` INTEGER(10) NOT NULL,
  `Status` ENUM('訂單處理中','已出貨','付款完成','訂單已完成','已取消','已退款') NOT NULL,
  `Shipping_address` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Order_ID`)
);

-- ---
-- Table 'Event(reserved)'
-- 
-- ---

DROP TABLE IF EXISTS `Event(reserved)`;
		
CREATE TABLE `Event(reserved)` (
  `Event_ID` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `Title_E_name` VARCHAR(55) NOT NULL,
  `Content` MEDIUMTEXT NOT NULL,
  `Publish_date` DATETIME NOT NULL,
  `Event_category_ID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`Event_ID`)
);

-- ---
-- Table 'Event_categories(reserved)'
-- 
-- ---

DROP TABLE IF EXISTS `Event_categories(reserved)`;
		
CREATE TABLE `Event_categories(reserved)` (
  `Event_cate_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `Event_cate_name` VARCHAR(55) NOT NULL,
  `E_Description` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`Event_cate_ID`)
);

-- ---
-- Table 'Event_image(reserved)'
-- 
-- ---

DROP TABLE IF EXISTS `Event_image(reserved)`;
		
CREATE TABLE `Event_image(reserved)` (
  `Image_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `F_Event_ID` INTEGER(5) NOT NULL,
  `Image_URL` VARCHAR(255) NOT NULL,
  `Description` VARCHAR(255) NOT NULL,
  `Sort_order` INTEGER(5) NOT NULL DEFAULT 0,
  `Upload_date` DATETIME NOT NULL,
  PRIMARY KEY (`Image_ID`)
);

-- ---
-- Table 'Recipe'
-- 
-- ---

DROP TABLE IF EXISTS `Recipe`;
		
CREATE TABLE `Recipe` (
  `Recipe_ID` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `Title_R_name` VARCHAR(55) NOT NULL,
  `Image_URL` VARCHAR(255) NOT NULL,
  `Content` MEDIUMTEXT NOT NULL,
  `Publish_date` DATETIME NOT NULL,
  `Recipe_category_ID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`Recipe_ID`)
);

-- ---
-- Table 'Recipe_image(reserved)'
-- 
-- ---

DROP TABLE IF EXISTS `Recipe_image(reserved)`;
		
CREATE TABLE `Recipe_image(reserved)` (
  `Image_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `F_Recipe_ID` INTEGER(5) NOT NULL,
  `Image_URL` VARCHAR(255) NOT NULL,
  `Description` MEDIUMTEXT NOT NULL,
  `Sort_order` INTEGER(5) NOT NULL DEFAULT 0,
  `Upload_date` DATETIME NOT NULL,
  PRIMARY KEY (`Image_ID`)
);

-- ---
-- Table 'Recipe_categories'
-- 
-- ---

DROP TABLE IF EXISTS `Recipe_categories`;
		
CREATE TABLE `Recipe_categories` (
  `Recipe_cate_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `Recipe_cate_name` VARCHAR(55) NOT NULL,
  `R_Description` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`Recipe_cate_ID`)
);

-- ---
-- Table 'Product_like'
-- 
-- ---

DROP TABLE IF EXISTS `Product_like`;
		
CREATE TABLE `Product_like` (
  `Like_ID` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `User_ID` INTEGER(5) NOT NULL,
  `Product_ID` INTEGER(5) NOT NULL,
  PRIMARY KEY (`Like_ID`)
);

-- ---
-- Table 'Recipe_like'
-- 
-- ---

DROP TABLE IF EXISTS `Recipe_like`;
		
CREATE TABLE `Recipe_like` (
  `Like_ID` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `User_ID` INTEGER(5) NOT NULL,
  `Recipe_ID` INTEGER(5) NOT NULL,
  PRIMARY KEY (`Like_ID`)
);

-- ---
-- Table 'Speaker'
-- 
-- ---

DROP TABLE IF EXISTS `Speaker`;
		
CREATE TABLE `Speaker` (
  `Speaker_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `Speaker_name` VARCHAR(55) NOT NULL,
  `Speaker_description` MEDIUMTEXT NOT NULL,
  `Image` VARCHAR(255) NOT NULL,
  `class_id` INTEGER(30) NOT NULL,
  PRIMARY KEY (`Speaker_ID`)
);

-- ---
-- Table 'Class'
-- 
-- ---

DROP TABLE IF EXISTS `Class`;
		
CREATE TABLE `Class` (
  `Class_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `Class_name` VARCHAR(255) NOT NULL,
  `Class_description` MEDIUMTEXT NOT NULL,
  `C_price` INTEGER(10) NOT NULL,
  `C_discount_price` INTEGER(5) NOT NULL,
  `F_Speaker_ID` INTEGER(5) NOT NULL,
  `Class_person_limit` INTEGER(5) NOT NULL,
  `Start_date` DATETIME NOT NULL,
  `End_date` DATETIME NOT NULL,
  `Class_date` DATETIME NOT NULL,
  `Class_category_ID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`Class_ID`)
);

-- ---
-- Table 'Class_like'
-- 
-- ---

DROP TABLE IF EXISTS `Class_like`;
		
CREATE TABLE `Class_like` (
  `Like_ID` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `User_ID` INTEGER(5) NOT NULL,
  `Class_ID` INTEGER(5) NOT NULL,
  PRIMARY KEY (`Like_ID`)
);

-- ---
-- Table 'Class_categories'
-- 
-- ---

DROP TABLE IF EXISTS `Class_categories`;
		
CREATE TABLE `Class_categories` (
  `Class_cate_ID` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `Class_cate_name` VARCHAR(255) NOT NULL,
  `C_Description` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`Class_cate_ID`)
);

-- ---
-- Table 'Class_image'
-- 
-- ---

DROP TABLE IF EXISTS `Class_image`;
		
CREATE TABLE `Class_image` (
  `Image_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `F_Class_ID` INTEGER(5) NOT NULL,
  `Image_URL` VARCHAR(255) NOT NULL,
  `Description` MEDIUMTEXT NOT NULL,
  `Sort_order` INTEGER(5) NOT NULL DEFAULT 0,
  `Upload_date` DATETIME NOT NULL,
  PRIMARY KEY (`Image_ID`)
);

-- ---
-- Table 'Coupons'
-- 
-- ---

DROP TABLE IF EXISTS `Coupons`;
		
CREATE TABLE `Coupons` (
  `Coupon_ID` INTEGER(5) NOT NULL AUTO_INCREMENT,
  `C_name` VARCHAR(25) NOT NULL,
  `C_code` VARCHAR(255) NOT NULL,
  `C_image` VARCHAR(255) NOT NULL,
  `Discount_amount` DECIMAL(7,2) NOT NULL,
  `Discount_type` ENUM('百分比',' 金額') NOT NULL,
  `Coupon_decription` MEDIUMTEXT NOT NULL,
  `Valid_start_date` DATETIME NOT NULL,
  `Valid_end_date` DATETIME NOT NULL,
  PRIMARY KEY (`Coupon_ID`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `Product` ADD FOREIGN KEY (Category_ID) REFERENCES `Product_categories` (`Product_cate_ID`);
ALTER TABLE `Product` ADD FOREIGN KEY (F_coupon_id) REFERENCES `Coupons` (`Coupon_ID`);
ALTER TABLE `Product_image` ADD FOREIGN KEY (F_Product_ID) REFERENCES `Product` (`Product_ID`);
ALTER TABLE `Order` ADD FOREIGN KEY (Product_ID) REFERENCES `Product` (`Product_ID`);
ALTER TABLE `Order` ADD FOREIGN KEY (Member_ID) REFERENCES `Member` (`Member_ID`);
ALTER TABLE `Event(reserved)` ADD FOREIGN KEY (Event_category_ID) REFERENCES `Event_categories(reserved)` (`Event_cate_ID`);
ALTER TABLE `Event_image(reserved)` ADD FOREIGN KEY (F_Event_ID) REFERENCES `Event(reserved)` (`Event_ID`);
ALTER TABLE `Recipe` ADD FOREIGN KEY (Recipe_category_ID) REFERENCES `Recipe_categories` (`Recipe_cate_ID`);
ALTER TABLE `Product_like` ADD FOREIGN KEY (User_ID) REFERENCES `Member` (`Member_ID`);
ALTER TABLE `Product_like` ADD FOREIGN KEY (Product_ID) REFERENCES `Product` (`Product_ID`);
ALTER TABLE `Recipe_like` ADD FOREIGN KEY (User_ID) REFERENCES `Member` (`Member_ID`);
ALTER TABLE `Recipe_like` ADD FOREIGN KEY (Recipe_ID) REFERENCES `Recipe` (`Recipe_ID`);
ALTER TABLE `Speaker` ADD FOREIGN KEY (class_id) REFERENCES `Class` (`Class_ID`);
ALTER TABLE `Class` ADD FOREIGN KEY (F_Speaker_ID) REFERENCES `Speaker` (`Speaker_ID`);
ALTER TABLE `Class` ADD FOREIGN KEY (Class_category_ID) REFERENCES `Class_categories` (`Class_cate_ID`);
ALTER TABLE `Class_like` ADD FOREIGN KEY (User_ID) REFERENCES `Member` (`Member_ID`);
ALTER TABLE `Class_like` ADD FOREIGN KEY (Class_ID) REFERENCES `Class` (`Class_ID`);
ALTER TABLE `Class_image` ADD FOREIGN KEY (F_Class_ID) REFERENCES `Class` (`Class_ID`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Member` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Product` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Product_image` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Product_categories` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Order` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Event(reserved)` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Event_categories(reserved)` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Event_image(reserved)` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Recipe` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Recipe_image(reserved)` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Recipe_categories` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Product_like` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Recipe_like` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Speaker` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Class` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Class_like` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Class_categories` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Class_image` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Coupons` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `Member` (`Member_ID`,`User_name`,`Account`,`Password`,`Email`,`Phone`,`Gender`,`date_of_birth`,`Create_date`,`Last_login`,`valid`,`User_image`) VALUES
-- ('','','','','','','','','','','','');
-- INSERT INTO `Product` (`Product_ID`,`Category_ID`,`Product_name`,`Description`,`Price`,`Stock_quantity`,`F_coupon_id`,`Product_upload_date`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `Product_image` (`Image_ID`,`F_Product_ID`,`Image_URL`,`Description`,`Sort_order`,`Upload_date`) VALUES
-- ('','','','','','');
-- INSERT INTO `Product_categories` (`Product_cate_ID`,`Product_cate_name`,`P_Description`) VALUES
-- ('','','');
-- INSERT INTO `Order` (`Order_ID`,`Product_ID`,`Member_ID`,`Order_date`,`Amount`,`Status`,`Shipping_address`) VALUES
-- ('','','','','','','');
-- INSERT INTO `Event(reserved)` (`Event_ID`,`Title_E_name`,`Content`,`Publish_date`,`Event_category_ID`) VALUES
-- ('','','','','');
-- INSERT INTO `Event_categories(reserved)` (`Event_cate_ID`,`Event_cate_name`,`E_Description`) VALUES
-- ('','','');
-- INSERT INTO `Event_image(reserved)` (`Image_ID`,`F_Event_ID`,`Image_URL`,`Description`,`Sort_order`,`Upload_date`) VALUES
-- ('','','','','','');
-- INSERT INTO `Recipe` (`Recipe_ID`,`Title_R_name`,`Image_URL`,`Content`,`Publish_date`,`Recipe_category_ID`) VALUES
-- ('','','','','','');
-- INSERT INTO `Recipe_image(reserved)` (`Image_ID`,`F_Recipe_ID`,`Image_URL`,`Description`,`Sort_order`,`Upload_date`) VALUES
-- ('','','','','','');
-- INSERT INTO `Recipe_categories` (`Recipe_cate_ID`,`Recipe_cate_name`,`R_Description`) VALUES
-- ('','','');
-- INSERT INTO `Product_like` (`Like_ID`,`User_ID`,`Product_ID`) VALUES
-- ('','','');
-- INSERT INTO `Recipe_like` (`Like_ID`,`User_ID`,`Recipe_ID`) VALUES
-- ('','','');
-- INSERT INTO `Speaker` (`Speaker_ID`,`Speaker_name`,`Speaker_description`,`Image`,`class_id`) VALUES
-- ('','','','','');
-- INSERT INTO `Class` (`Class_ID`,`Class_name`,`Class_description`,`C_price`,`C_discount_price`,`F_Speaker_ID`,`Class_person_limit`,`Start_date`,`End_date`,`Class_date`,`Class_category_ID`) VALUES
-- ('','','','','','','','','','','');
-- INSERT INTO `Class_like` (`Like_ID`,`User_ID`,`Class_ID`) VALUES
-- ('','','');
-- INSERT INTO `Class_categories` (`Class_cate_ID`,`Class_cate_name`,`C_Description`) VALUES
-- ('','','');
-- INSERT INTO `Class_image` (`Image_ID`,`F_Class_ID`,`Image_URL`,`Description`,`Sort_order`,`Upload_date`) VALUES
-- ('','','','','','');
-- INSERT INTO `Coupons` (`Coupon_ID`,`C_name`,`C_code`,`C_image`,`Discount_amount`,`Discount_type`,`Coupon_decription`,`Valid_start_date`,`Valid_end_date`) VALUES
-- ('','','','','','','','','');