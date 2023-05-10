
from flask_restful import Resource, reqparse
from flask import current_app,abort,Response,jsonify 
import os

from utils.filemanage import checkfiles_exist
import time
from redis import StrictRedis
import subprocess
import argparse
import json

from utils.rediscontrol import getValue
#full recover
class GetValueRec(Resource):
    
    @staticmethod
    def post():

        parse = reqparse.RequestParser()
        parse.add_argument('old_db_name', type=str, help='must input a database name', trim=True)
        parse.add_argument('dest_ip', type=str, help='must input a target database ip',  trim=True)
        parse.add_argument('dest_port', type=str, help='must input a target database port',  trim=True)
        parse.add_argument('dest_user', type=str, help='must input a target database username',  trim=True)
        parse.add_argument('dest_pwd', type=str, help='must input a target database password',  trim=True)
        args = parse.parse_args()
        old_db_name = args['old_db_name']
        dest_ip = args['dest_ip']
        dest_port = args['dest_port']
        dest_user = args['dest_user']
        dest_pwd = args['dest_pwd']

        conn=current_app.redis
        returnredisstr=getValue(conn,old_db_name)
        if(not returnredisstr):
            return Response(json.dumps({'res':'invalid','msg':'no backup databse name'}),status=401)
        returndict=json.loads(returnredisstr)
        
        # 检查是否存在
        checkres=checkfiles_exist([returndict["file_position"]])
        if(not checkres['res']):
            return abort(jsonify({'res':'error','msg':'such backup files {} do not exist'.format(",".join(checkres['filelist']))}))
        ret, out = subprocess.getstatusoutput('bash {} -u {} -p {} -P {} -h {} -f "{}"'.format(current_app.config['DBfullbash_path'],dest_user,dest_pwd,dest_port,dest_ip,returndict["file_position"]))
        print("Run full revocery, code={}, out={}".format(ret,out))
        return {'res':'success','msg':returndict}