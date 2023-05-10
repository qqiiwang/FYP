from flask_restful import Resource, reqparse
from flask import current_app,abort,Response,jsonify 
import os


import time
from redis import StrictRedis
import subprocess
import json
class PushQueue(Resource):
    
    @staticmethod
    def post():
        """
        :param file_position:
        :param database_name:
        """
        parse = reqparse.RequestParser()
        parse.add_argument('db_name', type=str, help='must input a database name', trim=True)
        parse.add_argument('ip', type=str, help='must input a target database ip', trim=True)
        parse.add_argument('port', type=str, help='must input a target database port', trim=True)
        parse.add_argument('user', type=str, help='must input a target database username', trim=True)
        parse.add_argument('pwd', type=str, help='must input a target database password', trim=True)
        args = parse.parse_args()
        db_name = args['db_name']
        ip = args['ip']
        port = args['port']
        user = args['user']
        pwd = args['pwd']

        file_name = ip + "_" + port + "_" + db_name + "_incre"
        now = int(round(time.time() * 1000))
        nowstr = time.strftime('%Y%m%d%H%M', time.localtime(now / 1000))

        file_path = os.getcwd() + "\storaged\\" + ip + "_" + port + "_" + db_name + "\\incre_data\\" + nowstr + ".sql"
        print(os.path.exists(os.getcwd() + "\storaged\\" + ip + "_" + port + "_" + db_name))
        if (not os.path.exists(os.getcwd() + "\storaged\\" + ip + "_" + port + "_" + db_name)):
            file_path = os.getcwd() + "\storaged\\" + ip + "_" + port + "_" + db_name + "\\incre_data\\" + "full.sql"
            print(file_path)
        ret, out = subprocess.getstatusoutput(
            'bash {} {} {} {} {} {}'.format(current_app.config['DBrecbackup_path'], user, pwd,
                                            ip, port, db_name))
        print("Run incre backup, code={}, out={}".format(ret, out))

        # MQ push



        conn = current_app.redis
        conn.xadd(file_name, {"file_position": file_path, "time": nowstr})
        return Response("success incremental backup", status=200)


        # # MQ push
        # conn=current_app.redis
        # conn.xadd(data_name,{"file_position":file_pos,"time":nowstr})
        # # result=conn.xread(data_name)
        # return Response("success incremental backup",status=200)