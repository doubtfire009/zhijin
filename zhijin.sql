/*
Navicat MySQL Data Transfer

Source Server         : zjw
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : zhijin

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2016-01-29 17:41:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `experience`
-- ----------------------------
DROP TABLE IF EXISTS `experience`;
CREATE TABLE `experience` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT COMMENT '用户代码',
  `free_validate` tinyint(1) DEFAULT NULL COMMENT '是否设置为免费',
  `validate_flag` tinyint(1) DEFAULT NULL COMMENT '是否通过验证',
  `experience_id_up` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '上层经历代码',
  `experience_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '本次经历代码',
  `brief` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT '经历简介',
  `content` text CHARACTER SET utf8 COMMENT '经历详细内容',
  `achievement` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '成就',
  `influence` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT '影响',
  `book` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT '推荐书籍',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of experience
-- ----------------------------
INSERT INTO `experience` VALUES ('4', null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `experience_title`
-- ----------------------------
DROP TABLE IF EXISTS `experience_title`;
CREATE TABLE `experience_title` (
  `id` int(100) NOT NULL COMMENT '经历标题id',
  `experience_id` varchar(100) DEFAULT NULL COMMENT '经历标题代码',
  `title` varchar(100) DEFAULT NULL COMMENT '经历标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of experience_title
-- ----------------------------
INSERT INTO `experience_title` VALUES ('0', '0', '开始新建经历');
INSERT INTO `experience_title` VALUES ('1', '1', '学业');
INSERT INTO `experience_title` VALUES ('2', '2', '工作');
INSERT INTO `experience_title` VALUES ('3', '3', '生活');
INSERT INTO `experience_title` VALUES ('4', '1,1', '本科');
INSERT INTO `experience_title` VALUES ('5', '1,1,1', '大一');
INSERT INTO `experience_title` VALUES ('6', '1,1,2', '大二');
INSERT INTO `experience_title` VALUES ('7', '1,1,3', '大三');
INSERT INTO `experience_title` VALUES ('8', '1,1,4', '大四');
INSERT INTO `experience_title` VALUES ('9', '1,1,5', '其他');
INSERT INTO `experience_title` VALUES ('10', '1,2', '硕士');
INSERT INTO `experience_title` VALUES ('11', '1,2,1', '研一');
INSERT INTO `experience_title` VALUES ('12', '1,2,2', '研二');
INSERT INTO `experience_title` VALUES ('13', '1,2,3', '研三');
INSERT INTO `experience_title` VALUES ('14', '1,3', '博士');
INSERT INTO `experience_title` VALUES ('15', '1,3,1', '博一');
INSERT INTO `experience_title` VALUES ('16', '1,3,2', '博二');
INSERT INTO `experience_title` VALUES ('17', '1,3,3', '博三');
INSERT INTO `experience_title` VALUES ('18', '1,3,4', '博四');
INSERT INTO `experience_title` VALUES ('19', '1,4', '其他');

-- ----------------------------
-- Table structure for `meeting_order`
-- ----------------------------
DROP TABLE IF EXISTS `meeting_order`;
CREATE TABLE `meeting_order` (
  `order_id` int(100) NOT NULL AUTO_INCREMENT COMMENT '订单代码',
  `user_id` int(100) DEFAULT NULL COMMENT '用户代码',
  `contact_id` int(100) DEFAULT NULL COMMENT '约谈人代码',
  `meeting_date` int(100) DEFAULT NULL COMMENT '约谈时间',
  `meeting_content` varchar(3000) CHARACTER SET utf8 DEFAULT NULL COMMENT '约谈内容',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of meeting_order
-- ----------------------------

-- ----------------------------
-- Table structure for `order_vote`
-- ----------------------------
DROP TABLE IF EXISTS `order_vote`;
CREATE TABLE `order_vote` (
  `order_id` int(100) NOT NULL COMMENT '订单代码',
  `user_id` int(100) DEFAULT NULL COMMENT '用户代码',
  `order_vote` tinyint(1) DEFAULT NULL COMMENT '订单评价',
  `order_vote_content` varchar(1000) CHARACTER SET utf8 DEFAULT NULL COMMENT '订单评价内容',
  `order_vote_pic` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '订单评价插入图片',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_vote
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT COMMENT '用户代码',
  `user_log` varchar(200) NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户昵称',
  `pwd` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户密码',
  `status` tinyint(1) DEFAULT NULL COMMENT '用户状态 1：正常 2：冻结',
  `username` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户真实姓名',
  `sex` varchar(2) CHARACTER SET utf8 DEFAULT NULL COMMENT '性别',
  `mobile` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '联系电话',
  `email` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '电子邮箱',
  `reg_date` int(20) unsigned zerofill DEFAULT NULL COMMENT '注册时间',
  `birth` int(14) DEFAULT NULL COMMENT '出生日期',
  `ID_No` varchar(18) CHARACTER SET utf8 DEFAULT NULL COMMENT '身份证号',
  `ID_pic` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '身份证图像',
  `identity` int(1) DEFAULT NULL COMMENT '登录身份 1：用户  2：猎头',
  `study_period_start` int(20) DEFAULT NULL COMMENT '学业开始时间',
  `study_period_end` int(20) DEFAULT NULL COMMENT '学业结束时间',
  `work_period_start` int(20) DEFAULT NULL COMMENT '工作开始时间',
  `work_period_end` int(20) DEFAULT NULL COMMENT '工作结束时间',
  `validate_flag` tinyint(1) DEFAULT NULL COMMENT '个人信息是否已经验证',
  `study_level` int(1) DEFAULT NULL COMMENT '学历级别',
  `work_flag` tinyint(1) DEFAULT NULL COMMENT '是否工作',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '15800894783', '111', '698d51a19d8a121ce581499d7b701668', '1', null, null, '15800894783', '', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('4', '13839187611', '嗡嗡嗡', '202cb962ac59075b964b07152d234b70', '1', '李之玉', '1', '13839187615', '45646@163.com', '00000000001453449141', null, '410811198609010010', null, null, '1452556800', '1452729600', '1452470400', '1453334400', null, '2', null);
INSERT INTO `user` VALUES ('8', 'hn.lizhiyu@163.com', '钱钱钱', '202cb962ac59075b964b07152d234b70', '1', null, null, '', 'hn.lizhiyu@163.com', '00000000001453453072', null, null, null, null, null, null, null, null, null, '2', null);
INSERT INTO `user` VALUES ('9', '15800894733', '呃呃呃', '202cb962ac59075b964b07152d234b70', '1', null, null, '15800894733', '', '00000000001453453198', null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('11', '13839135332', '好好好', '202cb962ac59075b964b07152d234b70', '1', null, null, '13839135332', '', '00000000001453483793', null, null, null, null, null, null, null, null, null, '3', null);
INSERT INTO `user` VALUES ('25', '15800894712', '白日依山尽黄河', '202cb962ac59075b964b07152d234b70', '1', null, null, '15800894712', '', '00000000001453572012', null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('26', '13839135331', '11111顶顶顶f', '202cb962ac59075b964b07152d234b70', '1', null, null, '13839135331', '', '00000000001453656433', null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `user_cart`
-- ----------------------------
DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE `user_cart` (
  `cart_id` int(100) NOT NULL COMMENT '购物车代码',
  `user_id` int(100) DEFAULT NULL COMMENT '用户代码',
  `self_intro_id` int(100) DEFAULT NULL COMMENT '简历代码',
  `cart_date` int(20) DEFAULT NULL COMMENT '加入购物车时间',
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `user_check`
-- ----------------------------
DROP TABLE IF EXISTS `user_check`;
CREATE TABLE `user_check` (
  `check_id` int(200) NOT NULL AUTO_INCREMENT COMMENT '证件验证代码',
  `user_id` int(100) DEFAULT NULL COMMENT '会员代码',
  `peroid` int(2) DEFAULT NULL COMMENT '时期名 1：高中 2：本科 3：硕士 4：博士 5：工作 6：实习 7：公益 8：创业 9：其他',
  `unit` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '所在单位 1-4：学校名称 5：公司 6：实习单位 7：公益项目 8：公司名称 9：经历描述',
  `position` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '职位 时期名为1：文/理/综合/艺术/体育/其他特长 2-5：专业 6：职位 7-9：内容 ',
  `start_time` int(20) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(20) DEFAULT NULL COMMENT '结束时间',
  `qualification` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '证件图片',
  `qualification_No` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '证件号码',
  PRIMARY KEY (`check_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_check
-- ----------------------------

-- ----------------------------
-- Table structure for `user_event_check_copy`
-- ----------------------------
DROP TABLE IF EXISTS `user_event_check_copy`;
CREATE TABLE `user_event_check_copy` (
  `check_id` int(200) NOT NULL AUTO_INCREMENT COMMENT '证件验证代码',
  `user_id` int(100) DEFAULT NULL COMMENT '会员代码',
  `peroid` int(2) DEFAULT NULL COMMENT '时期名 1：高中 2：本科 3：硕士 4：博士 5：工作 6：实习 7：公益 8：创业 9：其他',
  `unit` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '所在单位 1-4：学校名称 5：公司 6：实习单位 7：公益项目 8：公司名称 9：经历描述',
  `position` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '职位 时期名为1：文/理/综合/艺术/体育/其他特长 2-5：专业 6：职位 7-9：内容 ',
  `start_time` int(20) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(20) DEFAULT NULL COMMENT '结束时间',
  `qualification` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '证件名称',
  `qualification_NO` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '证件号码',
  PRIMARY KEY (`check_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_event_check_copy
-- ----------------------------

-- ----------------------------
-- Table structure for `user_order`
-- ----------------------------
DROP TABLE IF EXISTS `user_order`;
CREATE TABLE `user_order` (
  `order_id` int(100) NOT NULL COMMENT '订单代码',
  `user_id` int(100) DEFAULT NULL COMMENT '用户代码',
  `self_intro_id` int(100) DEFAULT NULL COMMENT '简历代码',
  `order_date` int(20) DEFAULT NULL COMMENT '加入订单时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_order
-- ----------------------------

-- ----------------------------
-- Table structure for `user_self_intro`
-- ----------------------------
DROP TABLE IF EXISTS `user_self_intro`;
CREATE TABLE `user_self_intro` (
  `self_intro_id` int(100) NOT NULL AUTO_INCREMENT COMMENT '简历代码',
  `user_id` int(100) DEFAULT NULL COMMENT '用户代码',
  `peroid` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '时期名',
  `brief` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT '简介',
  `book_link` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '书籍链接',
  `content` varchar(3000) CHARACTER SET utf8 DEFAULT NULL COMMENT '详细内容',
  `gain` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '取得成就',
  `start_time` int(20) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(20) DEFAULT NULL COMMENT '结束时间',
  `key` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT '关键事件',
  `level` int(10) DEFAULT NULL COMMENT '事件等级',
  PRIMARY KEY (`self_intro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_self_intro
-- ----------------------------

-- ----------------------------
-- Table structure for `user_self_intro_upvote`
-- ----------------------------
DROP TABLE IF EXISTS `user_self_intro_upvote`;
CREATE TABLE `user_self_intro_upvote` (
  `self_intro_id` int(100) NOT NULL COMMENT '简历代码',
  `user_id` int(100) DEFAULT NULL COMMENT '用户代码',
  `up_vote` tinyint(1) DEFAULT NULL COMMENT '点赞 0：没啥用； 1：真有用；',
  `up_vote_content` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '点赞内容',
  `up_vote_pic` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '点赞图片',
  `up_vote_date` int(20) DEFAULT NULL COMMENT '点赞时间',
  PRIMARY KEY (`self_intro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_self_intro_upvote
-- ----------------------------
