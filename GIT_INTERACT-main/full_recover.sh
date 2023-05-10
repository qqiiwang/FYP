#! /bin/bash
#指定连接数据库信息(用户名、密码、连接地址、端口、安装目录)
DB_USER=""
DB_PWD=""
DB_IP=""
DB_PORT=""
#指定备份文件保存的天数
FILE_NAME=""

usage() {
  echo "Usage: $0"
  echo "[ -u USER ]"
  echo "[ -p PASSWORD ]"
  echo "[ -h IP (default:127.0.0.1)]"
  echo "[ -P PORT (default:3306)]"
  echo "[ -f backup file name]"
}
exit_abnormal() {                         # Function: Exit with error.
  usage
  exit 1
}
while getopts ":u:p:P::h::f:" options; do


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

#将指定的文件恢复到数据库
mysql -u ${DB_USER} -p${DB_PWD} -h${DB_IP} -P${DB_PORT} < ${FILE_NAME}
echo "success full backup"
