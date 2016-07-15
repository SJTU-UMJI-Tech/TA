-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 03 月 01 日 08:44
-- 服务器版本: 5.6.12
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `prp_ta`
--

-- --------------------------------------------------------

--
-- 表的结构 `ji_comments`
--

CREATE TABLE IF NOT EXISTS `ji_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_model` text COMMENT '模块（page,article,active,newsletter）',
  `comment_model_subid` int(11) DEFAULT NULL COMMENT '模块下的内容的ID',
  `comment_content` text COMMENT '回复内容',
  `comment_time` timestamp NULL DEFAULT NULL COMMENT '回复时间',
  `user_id` text COMMENT 'jaccount ID',
  `comment_status` int(11) DEFAULT '1' COMMENT '默认为1，正常',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `ji_comments`
--

INSERT INTO `ji_comments` (`comment_id`, `comment_model`, `comment_model_subid`, `comment_content`, `comment_time`, `user_id`, `comment_status`) VALUES
(7, 'newsletter', 146, 'Happy Monkey Year!', '2015-12-31 05:11:37', '61125', 1),
(8, 'newsletter', 158, '比猪肉贵多了', '2015-12-31 07:41:02', '22414', 1),
(9, 'newsletter', 155, 'I love JI!', '2015-12-31 08:16:29', '60905', 1),
(10, 'newsletter', 151, 'I love it, because I was born here, and will move to our new building, let''s remember the history of ji via this building with such logo!', '2015-12-31 12:23:22', '02934', 1),
(11, 'newsletter', 145, 'Rocky, I like you to enjoy all events in ji, you will have lots of fans to those high school students, they will have their own dream from your talking! Lots of those younger in china would like to share your wisdom, especially in western area of great china!\r\nBy the way, I also like your Chinese name, ZhuGe Lei(诸葛磊）.', '2015-12-31 12:28:09', '02934', 1),
(12, 'newsletter', 143, 'So beautiful, QQ!', '2015-12-31 12:35:11', '02934', 1),
(13, 'newsletter', 143, 'So beautiful, QQ!', '2015-12-31 12:35:22', '02934', 1),
(14, 'newsletter', 146, 'Golden monkey ! Golden age of Ji''s 10 year old!', '2015-12-31 12:36:57', '02934', 1),
(15, 'newsletter', 158, 'Looking near clearly, everything is beautiful in this world! And you will love it!', '2015-12-31 12:40:10', '02934', 1),
(16, 'newsletter', 152, 'My son Bao Shen (沈豹) is happy to join you all, sharing the same birthday as Shuning Yu.', '2016-01-01 01:40:52', '11194', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_config`
--

CREATE TABLE IF NOT EXISTS `ji_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` text NOT NULL COMMENT '网站名称，出现在所有页面的后面',
  `site_title` text NOT NULL COMMENT '网站标题，首页的名称',
  `site_keywords` text NOT NULL COMMENT '网站首页关键字',
  `site_descript` text NOT NULL COMMENT '网站首页描述',
  `en` int(11) NOT NULL DEFAULT '1' COMMENT '英文版面开关，1为开，0为关',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ji_config`
--

INSERT INTO `ji_config` (`id`, `site_name`, `site_title`, `site_keywords`, `site_descript`, `en`) VALUES
(1, 'UM-SJTU Joint Institute', '', '', 'University of Michigan – Shanghai Jiao Tong University Joint Institute', 1),
(2, 'UM-SJTU Joint Institute', '', '', 'University of Michigan – Shanghai Jiao Tong University Joint Institute', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_file`
--

CREATE TABLE IF NOT EXISTS `ji_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `file_en` int(11) NOT NULL DEFAULT '0' COMMENT '0为中文，1为英文',
  `file_name` text COMMENT '文件名称',
  `file_user` text COMMENT '上传者',
  `file_file` text COMMENT '本地附件路径',
  `file_class` text NOT NULL COMMENT '文件分类',
  `file_url` text COMMENT '远程附件',
  `file_time` text COMMENT '上传时间',
  `file_order` int(11) NOT NULL DEFAULT '10' COMMENT '排序',
  `file_publish` int(11) NOT NULL DEFAULT '1' COMMENT '1为发布状态',
  `file_status` int(11) NOT NULL DEFAULT '1' COMMENT '0为删除进入回收站',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `ji_file`
--

INSERT INTO `ji_file` (`id`, `file_en`, `file_name`, `file_user`, `file_file`, `file_class`, `file_url`, `file_time`, `file_order`, `file_publish`, `file_status`) VALUES
(1, 0, 'JI无线投影仪使用说明书', NULL, 'file20150727185418.pdf', '41', '', '2015-07-27 18:50:31', 10, 1, 1),
(2, 0, 'MATLAB 安装手册[仅面向JI学生和老师]', NULL, 'file20150727185510.pdf', '41', '', '2015-07-27 18:54:44', 10, 1, 1),
(3, 0, 'JI人事管理系统使用手册', NULL, 'file20150727185546.pdf', '41', '', '2015-07-27 18:55:27', 10, 1, 1),
(4, 0, '自助扫描操作流程[俞黎明学生中心]', NULL, 'file20150727185623.pdf', '41', '', '2015-07-27 18:55:53', 10, 1, 1),
(5, 0, '自助一体机操作说明[俞黎明学生中心]', NULL, 'file20150727185637.pdf', '41', '', '2015-07-27 18:56:24', 10, 1, 1),
(6, 0, 'JI会议室预定系统使用手册', NULL, 'file20150727185650.pdf', '41', '', '2015-07-27 18:56:44', 10, 1, 1),
(7, 0, '(JI) Computer Lab Policies and Procedures', NULL, 'file20150818093529.pdf', '41', '', '2015-08-18 9:34:53', 10, 1, 1),
(8, 0, '测试b', 'team22414', 'file20160113102404.jpg', '70', '', '2016-01-13 10:22:02', 10, 1, 1),
(9, 1, 'MSE480+MSE489', '61539', 'file20160113143101.pdf', '70', '', '2016-01-13 10:46:54', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_lanmu`
--

CREATE TABLE IF NOT EXISTS `ji_lanmu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lm_enname` text COMMENT '栏目的英文名称',
  `lm_name` text,
  `lm_pid` int(11) DEFAULT '0',
  `lm_keywords` text,
  `lm_descript` text,
  `lm_order` int(11) NOT NULL DEFAULT '10',
  `lm_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `ji_lanmu`
--

INSERT INTO `ji_lanmu` (`id`, `lm_enname`, `lm_name`, `lm_pid`, `lm_keywords`, `lm_descript`, `lm_order`, `lm_status`) VALUES
(1, 'lab', '实验室设备管理系统', 0, '', '', 10, 1),
(2, 'home', '官网', 0, '', '', 10, 1),
(3, 'it-support', 'IT支持', 0, '', '', 10, 1),
(4, 'help', '帮助', 0, '', '', 10, 1),
(5, 'event', '活动管理', 0, '', '', 10, 1),
(40, 'links', '链接', 3, '', '', 10, 1),
(41, 'documents', '手册', 3, '', '', 10, 1),
(42, 'softwares', '软件', 3, '', '', 10, 1),
(43, 'policy', '须知', 3, '', '', 10, 1),
(44, 'IT Support', 'IT支持', 3, '', '', 10, 1),
(45, 'tutorial', '教程', 3, '', '', 10, 1),
(46, 'me', 'ME', 1, 'ME', 'ME', 10, 1),
(47, 'ece', 'ECE', 1, 'ECE', 'ECE', 10, 1),
(48, 'Equipment', '设备', 46, '', '', 10, 1),
(49, 'Tools', '工具', 46, '', '', 10, 1),
(50, 'Material', '材料', 46, '', '', 10, 1),
(51, 'Equipment', '设备', 47, '', '', 10, 1),
(52, 'Tools', '工具', 47, '', '', 10, 1),
(53, 'message', '参考消息', 4, '', '', 10, 1),
(54, 'slide', '幻灯片', 0, '', '', 10, 1),
(55, '315', '315门口（幻灯片专用）', 54, '', '', 10, 1),
(56, 'slide', '首页幻灯片', 54, '', '', 10, 1),
(57, 'newsletter', 'Newsletter', 0, '', '', 10, 1),
(58, 'What''s new', 'What''s new', 57, '', '', 10, 1),
(59, 'JI stories', 'JI stories', 57, '', '', 10, 1),
(60, 'Share your JI', 'Share your JI', 57, '', '', 10, 1),
(61, 'Announcements', 'Announcements', 57, '', '', 10, 1),
(62, 'Have your say', 'Have your say', 57, '', '', 10, 1),
(63, 'Photo Gallery', 'Photo Gallery', 57, '', '', 10, 1),
(64, '', 'Upcoming Events', 57, '', '', 10, 1),
(65, 'test', 'Test', 0, '', '', 10, 1),
(66, 'ceshi', '二级测试', 65, '', '', 10, 1),
(67, 'equivalence', '转学分系统', 0, '', '', 10, 1),
(70, 'cuhk', 'CUHK', 67, '', '', 10, 1),
(71, '', 'CWRU', 67, '', '', 10, 1),
(72, '', 'ELEG3210', 70, '', '', 10, 1),
(73, '', 'PHYS 166', 71, '', '', 10, 1),
(74, '', 'PHYS 326', 71, '', '', 10, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_lanmu_permission`
--

CREATE TABLE IF NOT EXISTS `ji_lanmu_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `lm_id` int(11) NOT NULL COMMENT '栏目ID',
  `id` int(11) DEFAULT NULL COMMENT '栏目ID，使用page模块',
  `user_id` text NOT NULL COMMENT '管理人ID，一般为工号',
  `permission_status` int(11) NOT NULL DEFAULT '1' COMMENT '默认允许',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `ji_lanmu_permission`
--

INSERT INTO `ji_lanmu_permission` (`permission_id`, `lm_id`, `id`, `user_id`, `permission_status`) VALUES
(0, 0, 0, '这里添加的条目需要是第一级别，不需要第二级别，第二级别会在页面里再进行循环出来。lm_id是栏目的ID值，user_id是用户的登录账号', 1),
(1, 46, 46, '22000', 1),
(2, 47, 47, '22000', 1),
(5, 57, 57, '61125', 1),
(6, 57, 57, '61413', 1),
(7, 65, 65, 'team22414', 1),
(8, 67, 67, '61539', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_page`
--

CREATE TABLE IF NOT EXISTS `ji_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text COMMENT '发布者',
  `page_stage` text COMMENT '第几期（一般为newsletter设置）',
  `page_en` int(11) NOT NULL DEFAULT '0' COMMENT '英文页面对应的中文页面的ID',
  `page_m` int(11) NOT NULL DEFAULT '0' COMMENT '是否为手机版本，1为手机',
  `page_title` text NOT NULL,
  `page_summary` text COMMENT '简要内容',
  `page_lm` int(11) DEFAULT NULL,
  `page_pic` text,
  `page_content` text NOT NULL,
  `page_url` text,
  `page_keywords` text,
  `page_descript` text,
  `page_order` int(11) NOT NULL DEFAULT '10',
  `page_publish` int(11) NOT NULL DEFAULT '1',
  `page_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=161 ;

--
-- 转存表中的数据 `ji_page`
--

INSERT INTO `ji_page` (`id`, `user_id`, `page_stage`, `page_en`, `page_m`, `page_title`, `page_summary`, `page_lm`, `page_pic`, `page_content`, `page_url`, `page_keywords`, `page_descript`, `page_order`, `page_publish`, `page_status`) VALUES
(118, '22414', NULL, 0, 0, 'SAKAI Learning Management System', NULL, 40, '', '', 'http://sakai.umji.sjtu.edu.cn/', '', '', 10, 1, 1),
(119, '22414', NULL, 0, 0, 'JI选课系统', NULL, 40, '', '', 'http://202.120.63.11:8888/', '', '', 10, 1, 1),
(120, '22414', NULL, 0, 0, 'Writing Center Booking System', NULL, 40, NULL, '', 'http://www.bookeo.com/umji-writingcenter/customer', '', '', 10, 1, 1),
(121, '22414', NULL, 0, 0, '会议室预定系统', NULL, 40, NULL, '', 'http://umji.sjtu.edu.cn/bs', '', '', 10, 1, 1),
(122, '22414', NULL, 0, 0, '本科生毕业审核系统', NULL, 40, NULL, '', 'http://202.120.46.152/', '', '', 10, 1, 1),
(123, '22414', NULL, 0, 0, 'Online International Application System', NULL, 43, '', '', 'http://oias.umji.sjtu.edu.cn/', '', '', 10, 1, 1),
(124, '22414', NULL, 0, 0, 'JI人事管理系统', NULL, 43, '', '', 'http://umji.sjtu.edu.cn/its/hrm/cnlanguage.php', '', '', 10, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_slide`
--

CREATE TABLE IF NOT EXISTS `ji_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_en` int(11) NOT NULL DEFAULT '0' COMMENT '0为中文，1为英文',
  `slide_m` int(11) NOT NULL DEFAULT '0',
  `slide_user` text COMMENT '上传者',
  `slide_uploadtime` text COMMENT '上传时间',
  `slide_lm` int(11) DEFAULT NULL COMMENT '栏目分类',
  `slide_title` text,
  `slide_content` text,
  `slide_url` text,
  `slide_pic` text,
  `slide_order` int(11) NOT NULL DEFAULT '10',
  `slide_publish` int(11) NOT NULL DEFAULT '1',
  `slide_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `ji_slide`
--

INSERT INTO `ji_slide` (`id`, `slide_en`, `slide_m`, `slide_user`, `slide_uploadtime`, `slide_lm`, `slide_title`, `slide_content`, `slide_url`, `slide_pic`, `slide_order`, `slide_publish`, `slide_status`) VALUES
(35, 0, 0, 'team22414', '2015-12-07 14:03:27', 55, '这是一个测试', '和哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈', '', 'slide20151207140327.jpg', 10, 1, 1),
(36, 0, 0, 'team22414', '2015-12-07 14:03:57', 55, '这是一个测试sdfs', 'sfdsf', '', 'slide20151207140357.jpg', 10, 1, 1),
(37, 0, 0, 'team22414', '2015-12-07 14:04:07', 55, 'sdfadsfa', '', '', 'slide20151207140407.jpg', 10, 1, 1),
(38, 0, 0, '22414', '2015-12-07 15:09:13', 1, '水电费水电费', '', '', 'slide20151207150913.jpg', 10, 1, 1),
(39, 1, 0, '22414', '2015-12-07 15:23:40', 56, 'sfsdf', '', '', 'slide20151207152340.png', 10, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_user`
--

CREATE TABLE IF NOT EXISTS `ji_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID主键',
  `user_name` text COMMENT '用户的真实名字',
  `user_id` text NOT NULL COMMENT '账户，工号或者学号',
  `user_password` text NOT NULL COMMENT '密码',
  `user_lastlogin` text COMMENT '上次登录时间',
  `user_logintime` text COMMENT '本次登录时间',
  `user_level` int(11) NOT NULL DEFAULT '1' COMMENT '级别，1为管理员，2为编辑，3为监查员',
  `user_status` int(11) NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为封停',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ji_user`
--

INSERT INTO `ji_user` (`id`, `user_name`, `user_id`, `user_password`, `user_lastlogin`, `user_logintime`, `user_level`, `user_status`) VALUES
(1, 'TA', 'ta', 'e10adc3949ba59abbe56e057f20f883e', '2016-03-01 8:40:36', '2016-03-01 8:43:07', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_user_department`
--

CREATE TABLE IF NOT EXISTS `ji_user_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `department_name` text,
  `department_manager` int(11) DEFAULT NULL COMMENT '部门领导USER ID',
  `department_upline` int(11) DEFAULT NULL COMMENT '部门上峰部门ID',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='部门简要信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ji_user_detail`
--

CREATE TABLE IF NOT EXISTS `ji_user_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `user_name` text,
  `user_enname` text,
  `user_id` text COMMENT '学号/工号',
  `user_qq` text COMMENT 'QQ',
  `user_type` text COMMENT '用户类型，本科，研究，职工，教师，教授',
  `user_department` text COMMENT '部门',
  `user_office` text COMMENT '办公室',
  `user_position` text COMMENT '职位',
  `user_enposition` text COMMENT '英文职称',
  `user_country` text COMMENT '国籍',
  `user_tel` text COMMENT '固定电话',
  `user_subtel` text COMMENT '分机',
  `user_mobile` text COMMENT '手机号',
  `user_short` text COMMENT '手机号小号',
  `user_email` text COMMENT '邮箱',
  `user_skype` text COMMENT 'skype账号',
  `user_room` text COMMENT '房间号',
  `user_status` text COMMENT '用户状态',
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ji_user_detail`
--

INSERT INTO `ji_user_detail` (`detail_id`, `user_name`, `user_enname`, `user_id`, `user_qq`, `user_type`, `user_department`, `user_office`, `user_position`, `user_enposition`, `user_country`, `user_tel`, `user_subtel`, `user_mobile`, `user_short`, `user_email`, `user_skype`, `user_room`, `user_status`) VALUES
(1, '皇登攀', 'Dengpan Huang\r\n', '22414', '525562633', 'staff', 'Resource Management', 'IT Office', 'IT工程师', 'IT Engineer', 'China', '34206765', '3181', '139-1665-8320\r\n', '69578', 'dengpan.huang@sjtu.edu.cn', 'huangdengpan\r\n', '318', '1'),
(6, '蔡云龙', 'Yunlong Cai', '22462', '46521345', 'staff', 'RMD', NULL, 'IT技术专员', 'IT Specialist', 'China', '34206765', '3182', '1391665236', '69505', 'caiyunlong@sjtu.edu.cn', 'caiyunlong', '318', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ji_user_log`
--

CREATE TABLE IF NOT EXISTS `ji_user_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_action` text COMMENT '操作内容',
  `log_time` text COMMENT '操作时间',
  `user_id` text COMMENT '操作人ID',
  `log_model` text COMMENT '模块',
  `user_name` text COMMENT '用户名字',
  `user_institute` text COMMENT '用户学院',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=818 ;

--
-- 转存表中的数据 `ji_user_log`
--

INSERT INTO `ji_user_log` (`log_id`, `log_action`, `log_time`, `user_id`, `log_model`, `user_name`, `user_institute`) VALUES
(800, '修改equivalence_course中course_id为181的信息', '2016-02-24 16:32:32', '60366', 'equivalence', '60366', 'JI'),
(801, '修改equivalence_course中course_id为181的信息', '2016-02-24 16:32:43', '60366', 'equivalence', '60366', 'JI'),
(802, '增加equivalence_course中course_id为182的信息', '2016-02-24 16:35:42', '60366', 'equivalence', '60366', 'JI'),
(803, '修改equivalence_course中course_id为182的信息', '2016-02-24 16:36:02', '60366', 'equivalence', '60366', 'JI'),
(804, '修改equivalence_course中course_id为182的信息', '2016-02-24 16:36:36', '60366', 'equivalence', '60366', 'JI'),
(805, 'Jaccount成功后台登陆', '2016-02-25 13:17:48', '22414', 'manage', '22414', 'JI'),
(806, '修改equivalence_course中course_id为58的信息', '2016-02-25 13:18:37', '22414', 'equivalence', '22414', 'JI'),
(807, 'Jaccount成功后台登陆', '2016-02-25 16:11:30', '22414', 'manage', '22414', 'JI'),
(808, 'Jaccount成功后台登陆', '2016-02-27 20:19:30', '60366', 'manage', '60366', 'JI'),
(809, '修改equivalence_course中course_id为45的信息', '2016-02-27 20:20:40', '60366', 'equivalence', '60366', 'JI'),
(810, 'Jaccount成功后台登陆', '2016-02-29 15:42:22', '22414', 'manage', '22414', 'JI'),
(811, '管理员变身为60366', '2016-02-29 15:59:40', '22414', 'manage', '22414', 'JI'),
(812, 'Jaccount成功后台登陆', '2016-02-29 16:01:07', '22414', 'manage', '22414', 'JI'),
(813, '成功后台登陆', '2016-02-29 16:16:07', 'ta', 'manage', 'ta', 'JI'),
(814, '成功后台登陆', '2016-02-29 16:31:21', 'ta', 'manage', 'ta', 'JI'),
(815, '成功后台登陆', '2016-03-01 08:40:36', 'ta', 'manage', 'ta', 'JI'),
(816, '失败后台登陆', '2016-03-01 08:42:59', '名字：22414密码：123456', 'manage', '22414', '202.120.43.187'),
(817, '成功后台登陆', '2016-03-01 08:43:07', 'ta', 'manage', 'ta', 'JI');

-- --------------------------------------------------------

--
-- 表的结构 `ji_user_module`
--

CREATE TABLE IF NOT EXISTS `ji_user_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` text NOT NULL COMMENT '模块标记，一般为功能的url字段',
  `module_name` text COMMENT '模块说明',
  `module_description` text COMMENT '该模块的说明',
  `module_status` int(11) NOT NULL DEFAULT '1' COMMENT '1表示已经完成，0表示正在开发',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='这个只是用来做提示，统计module的数量和信息' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `ji_user_module`
--

INSERT INTO `ji_user_module` (`module_id`, `module`, `module_name`, `module_description`, `module_status`) VALUES
(1, '0', '这个只是用来做提示，统计module的数量和信息', NULL, 1),
(2, 'slide', '焦点图片', '中英文，可设置标题，简介，图片，支持自定义跳转URL及排序功能，可推送给手机端', 1),
(3, 'page', '页面管理', '中英文，可上传代表图片，可归类栏目，支持自定义跳转URL以及SEO，可推送给手机端', 1),
(4, 'article', '媒体新闻', '中英文，可归类栏目，上传代表图片，作者，标签，时间，支持自定义URL跳转以及SEO，可推送给手机端', 1),
(5, 'faculty', '教授讲师', '中英文，涵盖所有基本信息', 1),
(6, 'files', '文件管理', '中英文，支持远程URL', 1),
(7, 'activity', '活动管理', '中英文，可归类栏目，支持自定义URL跳转', 1),
(8, 'tuisong_list', '推送管理', '中英文，首页模块自定义', 1),
(9, 'user', '用户信息', '启用/关闭账户，修改密码，模块权限设置', 1),
(10, 'lanmu', '栏目管理', '支持二级栏目，可升级为无限制等级目录层次', 1),
(11, 'video', '视频管理', '支持远程URL视频设置，暂不支持视频上传功能', 0),
(13, 'config', '网站配置', '基本SEO信息，功能开关', 1),
(14, 'equivalence', '转换学分', '大学管理，转换课程管理，开关大学，开关课程', 1),
(15, 'contactlist', '通讯名录', '正在开发，同事信息管理', 0),
(16, 'gpa', 'GPA/GPD', 'GPA值计算', 1),
(17, 'lab', '设备管理', '实验室设备管理', 1),
(18, 'user_password', '密码修改', '个人修改密码(暂时已经升级为Jaccount,此项搁置不用)', 1),
(19, 'becomeuser', '〓变身〓', '高级管理员变身为普通用户', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ji_user_permission`
--

CREATE TABLE IF NOT EXISTS `ji_user_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text NOT NULL COMMENT '用户账户',
  `module` text NOT NULL COMMENT '模块名称',
  `module_name` text COMMENT '模块中文名称',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `ji_user_permission`
--

INSERT INTO `ji_user_permission` (`permission_id`, `user_id`, `module`, `module_name`) VALUES
(13, '60366', 'equivalence', '转换学分'),
(14, '60366', 'gpa', 'GPA/GPD'),
(16, '22000', 'lab', '设备管理'),
(17, '22000', 'lanmu', '分类管理'),
(19, '61539', 'equivalence', '转换学分'),
(25, '61125', 'page', '页面管理'),
(26, '61125', 'lanmu', '分类管理'),
(27, 'team22414', 'page', '页面管理'),
(28, 'team22414', 'lanmu', '分类管理'),
(29, '61413', 'page', '页面管理'),
(30, '61413', 'lanmu', '分类管理'),
(31, '61539', 'files', '文件管理'),
(32, '61539', 'lanmu', '栏目管理');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
