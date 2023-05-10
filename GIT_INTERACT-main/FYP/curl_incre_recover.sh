#!/bin/bash
 

# curl http://localhost:5000/push/message
DB_NAME=$1
# curl -l -H "Content-type:application/json" -X GET -d "{\"old_db_name\":\"${DB_NAME}_ful\"}" http://127.0.0.1:5000/rec/value

curl -l -H "Content-type:application/json" -X GET -d "{\"old_db_name\":\"${DB_NAME}_incre\"}" http://127.0.0.1:5000/rec/queue

DB_IP=$1
DB_PORT=$2
DB_NAME=$3

curl -l -H "Content-type:application/json" -X GET -d "{\"old_db_name\":\"114.115.249.201_30002_${DB_NAME}_incre\"}" http://127.0.0.1:5000/rec/queue