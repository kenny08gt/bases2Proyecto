#!/bin/bash
mysql -u root -p -Bse  "PURGE BINARY LOGS BEFORE NOW();"
