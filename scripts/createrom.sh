#!/bin/sh
cd /var/lib/tftpboot/ipxe/ipxe-git/src/
make bin/undionly.kpxe EMBED=/var/lib/tftpboot/ipxe/script.ipxe > /dev/null 2>&1
cp /var/lib/tftpboot/ipxe/ipxe-git/src/bin/undionly.kpxe /var/lib/tftpboot/
