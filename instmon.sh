#instmon.sh
#in all server need to monitor:

echo "*/5 * * * * /usr/bin/python /root/uploadmon.py upmoninfo >/root/upmoninfo.log" >>/var/spool/cron/root
echo "*/5 * * * * /usr/bin/python /root/uploadmon.py selfupdate >/root/selfupdate.log"  >>/var/spool/cron/root
echo "*/5 * * * * /usr/bin/sh /root/nettrafic.sh eth0 >>nettrafic.log"  >>/var/spool/cron/root
/usr/bin/python /root/uploadmon.py upbaseinfo 
/usr/bin/python /root/uploadmon.py downkey