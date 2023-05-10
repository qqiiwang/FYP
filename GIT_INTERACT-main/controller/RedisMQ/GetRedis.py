from flask_restful import Resource, reqparse
from flask import current_app,abort,Response,jsonify 
import os

from utils.filemanage import foldertree
import time
from redis import StrictRedis
import subprocess
import json
class GetRedis(Resource):
    
    @staticmethod
    def post():
        """
        :param file_position:
        :param database_name:
        """
        parse = reqparse.RequestParser()

        parse.add_argument('ip', type=str, help='must input a target database ip', trim=True)
        parse.add_argument('port', type=str, help='must input a target database port', trim=True)

        args = parse.parse_args()

        ip = args['ip']
        port = args['port']
        pattern =ip+'_'+port+'*'
        '*';

        # MQ push
        conn = current_app.redis
        output=conn.keys(pattern)
        return Response(output, status=200)


        # # MQ push
        # conn=current_app.redis
        # conn.xadd(data_name,{"file_position":file_pos,"time":nowstr})
        # # result=conn.xread(data_name)
        # return Response("success incremental backup",status=200)