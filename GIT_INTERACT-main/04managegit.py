import subprocess
import os
import re
from flask import Flask, jsonify, request, abort, Response, render_template, send_from_directory, current_app
from flask_cors import CORS
from flask_restful import Api
import base64
from redis import StrictRedis
import argparse
# Resource
from controller.template import ProductView
# RedisMQ
from controller.RedisMQ.Push import PushQueue
from controller.RedisMQ.GetQueueRec import GetQueueRec
from controller.RedisMQ.Setnew import Setnew
from controller.RedisMQ.GetValueRec import GetValueRec
from controller.RedisMQ.GetRedis import GetRedis
from controller.RedisMQ.GetRedisFullValue import GetRedisFullValue
from controller.RedisMQ.GetRedisIncreValue import GetRedisIncreValue
app = Flask(__name__)

api=Api(app)

# RedisMQ
api.add_resource(PushQueue,'/push/message',endpoint="MQpush")
api.add_resource(GetQueueRec,'/rec/queue',endpoint="MQrec")

api.add_resource(Setnew,'/set/value',endpoint="setfullrec")
api.add_resource(GetValueRec,'/rec/value',endpoint="runfullrec")

api.add_resource(GetRedis,'/get/redis',endpoint="getredis")
api.add_resource(GetRedisFullValue,'/get/full/redis',endpoint="getfullredis")
api.add_resource(GetRedisIncreValue,'/get/incre/redis',endpoint="getincreredis")
CORS(app, resources=r'/*')
if __name__ == '__main__':
    # 从命令行获取参数
    paramparser=argparse.ArgumentParser()
    paramparser.add_argument('--redispwd',help='password for Redis')
    paramparser.add_argument('--debug',help='debug mode')
    # 命令行参数解析获取
    paramopt=paramparser.parse_known_args()[0]
    print("Param of Redis pwd: ",paramopt.redispwd)
    
    # 是否debug模式
    if(paramopt.debug=="on"):
        app.debug=True
    # 存储路径设置
    localstore=os.path.join(os.path.split(__file__)[0],"storaged")
    if not os.path.exists(localstore):
        os.mkdir(localstore)
    app.config['localstore']=localstore
    # 设置Redis连结
    rediscnn=StrictRedis(host="124.223.12.203",port=6379,db=2,password=paramopt.redispwd,decode_responses=True)
    app.redis=rediscnn
    # 增量恢复数据库的脚本的路径
    app.config['DBrecbash_path']="./incre_recover.sh"
    app.config['DBfullbash_path']="./full_recover.sh"
    app.config['DBrecbackup_path'] = "./incre_back.sh"
    app.config['DBfullbackup_path'] = "./full_back.sh"
    # 输出启动路径
    rr,ooutput=subprocess.getstatusoutput('echo %cd%')
    print("We now at {}".format(ooutput))
    app.config.from_pyfile("settings.py")
    app.run(host='localhost', port=5000)
    
