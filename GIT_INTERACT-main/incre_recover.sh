DB_USER=""
DB_PWD=""
DB_IP=""
DB_PORT=""
DB_NAME=""
FILE_NAME=""
START_TIME="" 
#备份数据本地储存路径
BinDir="D:\xampp\mysql\bin\mysqlbinlog"
BinFile=$BinDir\mysql-bin.index

# 传参用法提示
usage() {                               
  echo "Usage: $0"
  echo "[ -u USER ]"
  echo "[ -p PASSWORD ]"
  echo "[ -h IP]"
  echo "[ -P PORT]"
  echo "[ -d database_name]"
  echo "[ -f file_name]"
}
exit_abnormal() {                         # Function: Exit with error.
  usage
  exit 1
}

while getopts ":u:p:P::h::d:f:" options; do       
                                        
                                         
  case "${options}" in                    
    u)                                    
      DB_USER=${OPTARG}                      
      ;;
    p)                                   
      DB_PWD=${OPTARG}                    
      ;;
    h)                                    
      DB_IP=${OPTARG}              
      ;;
    P)                                    
      DB_PORT=${OPTARG}                    
      ;;
    d)                                  
      DB_NAME=${OPTARG}                  
      ;;
    f)
     FILE_NAME=${OPTARG}
     ;;
    :)                                    # If expected argument omitted:
      echo "Error: -${OPTARG} requires an argument."
      exit_abnormal                       # Exit abnormally.
      ;;
    *)                                    # If unknown (any other) option:
      exit_abnormal                       # Exit abnormally.
      ;;
  esac
done

#查找上一次恢复记录，若有则比对是否和本次开始文件一致，若没有则需先执行全量备份。


BAK_PATH=".\storaged"
echo "file_name"
echo $FILE_NAME
arr=(${FILE_NAME// / })
echo "after processing"
echo "0"
echo ${arr[0]}
echo "1"
echo ${arr[1]}


#遍历每一个文件，用空格分开
i=0
while [ $i -lt ${#arr[@]} ]
#当变量（下标）小于数组长度时进入循环体
do
    echo $i
    echo ${arr[$i]}
    #按下标打印数组元素
    mysql -u ${DB_USER} -h${DB_IP} -P${DB_PORT} -p${DB_PWD} ${DB_NAME} -e "source ${arr[$i]}"
    let i++
done
echo "------- $BAK_DATE Incre testing MySQL database recover-------- " >>${BAK_PATH}\back.log



