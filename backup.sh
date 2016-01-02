#!/bin/bash
archivo=$1
mysqldump -u root -p bases2 > $archivo
echo Backup guardado exitosamente en: $archivo

