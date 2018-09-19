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

-- 导出 moninfo 的数据库结构
CREATE DATABASE IF NOT EXISTS `moninfo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `moninfo`;


-- 导出  表 moninfo.bakinfo 结构
CREATE TABLE IF NOT EXISTS `bakinfo` (
  `date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `count` varchar(50) DEFAULT NULL,
  `space` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.baksetting 结构
CREATE TABLE IF NOT EXISTS `baksetting` (
  `ip` varchar(255) DEFAULT NULL,
  `baktype` varchar(50) DEFAULT NULL,
  `baknames` varchar(1024) DEFAULT NULL,
  `bakpolicy` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.hostip 结构
CREATE TABLE IF NOT EXISTS `hostip` (
  `hostname` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.moninfo 结构
CREATE TABLE IF NOT EXISTS `moninfo` (
  `date` char(50) DEFAULT NULL,
  `hostname` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `cpu` varchar(255) DEFAULT NULL,
  `mem` varchar(255) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `net` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\r\n';

-- 数据导出被取消选择。


-- 导出  表 moninfo.moninfohis 结构
CREATE TABLE IF NOT EXISTS `moninfohis` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `date` char(50) DEFAULT NULL,
  `hostname` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `cpu` varchar(255) DEFAULT NULL,
  `mem` varchar(255) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `net` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\r\n';

-- 数据导出被取消选择。


-- 导出  表 moninfo.monports 结构
CREATE TABLE IF NOT EXISTS `monports` (
  `id` tinyint(3) unsigned DEFAULT NULL,
  `portsnames` varchar(1024) DEFAULT NULL,
  `ports` varchar(1024) DEFAULT NULL,
  `protocols` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.portinfo 结构
CREATE TABLE IF NOT EXISTS `portinfo` (
  `date` varchar(50) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `port` varchar(1024) DEFAULT NULL,
  `pid` varchar(1024) DEFAULT NULL,
  `process` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.portinfohis 结构
CREATE TABLE IF NOT EXISTS `portinfohis` (
  `date` varchar(50) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `port` varchar(1024) DEFAULT NULL,
  `pid` varchar(1024) DEFAULT NULL,
  `process` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.portstatusinfo 结构
CREATE TABLE IF NOT EXISTS `portstatusinfo` (
  `ip` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `portstatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.portstatusinfohis 结构
CREATE TABLE IF NOT EXISTS `portstatusinfohis` (
  `ip` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `portstatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 数据导出被取消选择。


-- 导出  表 moninfo.portstatussetting 结构
CREATE TABLE IF NOT EXISTS `portstatussetting` (
  `ip` varchar(50) DEFAULT NULL,
  `monif` varchar(50) DEFAULT NULL,
  `id` tinyint(3) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 moninfo.tailproject 结构
CREATE TABLE IF NOT EXISTS `tailproject` (
  `projname` varchar(50) DEFAULT NULL,
  `logdir` varchar(50) DEFAULT NULL,
  `logfilename` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
