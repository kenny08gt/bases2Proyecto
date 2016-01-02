\#!bin/bash
archivo=$1
mysql -u root -p bases2 < $archivo
echo Backup restaurado exitosamente de: $archivo
