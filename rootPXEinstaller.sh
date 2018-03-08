#!/bin/sh
if ! [ $(whoami) = "root" ] ; then
  echo "Need root permissions, exec this file as root"
  exit;
fi

echo "\n\nThis script will install rootPXE and bootstrapping script for PXE->iPXE->HTTP Imaging/booting with DHCP, TFTP, PXE, iPXE, Apache, MYSQL"




if [ $CUSTOMVHOSTCONFIG ] ; then
  echo "Do something"
else
sed -i -e 's$/var/www/html$/var/www/$g' /etc/apache2/sites-availible/000-default.conf
fi


if [ $CUSTOMTFTPCONFIG ] ; then

else
echo "# /etc/default/tftpd-hpa\n\
\n\
TFTP_USERNAME=\"tftp\"\n\
TFTP_ADDRESS=\"10.0.0.254:69\"\n\
TFTP_OPTIONS=\"-l -s /var/lib/tftpboot\"\n
RUN_DAEMON=\"yes\""
fi




if [ $CUSTOMROMMINGSCRIPT ] ; then
  echo "Do something"
else
echo "#!/bin/sh\n\n\
cd /var/lib/tftpboot/ipxe/ipxe-git/src/\n\
make bin/undionly.kpxe EMBED=/var/lib/tftpboot/ipxe/script.ipxe > /dev/null 2>&1\n\
cp /var/lib/tftpboot/ipxe/ipxe-git/src/bin/undionly.kpxe /var/lib/tftpboot"fi
