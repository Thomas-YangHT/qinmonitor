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
-- 正在导出表  moninfo.monports 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `monports` DISABLE KEYS */;
INSERT INTO `monports` (`id`, `portsnames`, `ports`, `protocols`) VALUES
	(1, 'http https mysql 8090 2201ssh 8080 8081 8082 8093 8014 2181', '80 443 3306 8090 2201 8080 8081 8082 8093 8014 2181', 'TTTTTTTTTT'),
	(2, '6379 26379 26380 26381 8096 8066 9066 80 27017', '6379 26379 26380 26381 8096 8066 9066 80 27017', 'TTTTTTTTT');
/*!40000 ALTER TABLE `monports` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
