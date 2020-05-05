-- ----------------------------
-- Table structure for vocabulary
-- ----------------------------
DROP TABLE IF EXISTS `vocabulary`;
CREATE TABLE `vocabulary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(500) DEFAULT NULL,
  `reading` varchar(500) DEFAULT NULL,
  `mean_vn` varchar(500) DEFAULT NULL,
  `mean_en` varchar(500) DEFAULT NULL,
  `voice_path` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `type_id` int(11) DEFAULT 0 COMMENT '1:lập trình,2:dữ liệu,3:giao diện,4:website,5:Máy tính,6:Phần cứng,7:tháo tác,8:network,9:security,10: Mail,11: Soạn thảo,12: tên riêng',
  `category_id` int(11) DEFAULT 0 COMMENT '1:it,2:sport',
  `word_type` int(11) DEFAULT 3 COMMENT '1:漢字,2:かたがない,3:その他',
  `sort_index` int(11) DEFAULT 1 NOT NULL,
  `word_of_day` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ----------------------------
-- Table structure for vocabulary_synonym
-- ----------------------------
DROP TABLE IF EXISTS `vocabulary_synonym`;
CREATE TABLE `vocabulary_synonym` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vocabulary_id` int(11) DEFAULT NULL,
  `synonym_id` int(11) DEFAULT NULL,
  `sort_index` int(11) DEFAULT 1 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ----------------------------
-- Table structure for vocabulary_synonym
-- ----------------------------
DROP TABLE IF EXISTS `vocabulary_category`;
CREATE TABLE `vocabulary_category` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) DEFAULT NULL,
    `show` varchar(100) DEFAULT NULL,
    `created` datetime DEFAULT NULL,
    `modified` datetime DEFAULT NULL,
    `deleted` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
);

-- ----------------------------
-- Table structure for vocabulary_type
-- ----------------------------
DROP TABLE IF EXISTS `vocabulary_type`;
CREATE TABLE `vocabulary_type` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `vocabulary_category_id` int(11) DEFAULT NULL,
    `name` varchar(100) DEFAULT NULL,
    `show` varchar(100) DEFAULT 1 NOT NULL,
    `count_vocabulary` int(11) DEFAULT 0 NOT NULL,
    `sort_index` int(11) DEFAULT 1 NOT NULL,
    `created` datetime DEFAULT NULL,
    `modified` datetime DEFAULT NULL,
    `deleted` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
);

-- ----------------------------
-- Table structure for access_logs
-- ----------------------------
DROP TABLE IF EXISTS `access_log`;
CREATE TABLE `access_log` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `ref_page` varchar(500) DEFAULT NULL,
    `device_type` varchar(100) DEFAULT NULL,
    `client_ip` varchar(50) DEFAULT NULL,
    `user_agent` varchar(500) DEFAULT NULL,
    `current` date DEFAULT NULL,
    `created` datetime DEFAULT NULL,
    `modified` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
);

-- ----------------------------
-- Table structure for statistic_access
-- ----------------------------
DROP TABLE IF EXISTS `statistic_access`;
CREATE TABLE `statistic_access` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `key` varchar(50) DEFAULT NULL,
    `value` varchar(50) DEFAULT NULL,
    `current` date DEFAULT NULL,
    `created` datetime DEFAULT NULL,
    `modified` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
);

-- ----------------------------
-- Table structure for tracing_access_log
-- ----------------------------
DROP TABLE IF EXISTS `tracing_access_log`;
CREATE TABLE `tracing_access_log` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `userId` int(11) NULL,
    `route` varchar(255) NOT NULL,
    `method` varchar(20) DEFAULT NULL,
    `postParams` blob NULL,
    `clientIp` varchar(50) DEFAULT NULL,
    `processTime` int(11) NULL DEFAULT 0 COMMENT 'unit millisecond',
    `responseBody` TEXT DEFAULT NULL,
    `created` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
);

