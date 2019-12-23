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
