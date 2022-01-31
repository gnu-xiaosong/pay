-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-01-27 00:34:49
-- 服务器版本： 5.7.28
-- PHP 版本： 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `pay`
--

-- --------------------------------------------------------

--
-- 表的结构 `pay_admin`
--

CREATE TABLE `pay_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '管理员账号',
  `password` varchar(255) NOT NULL COMMENT '管理员密码',
  `status` int(1) NOT NULL COMMENT '状态',
  `QQ` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL COMMENT '管理员登陆token值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是管理员配置信息表';

--
-- 转存表中的数据 `pay_admin`
--

INSERT INTO `pay_admin` (`id`, `username`, `password`, `status`, `QQ`, `email`, `token`) VALUES
(1, 'admin', 'xskj', 1, '1829134124', '1829134124@qq.com', 'YWRtaW4zYjM2ZTllNzQ3ODNhODZhY2U2Y2Q4YWExYjc2OTNjNXhza2o3MzEyNQ==');

-- --------------------------------------------------------

--
-- 表的结构 `pay_email`
--

CREATE TABLE `pay_email` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `smtp` varchar(20) NOT NULL COMMENT '邮箱服务器地址',
  `smtp_port` int(6) NOT NULL COMMENT '邮箱服务器端口',
  `smtp_password` varchar(48) NOT NULL COMMENT '邮箱授权码',
  `email_receive` varchar(100) NOT NULL COMMENT '接收邮箱账号',
  `email` varchar(255) NOT NULL COMMENT '邮箱账号',
  `name` varchar(255) NOT NULL COMMENT '发件人昵称'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮箱设置';

--
-- 转存表中的数据 `pay_email`
--

INSERT INTO `pay_email` (`id`, `smtp`, `smtp_port`, `smtp_password`, `email_receive`, `email`, `name`) VALUES
(1, 'smtp.qq.com', 465, 'cdmctdxzwhqhehgb', '1829134124@qq.com', '1829134124@qq.com', '云支付系统'),
(1, 'smtp.qq.com', 465, 'cdmctdxzwhqhehgb', '1829134124@qq.com', '1829134124@qq.com', '云支付系统'),
(1, 'smtp.qq.com', 465, 'cdmctdxzwhqhehgb', '1829134124@qq.com', '1829134124@qq.com', '云支付系统'),
(1, 'smtp.qq.com', 465, 'cdmctdxzwhqhehgb', '1829134124@qq.com', '1829134124@qq.com', '云支付系统');

-- --------------------------------------------------------

--
-- 表的结构 `pay_order`
--

CREATE TABLE `pay_order` (
  `id` int(11) NOT NULL COMMENT '订单id',
  `user_id` int(11) NOT NULL COMMENT '商户id',
  `money` varchar(255) NOT NULL COMMENT '付款金额',
  `pay_act_type` varchar(255) NOT NULL COMMENT '付款类型',
  `pay_tag` varchar(255) NOT NULL COMMENT '订单备注',
  `status` int(2) NOT NULL COMMENT '支付状态',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名',
  `type` int(2) NOT NULL COMMENT '支付类型',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '订单创建时间',
  `order_no` varchar(255) NOT NULL COMMENT '云端流水号(订单编号)',
  `trade_no` varchar(255) NOT NULL COMMENT '订单编号(用户端真实订单编号)',
  `pay_id` int(255) NOT NULL COMMENT '付款用户唯一标识',
  `description` varchar(255) NOT NULL COMMENT '商品描述',
  `category` varchar(255) NOT NULL COMMENT '商品分类'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pay_order`
--

INSERT INTO `pay_order` (`id`, `user_id`, `money`, `pay_act_type`, `pay_tag`, `status`, `goods_name`, `type`, `time`, `order_no`, `trade_no`, `pay_id`, `description`, `category`) VALUES
(1, 1, '212454', '575454', '645455454', 1, '一二监控', 0, '2021-02-23 09:36:08', '', '', 0, '', ''),
(15, 1, '20211314520', '575454', '645455454', 1, '一二监控', 0, '2021-02-23 09:36:08', '', '', 0, '', ''),
(19, 1, '20211314520', '575454', '645455454', 1, '一二监控', 0, '2021-02-23 09:36:08', '', '', 0, '', ''),
(26, 10008, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-26 20:37:32', '10008120210227043732', '1000000001', 1, '未描述商品', ''),
(27, 10001, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-26 20:40:43', '10001120210227044043', '1000000001', 1, '未描述商品', ''),
(28, 10001, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-26 20:46:01', '10001120210227044601', '1000000001', 1, '未描述商品', ''),
(29, 10001, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-26 20:55:02', '10001120210227045502', '1000000001', 1, '未描述商品', ''),
(30, 10009, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 20:33:20', '10009120210228043319', '1000000001', 1, '未描述商品', ''),
(31, 10009, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 20:36:09', '10009120210228043609', '1000000001', 1, '未描述商品', ''),
(32, 10009, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-27 20:37:18', '10009120210228043718', '1000000001', 1, '未描述商品', ''),
(33, 10009, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-27 20:40:48', '10009120210228044048', '1000000001', 1, '未描述商品', ''),
(34, 10009, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-27 20:44:50', '10009120210228044450', '1000000001', 1, '未描述商品', ''),
(35, 10009, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-27 20:57:03', '10009120210228045703', '1000000001', 1, '未描述商品', ''),
(36, 10009, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-27 20:58:23', '10009120210228045823', '1000000001', 1, '未描述商品', ''),
(37, 10009, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-27 21:05:13', '10009120210228050513', '1000000001', 1, '未描述商品', ''),
(38, 10001, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 21:21:14', '10001120210228052114', '1000000001', 1, '未描述商品', ''),
(39, 10001, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 21:28:40', '10001120210228052840', '1000000001', 1, '未描述商品', ''),
(40, 10001, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 21:32:26', '10001120210228053226', '1000000001', 1, '未描述商品', ''),
(41, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 21:45:02', '10010120210228054502', '1000000001', 1, '未描述商品', ''),
(42, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 21:55:10', '10010120210228055510', '1000000001', 1, '未描述商品', ''),
(43, 10010, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-27 21:55:39', '10010120210228055539', '1000000001', 1, '未描述商品', ''),
(44, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 21:56:23', '10010120210228055623', '1000000001', 1, '未描述商品', ''),
(45, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-27 22:59:12', '10010120210228065912', '1000000001', 1, '未描述商品', ''),
(46, 10010, '0.01', '3', '未备注商品', 1, '测试商品', 3, '2021-02-28 06:38:51', '10010120210228143851', '1000000001', 1, '未描述商品', ''),
(47, 10010, '0.01', '2', '未备注商品', 1, '测试商品', 2, '2021-02-28 06:38:55', '10010120210228143855', '1000000001', 1, '未描述商品', ''),
(48, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-28 06:39:24', '10010120210228143924', '1000000001', 1, '未描述商品', ''),
(49, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-28 06:46:44', '10010120210228144644', '1000000001', 1, '未描述商品', ''),
(50, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-28 07:01:33', '10010120210228150133', '1000000001', 1, '未描述商品', ''),
(51, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-02-28 07:06:56', '10010120210228150656', '1000000001', 1, '未描述商品', ''),
(52, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:07:15', '1001020210301200715', '1000000001', 0, '未描述商品', ''),
(53, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:07:16', '1001020210301200716', '1000000001', 0, '未描述商品', ''),
(54, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:09:30', '1001020210301200930', '1000000001', 0, '未描述商品', ''),
(55, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:09:30', '1001020210301200930', '1000000001', 0, '未描述商品', ''),
(56, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:12:36', '1001020210301201236', '1000000001', 0, '未描述商品', ''),
(57, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:12:36', '1001020210301201236', '1000000001', 0, '未描述商品', ''),
(58, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:12:47', '1001020210301201247', '1000000001', 0, '未描述商品', ''),
(59, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:12:48', '1001020210301201248', '1000000001', 0, '未描述商品', ''),
(60, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:13:18', '1001020210301201318', '1000000001', 0, '未描述商品', ''),
(61, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:13:18', '1001020210301201318', '1000000001', 0, '未描述商品', ''),
(62, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:13:43', '1001020210301201343', '1000000001', 0, '未描述商品', ''),
(63, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:13:43', '1001020210301201343', '1000000001', 0, '未描述商品', ''),
(64, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:13:52', '1001020210301201352', '1000000001', 0, '未描述商品', ''),
(65, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:13:53', '1001020210301201353', '1000000001', 0, '未描述商品', ''),
(66, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:14:26', '1001020210301201426', '1000000001', 0, '未描述商品', ''),
(67, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:14:26', '1001020210301201426', '1000000001', 0, '未描述商品', ''),
(68, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:15:07', '1001020210301201507', '1000000001', 0, '未描述商品', ''),
(69, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:15:08', '1001020210301201508', '1000000001', 0, '未描述商品', ''),
(70, 10010, 'undefined', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:15:31', '1001020210301201531', '1000000001', 0, '未描述商品', ''),
(71, 10010, 'undefined', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:15:31', '1001020210301201531', '1000000001', 0, '未描述商品', ''),
(72, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:16:21', '1001020210301201621', '1000646466855', 0, '未描述商品', ''),
(73, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:16:21', '1001020210301201621', '1000646466855', 0, '未描述商品', ''),
(74, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:17:58', '1001020210301201758', '1000646466855', 0, '未描述商品', ''),
(75, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:17:59', '1001020210301201759', '1000646466855', 0, '未描述商品', ''),
(76, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:18:22', '1001020210301201821', '10006466855', 0, '未描述商品', ''),
(77, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:18:22', '1001020210301201822', '10006466855', 0, '未描述商品', ''),
(78, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:20:42', '1001020210301202042', '1000640055', 0, '未描述商品', ''),
(79, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:20:43', '1001020210301202043', '1000640055', 0, '未描述商品', ''),
(80, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:22:56', '1001020210301202256', '1000640055555', 0, '未描述商品', ''),
(81, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:22:56', '1001020210301202256', '1000640055555', 0, '未描述商品', ''),
(82, 10010, '0.01', '', '未备注商品', 1, '测试商品', 0, '2021-03-01 12:29:58', '1001020210301202958', '1555555', 0, '未描述商品', ''),
(83, 10010, '0.01', '', '未备注商品', 0, '测试商品', 0, '2021-03-01 12:29:58', '1001020210301202958', '1555555', 0, '未描述商品', ''),
(84, 10010, '0.01', '', '未备注商品', 1, '测试商品', 1, '2021-03-01 12:46:05', '1001020210301204605', '1555888555', 0, '未描述商品', ''),
(85, 10010, '0.01', '', '未备注商品', 1, '测试商品', 1, '2021-03-01 12:46:06', '1001020210301204606', '1555888555', 0, '未描述商品', ''),
(86, 10010, '0.01', '', '未备注商品', 0, '测试商品', 1, '2021-03-01 12:48:55', '1001020210301204855', '1555888555', 0, '未描述商品', ''),
(87, 10010, '0.01', '', '未备注商品', 0, '测试商品', 1, '2021-03-01 12:48:55', '1001020210301204855', '1555888555', 0, '未描述商品', ''),
(88, 10010, '0.01', '', '未备注商品', 1, '测试商品', 1, '2021-03-01 12:49:03', '1001020210301204903', '1555888000555', 0, '未描述商品', ''),
(89, 10010, '0.01', '', '未备注商品', 1, '测试商品', 1, '2021-03-01 12:49:03', '1001020210301204903', '1555888000555', 0, '未描述商品', ''),
(90, 10010, '0.01', '1', '未备注商品', 1, '测试商品', 1, '2021-03-01 13:11:57', '10010120210301211157', '1555888000555', 1, '未描述商品', ''),
(91, 10010, '0.01', '', '未备注商品', 0, '测试商品', 1, '2021-03-01 13:16:32', '1001020210301211632', '1555888000555', 0, '未描述商品', ''),
(92, 10010, '0.01', '', '未备注商品', 0, '测试商品', 1, '2021-03-01 13:16:32', '1001020210301211632', '1555888000555', 0, '未描述商品', ''),
(93, 10010, '0.01', '1', '未备注商品', 0, '测试商品', 1, '2021-03-01 13:16:39', '10010120210301211639', '1555888000555', 1, '未描述商品', ''),
(94, 10010, '0.01', '', '未备注商品', 0, '测试商品', 2, '2021-03-01 13:16:45', '1001020210301211645', '1555888000555', 0, '未描述商品', ''),
(95, 10010, '0.01', '', '未备注商品', 0, '测试商品', 2, '2021-03-01 13:16:47', '1001020210301211647', '1555888000555', 0, '未描述商品', ''),
(96, 10010, '0.01', '', '未备注商品', 0, '测试商品', 2, '2021-03-01 14:29:38', '1001020210301222938', '1555888000555', 0, '未描述商品', ''),
(99, 10001, '0.01', '1', '未备注商品', 0, '测试商品', 1, '2022-01-25 15:17:49', '10001120220125231749', '20220125', 1, '未描述商品', '无'),
(100, 10001, '0.01', '1', '未备注商品', 0, '测试商品', 1, '2022-01-25 15:29:03', '10001120220125232903', '20220125', 1, '未描述商品', '无分类'),
(101, 10001, '0.01', '1', '未备注商品category=无分类', 0, '测试商品', 1, '2022-01-25 15:32:12', '10001120220125233212', '20220125', 1, '未描述商品', '无分类');

-- --------------------------------------------------------

--
-- 表的结构 `pay_orderhistory`
--

CREATE TABLE `pay_orderhistory` (
  `id` int(11) NOT NULL COMMENT '主码',
  `userID` int(255) NOT NULL COMMENT '商户ID值',
  `time` varchar(255) NOT NULL COMMENT '订单创建时间',
  `tenantOrderNo` varchar(255) NOT NULL COMMENT '商户订单号',
  `zfbOrderNo` varchar(255) NOT NULL COMMENT '支付宝交易号',
  `money` float NOT NULL COMMENT '金额',
  `userInformation` varchar(255) NOT NULL COMMENT '买家信息',
  `status` varchar(255) NOT NULL COMMENT '交易状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='记录订单信息表';

--
-- 转存表中的数据 `pay_orderhistory`
--

INSERT INTO `pay_orderhistory` (`id`, `userID`, `time`, `tenantOrderNo`, `zfbOrderNo`, `money`, `userInformation`, `status`) VALUES
(1, 10001, 'undefined', 'undefined', 'undefined', 100, 'undefined', 'undefined'),
(2, 10001, 'undefined', 'undefined', 'undefined', 200, 'undefined', 'undefined');

-- --------------------------------------------------------

--
-- 表的结构 `pay_pay`
--

CREATE TABLE `pay_pay` (
  `ID` int(11) NOT NULL COMMENT 'ID',
  `alipay_id` varchar(30) DEFAULT NULL COMMENT '支付宝ID',
  `alipay_private_key` longtext NOT NULL COMMENT '应用私钥',
  `alipay_public_key` text NOT NULL COMMENT '支付宝公钥',
  `wx_id` varchar(19) NOT NULL COMMENT '微信APPID',
  `wx_appid` varchar(100) NOT NULL COMMENT '微信MCHID',
  `wx_miniid` varchar(255) NOT NULL COMMENT '微信小程序支付id',
  `wx_mchid` varchar(255) NOT NULL COMMENT '微信mch_id',
  `wx_secret` varchar(100) NOT NULL COMMENT '微信SECRET',
  `wx_key` varchar(100) NOT NULL COMMENT '微信秘钥KEY',
  `qq_mchid` varchar(400) NOT NULL COMMENT 'QQMCHID',
  `qq_mchkey` varchar(500) NOT NULL COMMENT 'QQMCHKEY',
  `epay_id` varchar(28) NOT NULL COMMENT '易支付商户ID',
  `epay_key` varchar(200) NOT NULL COMMENT '易支付商户秘钥KEY',
  `codepay_id` varchar(20) NOT NULL COMMENT '码支付商户id',
  `codepay_key` varchar(30) NOT NULL COMMENT '码支付商户秘钥key',
  `pay_opt` varchar(39) NOT NULL COMMENT '支付方式选择',
  `epay_site` varchar(39) NOT NULL COMMENT '易支付接口',
  `codepay_site` varchar(39) NOT NULL COMMENT '码支付接口'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pay_pay`
--

INSERT INTO `pay_pay` (`ID`, `alipay_id`, `alipay_private_key`, `alipay_public_key`, `wx_id`, `wx_appid`, `wx_miniid`, `wx_mchid`, `wx_secret`, `wx_key`, `qq_mchid`, `qq_mchkey`, `epay_id`, `epay_key`, `codepay_id`, `codepay_key`, `pay_opt`, `epay_site`, `codepay_site`) VALUES
(0, '2021000117611362', 'MIIEpAIBAAKCAQEAhTHJnoFq/CsR80/mbjK3QrQ/Am789dEWwBDmu9LE3yLS8TV8YJ27nlZRJYmyBEkcMRchRt9PVyVfm7QOxFT2IwsGIpiDfcxFwxuetpEZklD7PEitVzuM40b8w8aW3uAN3KQkaTxT3vnnmAKPNyhM0EsKILuQqIt2TwmGb9VBT96cgv8SjxHcDRH5ZXP80I1G445Tmap3BxtOEfqvCVcA+SHaW8wzAObr9QWLyeKiw7QntEEHiZCpqBC+osmdb2TY5l/fdG4xFKD83pcHpPcbFUGRkwZv8bjf3Ig6paMIvWdU1POSWSWyKzSoSCQfoDcy3fpuB5/943v8bkABr3R14QIDAQABAoIBADwlxpGAieqEHKAOldVvq5hAwy97JVpwaGClgTySKntFQ5LPf3I16JLREeXsr2oGBegZNNrHXxHQe8NZZU29vEUI5mVbEA4P3/UClQKGtdCAJ2QKwdRhvPapiN1z4Y+WCEx6B0NKjelkWvQnO7tBxKZPLKypZuLlz7BTcdUwrUS+bLGWGxpoCzjJJ8BvFFKgl7Z61qzSr9q21sglCGEMYTsiKjiODksqDamc6oDEibTzVpilM8ckEN42/kFXnEYHzactnJ8Bjx2eKlCGPmUkkv1PjIMgmvAlQueHaHmHfgPtfxvCPRlSaFAofmoeUiSF04qX8Pf+JOYEyuucJCk05h0CgYEA5QLX0AZ0coNbft6hzS0buTEasGDg8p8y88n9wemE1om2CuBVMAcUxp4Oa+Fymgso7IqnKe2yMyOafdJDa/lxtD1MMbsQjR9HNzuEmfQQP7wa8X2dFhCtp26B79Ink5oSSjwOgGgAhQtrEO+H3R3xrE6Uu8tjt4pl3BhwF57rR/MCgYEAlOQzx3+rXjvVJbLVkgTIs06f6olILv3BkebMBc1noOuFVXmTp0hlPhLBE+eC/+kspWUHbtUkiZRwm/dsxht6RPFdEWBsfdyeGY3tIUFb39axpIzF/At6w16iIfRyt1wQV4d0A66GvneSCQVE1LSq2jqhckJ4oKda9KyztVJls9sCgYEA34dG3uVuA9fzFoJ3q6y7wqcLRd1Js4dwVER0SzGDV2RTK4qLm7VNsg/UQ7hqA7Gg4ED1qRc5OHEn+mehJ2LyeNrb5C6SmSxOdrrBUwPGWG9iXRQen8rntOVILq0RtCBOeebkwLDC0Rm0B3PFSS5RFb4drq93RU7w3UN9JZEYVcECgYBS4weAVC6OczihmAEVHNyuFWMpKeupXVLZambCBCtghjzf7KKqSb8y4zXhYsymsqRMHwYYSUfh32UhLoi7cKiMoOFyvv8mwh6xkzUjgkMnRVn3hPbi7XEWOiSASpliQjpGv/1x30Lb3azKoMhEsZ87hdBCz4ZfyUr1Uv9oPcqoaQKBgQCVfQet7L3Ml5JypoXmdkfIjNU6ILayhE9H8k9LePnp+ZJJCF71ysFYbcmDVmcr8ogdUBjy9F/YxuZ02rU0m9TJE/wFU4q63YPp6D81EvnGbcEacDrrKqw5hbxEya+k7h+S8CDWBD2+nHNGJk9pSGKVIE6BK+GQtP5o1VRKdwuvrw==', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0NwgbVSYAR9bIUpad+F3k54X4xgY+3Z+7rpr30TrKxvrxsDUqiBdp/LhMxqExcp2M+TO9m7fima3Opfi7AJzuse+oaUXSzCQAu1WqytZgxlCnQZJ/tuFjHKThbA3mIyYQNq32DpOYow4LZs8Md4iJ0E69wj6zo2Hmu4zE4fWky7yJ55ikZuAeChZ7joW+MJMuE3Nkkq/fuhNRlfVFdC41kRURVqs8j7rsenRrEg8jPY5S0668QoltKt00XhBEUVuhMoTTZgkZJinmRLmRfxrxEfpZdoTQCCqVvUdvuudHgMSM8PAdDxw+Ge1tXtV7C4n6btgfJm4IlIUnEZAiHIGwwIDAQAB', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(0, '2021000117611362', 'MIIEpAIBAAKCAQEAhTHJnoFq/CsR80/mbjK3QrQ/Am789dEWwBDmu9LE3yLS8TV8YJ27nlZRJYmyBEkcMRchRt9PVyVfm7QOxFT2IwsGIpiDfcxFwxuetpEZklD7PEitVzuM40b8w8aW3uAN3KQkaTxT3vnnmAKPNyhM0EsKILuQqIt2TwmGb9VBT96cgv8SjxHcDRH5ZXP80I1G445Tmap3BxtOEfqvCVcA+SHaW8wzAObr9QWLyeKiw7QntEEHiZCpqBC+osmdb2TY5l/fdG4xFKD83pcHpPcbFUGRkwZv8bjf3Ig6paMIvWdU1POSWSWyKzSoSCQfoDcy3fpuB5/943v8bkABr3R14QIDAQABAoIBADwlxpGAieqEHKAOldVvq5hAwy97JVpwaGClgTySKntFQ5LPf3I16JLREeXsr2oGBegZNNrHXxHQe8NZZU29vEUI5mVbEA4P3/UClQKGtdCAJ2QKwdRhvPapiN1z4Y+WCEx6B0NKjelkWvQnO7tBxKZPLKypZuLlz7BTcdUwrUS+bLGWGxpoCzjJJ8BvFFKgl7Z61qzSr9q21sglCGEMYTsiKjiODksqDamc6oDEibTzVpilM8ckEN42/kFXnEYHzactnJ8Bjx2eKlCGPmUkkv1PjIMgmvAlQueHaHmHfgPtfxvCPRlSaFAofmoeUiSF04qX8Pf+JOYEyuucJCk05h0CgYEA5QLX0AZ0coNbft6hzS0buTEasGDg8p8y88n9wemE1om2CuBVMAcUxp4Oa+Fymgso7IqnKe2yMyOafdJDa/lxtD1MMbsQjR9HNzuEmfQQP7wa8X2dFhCtp26B79Ink5oSSjwOgGgAhQtrEO+H3R3xrE6Uu8tjt4pl3BhwF57rR/MCgYEAlOQzx3+rXjvVJbLVkgTIs06f6olILv3BkebMBc1noOuFVXmTp0hlPhLBE+eC/+kspWUHbtUkiZRwm/dsxht6RPFdEWBsfdyeGY3tIUFb39axpIzF/At6w16iIfRyt1wQV4d0A66GvneSCQVE1LSq2jqhckJ4oKda9KyztVJls9sCgYEA34dG3uVuA9fzFoJ3q6y7wqcLRd1Js4dwVER0SzGDV2RTK4qLm7VNsg/UQ7hqA7Gg4ED1qRc5OHEn+mehJ2LyeNrb5C6SmSxOdrrBUwPGWG9iXRQen8rntOVILq0RtCBOeebkwLDC0Rm0B3PFSS5RFb4drq93RU7w3UN9JZEYVcECgYBS4weAVC6OczihmAEVHNyuFWMpKeupXVLZambCBCtghjzf7KKqSb8y4zXhYsymsqRMHwYYSUfh32UhLoi7cKiMoOFyvv8mwh6xkzUjgkMnRVn3hPbi7XEWOiSASpliQjpGv/1x30Lb3azKoMhEsZ87hdBCz4ZfyUr1Uv9oPcqoaQKBgQCVfQet7L3Ml5JypoXmdkfIjNU6ILayhE9H8k9LePnp+ZJJCF71ysFYbcmDVmcr8ogdUBjy9F/YxuZ02rU0m9TJE/wFU4q63YPp6D81EvnGbcEacDrrKqw5hbxEya+k7h+S8CDWBD2+nHNGJk9pSGKVIE6BK+GQtP5o1VRKdwuvrw==', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0NwgbVSYAR9bIUpad+F3k54X4xgY+3Z+7rpr30TrKxvrxsDUqiBdp/LhMxqExcp2M+TO9m7fima3Opfi7AJzuse+oaUXSzCQAu1WqytZgxlCnQZJ/tuFjHKThbA3mIyYQNq32DpOYow4LZs8Md4iJ0E69wj6zo2Hmu4zE4fWky7yJ55ikZuAeChZ7joW+MJMuE3Nkkq/fuhNRlfVFdC41kRURVqs8j7rsenRrEg8jPY5S0668QoltKt00XhBEUVuhMoTTZgkZJinmRLmRfxrxEfpZdoTQCCqVvUdvuudHgMSM8PAdDxw+Ge1tXtV7C4n6btgfJm4IlIUnEZAiHIGwwIDAQAB', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `pay_system`
--

CREATE TABLE `pay_system` (
  `id` int(11) NOT NULL COMMENT 'id值',
  `pay_api` varchar(255) NOT NULL COMMENT '支付接口地址',
  `title` varchar(255) NOT NULL COMMENT '网站标题',
  `description` varchar(255) NOT NULL COMMENT '网站描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='网站系统配置表';

--
-- 转存表中的数据 `pay_system`
--

INSERT INTO `pay_system` (`id`, `pay_api`, `title`, `description`) VALUES
(1, 'http://pay.xskj.store/api', '小松云支付', '测试支付系统');

-- --------------------------------------------------------

--
-- 表的结构 `pay_user`
--

CREATE TABLE `pay_user` (
  `id` int(11) NOT NULL COMMENT '商户ID',
  `key` varchar(255) NOT NULL COMMENT '商户秘钥',
  `rate` varchar(8) NOT NULL COMMENT '费率',
  `email` varchar(255) NOT NULL COMMENT '电子邮件',
  `phone` varchar(11) NOT NULL COMMENT '电话号码',
  `QQ` varchar(12) NOT NULL COMMENT 'qq',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `account` varchar(255) NOT NULL COMMENT '账户余额',
  `level` varchar(12) NOT NULL COMMENT '用户级别',
  `style` varchar(12) NOT NULL COMMENT '实时结算',
  `token` varchar(255) NOT NULL COMMENT 'token值',
  `status` int(2) NOT NULL COMMENT '状态',
  `alipay_qr_url` varchar(255) NOT NULL COMMENT '用户支付宝收款码url',
  `notify_url` varchar(25) NOT NULL COMMENT '异步通知地址',
  `return_url` varchar(25) NOT NULL COMMENT '同步通知地址,用于付款成功后跳转地址',
  `outTime` varchar(25) NOT NULL COMMENT '付款超时时间',
  `username` varchar(25) NOT NULL COMMENT '登陆用户名',
  `password` varchar(255) NOT NULL COMMENT '登陆用户密码',
  `description` varchar(255) NOT NULL COMMENT '用户个人描述',
  `imim` varchar(255) NOT NULL COMMENT '手机imim信息',
  `wechat_qr_url` varchar(255) NOT NULL COMMENT '用户微信收款码url',
  `qq_qr_url` varchar(255) NOT NULL COMMENT '用户qq收款码url',
  `pay_type` int(1) NOT NULL COMMENT '商户设置的支付方式(0:支付宝;1:微信;3:云支付)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `pay_user`
--

INSERT INTO `pay_user` (`id`, `key`, `rate`, `email`, `phone`, `QQ`, `time`, `account`, `level`, `style`, `token`, `status`, `alipay_qr_url`, `notify_url`, `return_url`, `outTime`, `username`, `password`, `description`, `imim`, `wechat_qr_url`, `qq_qr_url`, `pay_type`) VALUES
(10001, 'ARfXImoK54lgfZmMwHBjO0OcPaAG5DEZ', '', '1829134124@qq.com', '', '1829134124', '2021-09-04 08:12:55', '', '2', '', 'MTc5NGI2NGYyNjU0M2Y2YjM5NWIyMTEwN2M0MjdkM2Y=', 1, '', '', '', '', 'xskj', '3362bc2437166c4bd516ba8c43bf3007', '', '', '', '', 0);

--
-- 转储表的索引
--

--
-- 表的索引 `pay_admin`
--
ALTER TABLE `pay_admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `pay_order`
--
ALTER TABLE `pay_order`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `pay_orderhistory`
--
ALTER TABLE `pay_orderhistory`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `pay_system`
--
ALTER TABLE `pay_system`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `pay_user`
--
ALTER TABLE `pay_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `pay_admin`
--
ALTER TABLE `pay_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `pay_order`
--
ALTER TABLE `pay_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id', AUTO_INCREMENT=102;

--
-- 使用表AUTO_INCREMENT `pay_orderhistory`
--
ALTER TABLE `pay_orderhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主码', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `pay_system`
--
ALTER TABLE `pay_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id值', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `pay_user`
--
ALTER TABLE `pay_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户ID', AUTO_INCREMENT=10002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
