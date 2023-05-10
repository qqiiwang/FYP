#!/bin/bash
 
DB_USER=$1
DB_PWD=$2
DB_IP=$3
DB_PORT=$4
DB_NAME=$5

#是指mysqldump命令所在目录
DB_DIR="D:\xampp\mysql\bin\mysqldump"

#MySQL Binlog
BIN_PATH="D:\xampp\mysql\bin\mysqlbinlog"

BIN_FILE_PATH="D:\xampp\mysql\data\\"
#增量备份文件所在路径
BAK_PATH=".\storaged"

curr_date=`date +%Y%m%d%H%M`

file_position="" 


sql_path=${BAK_PATH}/${DB_IP}_${DB_PORT}_${DB_NAME}/incre_data
mkdir -p $sql_path

#获取当前binlog文件
BINLOG_FILE=$(mysql -h $DB_IP -P $DB_PORT -u$DB_USER -p$DB_PWD $DB_NAME -e "SHOW MASTER STATUS;" | awk '{print $1}' | tail -n1)

echo "Current binlog file name: $BINLOG_FILE"
echo  "$BINLOG_FILE" | sed 's/.......$//'

if [ ! -f $sql_path/$DB_NAME.log ];
       #如果不存在即说明没有全量的开头点
	   then
	   #先立刻备份

	   ${DB_DIR} -u ${DB_USER} -p${DB_PWD} --host=${DB_IP} --port=${DB_PORT} --databases ${DB_NAME} > $sql_path/full.sql
	   
	   #获取当前binlog名
	   record_file=$BINLOG_FILE
		#写入相应文件中
	    echo "$record_file">$sql_path/$DB_NAME.log

	    file_position=$sql_path/full.sql

else
    #获取当前正在写入的binlog文档
    last_file=$BINLOG_FILE
    lastfile_index=$(echo -e ${last_file:0-6} | sed -r 's/0*([0-9])/\1/')
  
	    
	    #获取上次备份到的文件位置
	    #获取log里的记录
    record_file=`head -n 1 $sql_path/$DB_NAME.log`
    record_index=$(echo -e ${record_file:0-6} | sed -r 's/0*([0-9])/\1/')

	    
	    #生成1天前的日期
    duration_date=$(date -d "1 hour ago" +"%F %T")

	     #创建备份文件

    index=$lastfile_index
	    
    while [ $index -le $record_index ]
	    do
	            #构造binlog后缀，添加为6位数
	    post=`echo ${index} | awk '{printf("%06d\n",$0)}'`

	    ${BIN_PATH}  --start-datetime="$duration_date" -d ${DB_NAME} $BIN_FILE_PATH\mysql-bin.$post > $sql_path/increbk_1_$curr_date.sql
	    cat $sql_path/increbk_1_$curr_date.sql>>$sql_path/$curr_date.sql
	    rm $sql_path/increbk_1_$curr_date.sql
	            
	    index=`expr $index + 1 `
	    done
   
    file_position=$sql_path\increbk_$curr_date.sql
    sed -i '1s\$record_file\$last_file\' $sql_path/$DB_NAME.log
 
fi	    

echo "------- $(date +%F_%T) Stop incre MySQL database backup--------" >>$sql_path/incre_back.log
