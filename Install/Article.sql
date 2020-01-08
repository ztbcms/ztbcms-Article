SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cms_commonly_article
-- ----------------------------

DROP TABLE IF EXISTS `ztb_commonly_article`;
CREATE TABLE `ztb_commonly_article`  (
  `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '文章名称',
  `cover_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '文章封面',
  `about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '文章简介',
  `view_num` int(15) NULL DEFAULT NULL COMMENT '浏览量',
  `inputtime` int(15) NULL DEFAULT NULL,
  `updatetime` int(15) NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '文章类型',
  `listorder` int(15) NULL DEFAULT NULL COMMENT '排序',
  `is_display` int(15) NULL DEFAULT NULL COMMENT '是否显示',
  `is_delete` int(15) NULL DEFAULT NULL COMMENT '是否删除',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '文章内容',
  `group_id` int(15) NULL DEFAULT NULL COMMENT '分类id',
  `group_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;

DROP TABLE IF EXISTS `cms_commonly_article_group`;
CREATE TABLE `cms_commonly_article_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(15) NULL DEFAULT NULL COMMENT '父级id',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `inputtime` int(18) UNSIGNED NOT NULL DEFAULT 0,
  `updatetime` int(18) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类型',
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `is_display` int(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否显示',
  `is_delete` int(1) NOT NULL COMMENT '是否删除',
  `lv` int(5) NULL DEFAULT NULL COMMENT '等级',
  `cover_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类缩略图',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE,
  INDEX `listorder`(`listorder`) USING BTREE,
  INDEX `is_display`(`is_display`) USING BTREE,
  INDEX `is_delete`(`is_delete`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `type`(`type`) USING BTREE
) ENGINE = MyISAM  CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;
