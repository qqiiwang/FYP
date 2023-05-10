from flask_restful import Resource, reqparse
from flask import current_app,abort,Response,jsonify 
import os

from utils.filemanage import foldertree,checkfiles_exist
import time
from redis import StrictRedis
import subprocess
import argparse
import json

from utils.rediscontrol import getMQList

#incre recovery
class GetQueueRec(Resource):
    
    @staticmethod
    def post():
        """
        :param new_db_name:
        :param old_db_name
        """
        parse = reqparse.RequestParser()
        parse.add_argument('old_db_name', type=str, help='must input a database name', required=True, trim=True)
        parse.add_argument('dest_ip', type=str, help='must input a target database ip', required=True, trim=True)
        parse.add_argument('dest_port', type=str, help='must input a target database port', required=True, trim=True)
        parse.add_argument('dest_user', type=str, help='must input a target database username', required=True, trim=True)
        parse.add_argument('dest_pwd', type=str, help='must input a target database password', required=True, trim=True)
        args = parse.parse_args()
        old_db_name = args['old_db_name']
        dest_ip = args['dest_ip']
        dest_port = args['dest_port']
        dest_user = args['dest_user']
        dest_pwd = args['dest_pwd']

        # MQ push (streamid,{k:v,k:v})
        conn=current_app.redis
        print(getMQList(conn, old_db_name))
        # 文件列表
        returnredisstr=" ".join([each[1]['file_position'] for each in getMQList(conn,old_db_name)])

        # 检查是否存在
        checkres=checkfiles_exist(returnredisstr.split(" "))
        if(not checkres['res']):
            return Response(json.dumps({'res':'error','msg':'such backup files {} do not exist'.format(",".join(checkres['filelist']))}),status=400)
        ret, out = subprocess.getstatusoutput(
            'bash {} -u {} -p {} -P {} -h {} -f "{}"'.format(current_app.config['DBrecbash_path'], dest_user, dest_pwd,
                                                             dest_port, dest_ip, returnredisstr))
        print("Run recursive revocery, code={}, out={}".format(ret,out))
        return {'res':'success','msg':returnredisstr}