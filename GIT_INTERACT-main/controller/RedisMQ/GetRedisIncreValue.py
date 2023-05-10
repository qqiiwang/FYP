from flask_restful import Resource, reqparse
from flask import current_app,abort,Response,jsonify 
import os

import time
from redis import StrictRedis
import subprocess
import json
class GetRedisIncreValue(Resource):
    
    @staticmethod
    def post():

        parse = reqparse.RequestParser()
        parse.add_argument('db_name', type=str, help='must input a database name', trim=True)
        parse.add_argument('ip', type=str, help='must input a target database ip', trim=True)
        parse.add_argument('port', type=str, help='must input a target database port', trim=True)

        args = parse.parse_args()

        ip = args['ip']
        port = args['port']
        db_name= args['db_name']

        # MQ push
        conn = current_app.redis
        output = conn.xrange(db_name+"_"+ip+"_"+port+"_incre")
        return Response(output, status=200)


        # # MQ push
        # conn=current_app.redis
        # conn.xadd(data_name,{"file_position":file_pos,"time":nowstr})
        # # result=conn.xread(data_name)
        # return Response("success incremental backup",status=200)