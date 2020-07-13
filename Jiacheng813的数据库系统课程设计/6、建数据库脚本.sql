-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3308
-- 生成日期： 2020-06-13 09:03:24
-- 服务器版本： 8.0.18
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `homework1`
--

-- --------------------------------------------------------

--
-- 表的结构 `店铺信息表`
--

DROP TABLE IF EXISTS `店铺信息表`;
CREATE TABLE IF NOT EXISTS `店铺信息表` (
  `id` int(10) NOT NULL,
  `名称` varchar(40) NOT NULL,
  `风味` varchar(40) NOT NULL,
  `地址` varchar(80) NOT NULL,
  `评分` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `店铺信息表`
--

INSERT INTO `店铺信息表` (`id`, `名称`, `风味`, `地址`, `评分`) VALUES
(1, '拴宝水饺', '咸鲜', '南京市玄武区童卫路6号', '6.50'),
(2, '中山陵南京大排档', '清淡', '南京市玄武区中山门大街9号', '6.00'),
(3, '醉东坡', '甜', '南京市玄武区卫岗26号2幢-14号', '6.00'),
(4, '西来顺', '咸', '南京市玄武区小卫街16号2幢-3室', '5.50'),
(5, '海鲜大咖', '辣', '南京市秦淮区苜蓿园后标营88号御品周庄1层', '6.50'),
(6, '褚记北京烤鸭店', '甜鲜', '南京市玄武区小卫街20号', '7.00');

-- --------------------------------------------------------

--
-- 表的结构 `用户信息表`
--

DROP TABLE IF EXISTS `用户信息表`;
CREATE TABLE IF NOT EXISTS `用户信息表` (
  `用户名` varchar(30) NOT NULL,
  `密码` varchar(30) NOT NULL,
  `昵称` varchar(20) DEFAULT NULL,
  `生日` char(8) DEFAULT NULL,
  `地址` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`用户名`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `用户信息表`
--

INSERT INTO `用户信息表` (`用户名`, `密码`, `昵称`, `生日`, `地址`) VALUES
('lixiaohua', '123456', 'xiaohua', '20000513', '北京'),
('sunxiaotao', '123456', 'xiaotao', '20001130', '天津'),
('wangxiaoming', '123456', 'xiaoming', '20000115', '南京'),
('zhangxiaoli', '123456', 'xiaoli', '20000319', '上海'),
('zhaoxiaowei', '123456', 'xiaowei', '19991012', '广州');

-- --------------------------------------------------------

--
-- 表的结构 `用户收藏店铺表`
--

DROP TABLE IF EXISTS `用户收藏店铺表`;
CREATE TABLE IF NOT EXISTS `用户收藏店铺表` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `用户名` varchar(30) NOT NULL,
  `店铺id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `店铺id` (`店铺id`),
  KEY `用户名` (`用户名`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 表的结构 `用户评价店铺表`
--

DROP TABLE IF EXISTS `用户评价店铺表`;
CREATE TABLE IF NOT EXISTS `用户评价店铺表` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `用户名` varchar(30) NOT NULL,
  `店铺id` int(10) NOT NULL,
  `评分` decimal(4,2) NOT NULL,
  `评论` varchar(200) DEFAULT NULL,
  `时间` char(23) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `店铺id` (`店铺id`),
  KEY `用户名` (`用户名`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `用户评价店铺表`
--

INSERT INTO `用户评价店铺表` (`id`, `用户名`, `店铺id`, `评分`, `评论`, `时间`) VALUES
(1, 'wangxiaoming', 6, '9.00', '物美价廉，非常推荐！', '2019年05月03日 20:15:59'),
(2, 'lixiaohua', 5, '7.00', '还可以，味道一般般。', '2019年10月30日 19:20:45'),
(3, 'zhangxiaoli', 4, '2.00', '就餐体验不好，卫生环境较差。', '2019年12月14日 16:05:31'),
(4, 'zhaoxiaowei', 3, '9.00', '烤肉特别好吃，强烈推荐。', '2020年02月09日 12:13:28'),
(5, 'sunxiaotao', 2, '6.00', '招牌菜还不错，就是排队太慢了。', '2020年04月17日 18:45:08'),
(6, 'zhaoxiaowei', 1, '5.00', '菜品口味不好，下次不会再来了。', '2019年05月27日 09:34:18'),
(7, 'wangxiaoming', 1, '8.00', '物美价廉，非常推荐！', '2019年06月13日 10:15:59'),
(8, 'sunxiaotao', 5, '6.00', '招牌菜还不错，就是排队太慢了。', '2020年04月27日 14:45:08'),
(9, 'zhaoxiaowei', 4, '9.00', '烤肉特别好吃，强烈推荐。', '2020年03月05日 14:19:28'),
(10, 'zhangxiaoli', 3, '3.00', '就餐体验不好，卫生环境较差。', '2019年12月24日 13:15:31'),
(11, 'zhaoxiaowei', 6, '5.00', '菜品口味不好，下次不会再来了。', '2019年02月23日 09:54:18'),
(12, 'lixiaohua', 2, '6.00', '还可以，味道一般般。', '2019年11月24日 19:30:45');

--
-- 触发器 `用户评价店铺表`
--
DROP TRIGGER IF EXISTS `comment_delete_trigger`;
DELIMITER $$
CREATE TRIGGER `comment_delete_trigger` AFTER DELETE ON `用户评价店铺表` FOR EACH ROW begin
  	declare store_id int;
  	declare avg_score decimal(4,2);
	set store_id=old.店铺id;
  	set avg_score=(select avg(评分) from `用户评价店铺表` where 店铺id=store_id);
  	update `店铺信息表` set 评分=avg_score where id=store_id;
end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `comment_insert_trigger`;
DELIMITER $$
CREATE TRIGGER `comment_insert_trigger` AFTER INSERT ON `用户评价店铺表` FOR EACH ROW begin
  	declare store_id int;
  	declare avg_score decimal(4,2);
	set store_id=new.店铺id;
  	set avg_score=(select avg(评分) from `用户评价店铺表` where 店铺id=store_id);
  	update `店铺信息表` set 评分=avg_score where id=store_id;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `菜品信息表`
--

DROP TABLE IF EXISTS `菜品信息表`;
CREATE TABLE IF NOT EXISTS `菜品信息表` (
  `id` int(10) NOT NULL,
  `名称` varchar(40) NOT NULL,
  `风味` varchar(40) NOT NULL,
  `菜系` varchar(40) NOT NULL,
  `所属店铺id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `所属店铺id` (`所属店铺id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `菜品信息表`
--

INSERT INTO `菜品信息表` (`id`, `名称`, `风味`, `菜系`, `所属店铺id`) VALUES
(1, '带皮肘子', '鲜', '东北菜', 1),
(2, '虾仁韭菜鸡蛋水饺', '鲜', '东北菜', 1),
(3, '芹菜猪肉水饺', '鲜', '东北菜', 1),
(4, '民国美龄粥', '清淡', '苏菜', 2),
(5, '古法糖芋苗', '甜', '苏菜', 2),
(6, '金陵烤鸭包', '甜鲜', '苏菜', 2),
(7, '招牌盐水鸭', '咸', '苏菜', 2),
(8, '东坡肉', '甜', '川菜', 3),
(9, '酸菜鱼', '辣', '重庆菜', 3),
(10, '爽口鸡', '辣', '川菜', 3),
(11, '干切牛肉面', '咸', '西北菜', 4),
(12, '牛肉锅贴', '甜咸', '西北菜', 4),
(13, '羊肉串', '咸辣鲜', '西北菜', 4),
(14, '蒜泥龙虾', '辣鲜', '粤菜', 5),
(15, '爆炒鱿鱼', '辣', '粤菜', 5),
(16, '炸年糕', '甜', '湘菜', 5),
(17, '北京烤鸭', '甜鲜', '北京菜', 6),
(18, '黄米蒸排骨', '清淡', '北京菜', 6),
(19, '椒盐鸭架', '咸', '北京菜', 6),
(20, '铁板蒜茸焗沙虾', '咸鲜', '北京菜', 6);

--
-- 限制导出的表
--

--
-- 限制表 `用户收藏店铺表`
--
ALTER TABLE `用户收藏店铺表`
  ADD CONSTRAINT `用户收藏店铺表_ibfk_1` FOREIGN KEY (`店铺id`) REFERENCES `店铺信息表` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `用户收藏店铺表_ibfk_2` FOREIGN KEY (`用户名`) REFERENCES `用户信息表` (`用户名`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `用户评价店铺表`
--
ALTER TABLE `用户评价店铺表`
  ADD CONSTRAINT `用户评价店铺表_ibfk_1` FOREIGN KEY (`店铺id`) REFERENCES `店铺信息表` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `用户评价店铺表_ibfk_2` FOREIGN KEY (`用户名`) REFERENCES `用户信息表` (`用户名`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `菜品信息表`
--
ALTER TABLE `菜品信息表`
  ADD CONSTRAINT `菜品信息表_ibfk_1` FOREIGN KEY (`所属店铺id`) REFERENCES `店铺信息表` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
