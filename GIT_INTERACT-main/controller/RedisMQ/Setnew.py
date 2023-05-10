from flask_restful import Resource, reqparse
from flask import current_app,abort,Response,jsonify 
import os

from utils.filemanage import foldertree
import time
from redis import StrictRedis
import json

import subprocess

class Setnew(Resource):
    
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
        # parse.add_argument('file_position', type=str, help='must need a database file position', required=True, trim=True)
        # parse.add_argument('database_name', type=str, help='must need a database name', required=True, trim=True)
        #
        # args = parse.parse_args()
        # file_pos = args['file_position']
        # data_name = args['database_name']
        ret, out = subprocess.getstatusoutput( 'bash {} {} {} {} {} {}'.format(current_app.config['DBfullbackup_path'], user, pwd,
                                                              ip,port,db_name))
        print("Run full backup, code={}, out={}".format(ret, out))
        now = int(round(time.time()*1000))
        nowstr = time.strftime('%Y%m%d%H%M',time.localtime(now/1000))
        # MQ push
        conn=current_app.redis
        file_name=ip+"_"+port+"_"+db_name+"_full"
        file_path=os.getcwd()+"\storaged\\"+ip+"_"+port+"_"+db_name+"\\full_data\\"+nowstr+".sql"
        print(file_path)
        conn.set(file_name,json.dumps({"file_position":file_path,"time":nowstr}))
        return Response("OK",status=200)