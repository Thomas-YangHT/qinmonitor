-- --------------------------------------------------------
-- 主机:                           192.168.1.180
-- 服务器版本:                        5.5.50-MariaDB - MariaDB Server
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- 正在导出表  moninfo.hostip 的数据：~40 rows (大约)
/*!40000 ALTER TABLE `hostip` DISABLE KEYS */;
INSERT INTO `hostip` (`hostname`, `ip`) VALUES
	('饭店协会微信平台', ' 119.254.98.237'),
	('静态资源服务器', ' 119.254.98.244'),
	('讯合云官网服务器', ' 119.254.209.185'),
	('酒店协会', ' 124.42.118.216'),
	('wx-wifi-wifi-server-2', ' 192.168.100.25'),
	('wx-wifi-wifi-server-1', ' 192.168.100.27'),
	('cache-hotel-pay-2', ' 192.168.100.29'),
	('cache-hotel-pay-1', ' 192.168.100.30'),
	('operate-ucenter-file-1', ' 192.168.100.31'),
	('operate-ucenter-file-2', ' 192.168.100.32'),
	('dobbo-zookeeper-1', ' 192.168.100.9'),
	('测试dubbo-zookeeper-mysql', ' 192.168.200.2'),
	('测试hotel、food测试服务器', ' 192.168.200.4'),
	('测试致趣-1', ' 192.168.200.8'),
	('测试WIFI业务服务器', ' 192.168.200.3'),
	('wifi服务器-1', ' 192.168.100.7'),
	('wifi服务器-2', ' 192.168.100.11'),
	('支付-2', ' 192.168.100.16'),
	('支付-1', ' 192.168.100.17'),
	('正式环境dubbo', ' 192.168.100.3'),
	('hotel、order、service、cache、lock -1', ' 192.168.100.2'),
	('Nginx-1', ' 192.168.100.6'),
	('Nginx-2', ' 192.168.100.20'),
	('文件系统Nginx', ' 192.168.100.26'),
	('文件系统Mongod', ' 192.168.100.28'),
	('RedisCluster', ' 192.168.100.33'),
	('Redis-slave', ' 192.168.100.34'),
	('Redis', ' 192.168.100.4'),
	('Keepalived-HaProxy-MyCat-1', ' 192.168.100.13'),
	('Keepalived-Haproxy-MyCat-2', ' 192.168.100.14'),
	('MyCat-1', ' 192.168.100.8'),
	('MyCat-2', ' 192.168.100.15'),
	('缓存接口服务器', ' 192.168.100.12'),
	('backup', '192.168.100.21'),
	('数据库虚拟IP', '192.168.100.200'),
	('Nginx虚拟IP', '192.168.100.201'),
	('正式环境路由', '119.254.98.189'),
	('测试环境路由', '124.42.117.69'),
	('监控服务器', '192.168.1.180'),
	('wx-wifi-wifi-server-2-bak', '192.168.100.36');
/*!40000 ALTER TABLE `hostip` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
