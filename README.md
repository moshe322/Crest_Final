CREATE DATABASE IF NOT EXISTS corecrest;

CREATE USER IF NOT EXISTS 'core'@'localhost'
IDENTIFIED BY 'Crest@12345';

GRANT ALL PRIVILEGES ON corecrest.* TO 'core'@'localhost';

FLUSH PRIVILEGES;

SHOW DATABASES;

USE corecrest;

SELECT DATABASE();

EXIT;



Restore Backup (Linux)
Ubuntu / Debian
mysql -u root -p corecrest < corecrest_backup.sql
CentOS / RHEL / Rocky Linux / AlmaLinux
mysql -u root -p corecrest < corecrest_backup.sql
Amazon Linux
mysql -u root -p corecrest < corecrest_backup.sql
3. Restore Backup (Windows CMD)
mysql -u root -p corecrest < corecrest_backup.sql

If MySQL is not in PATH:

"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe" -u root -p corecrest < corecrest_backup.sql



restore.sh
#!/bin/bash

DB_NAME="corecrest"
DB_USER="core"
DB_PASS="Crest@12345"
BACKUP_FILE="corecrest_backup.sql"

mysql -u root -p${DB_PASS} <<EOF
CREATE DATABASE IF NOT EXISTS ${DB_NAME};

CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost'
IDENTIFIED BY '${DB_PASS}';

GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';

FLUSH PRIVILEGES;
EOF

mysql -u root -p${DB_PASS} ${DB_NAME} < ${BACKUP_FILE}

echo "Database restored successfully."



chmod +x restore.sh
./restore.sh


