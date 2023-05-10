#!/bin/bash
 
DB_USER=$1
DB_PWD=$2
DB_IP=$3
DB_PORT=$4
DB_NAME=$5
#mysqldump path
DB_DIR="D:\xampp\mysql\bin\mysqldump"

#time format
BAK_DATE=`date +%Y%m%d%H%M`

#storing path
BAK_PATH=".\storaged"


echo "------- $(date +%F_%T) Start MySQL database backup-------- " >>${BAK_PATH}/back.log

sql_path=${BAK_PATH}/${DB_IP}_${DB_PORT}_${DB_NAME}/full_data
mkdir -p $sql_path

#start backup
${DB_DIR} -u ${DB_USER} -p${DB_PWD} --host=${DB_IP} --port=${DB_PORT} --databases ${DB_NAME} > ${sql_path}/${BAK_DATE}.sql

echo "-------$(date +%F_%T) Stop MySQL database backup-------- " >>${BAK_PATH}/back.log


