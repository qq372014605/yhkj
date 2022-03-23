/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : yhkj

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2022-03-23 16:25:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1648015274');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1648015284');
INSERT INTO `migration` VALUES ('m190124_110200_add_verification_token_column_to_user_table', '1648015284');

-- ----------------------------
-- Table structure for `supplier`
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `code` char(3) CHARACTER SET ascii DEFAULT NULL,
  `t_status` enum('ok','hold') CHARACTER SET ascii NOT NULL DEFAULT 'ok',
  `created_at` bigint(20) DEFAULT '0' COMMENT '创建时间',
  `updated_at` bigint(20) DEFAULT '0' COMMENT '更新时间',
  `deleted_at` bigint(20) DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES ('1', '张三', '001', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('2', '李四', '002', 'hold', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('3', '诸葛', '003', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('4', '上官', '004', 'hold', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('5', '东方', '005', 'hold', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('6', '赵钱孙', '006', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('7', '赵云', '007', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('8', '张飞', '008', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('9', '关羽', '009', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('10', '刘备', '010', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('11', '曹操', '011', 'ok', '1648015626', '1648015626', '0');
INSERT INTO `supplier` VALUES ('12', '周瑜', '012', 'ok', '1648015626', '1648015626', '0');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'Iz6otklwwgZniAE8EXSZKVj1BPNwrg8A', '$2y$13$WD5tqVxLI7rUhJpkg8EWwOAB5pt0eFaHyO4shX5BFGb7KAcSVjQQi', null, 'admin@163.com', '10', '1648015626', '1648015626', null);
