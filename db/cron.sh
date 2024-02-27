#!/bin/bash
cd /var/www/html/mbilling/db/
rm -f base.sql
rm -f base..tar.gz

mysqldump mbilling > base.sql
tar -czf base.tar.gz base.sql

HOST='45.70.210.6'
usuario='magnus'
senha='Mel@2307'

arquivo='base.tar.gz'


ftp -n $HOST <<END_SCRIPT
user ${usuario} ${senha}
prompt
mput $arquivo
quit
END_SCRIPT
exit 0
