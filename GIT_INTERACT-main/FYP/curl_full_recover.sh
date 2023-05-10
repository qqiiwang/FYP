#!/bin/bash

DB_IP=$1
DB_PORT=$2
DB_NAME=$3
DES_DB_IP=$4
DES_DB_PORT=$5

curl -l -H "Content-type:application/json" -X GET -d "{\"old_db_name\":\"${DB_IP}_${DB_PORT}_${DB_NAME}_full\", \"dest_ip\":\"${DES_DB_IP}\",\"dest_port\":\"${DES_DB_PORT}\"}" http://127.0.0.1:5000/rec/queue

