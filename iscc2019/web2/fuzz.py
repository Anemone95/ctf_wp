from burp import IBurpExtender
from burp import IIntruderPayloadGeneratorFactory
from burp import IIntruderPayloadGenerator
import requests
import os
import time
import re

class BurpExtender(IBurpExtender,IIntruderPayloadGeneratorFactory):
    def registerExtenderCallbacks(self,callbacks):
        callbacks.registerIntruderPayloadGeneratorFactory(self)
        callbacks.setExtensionName("code")

    def getGeneratorName(self):
        return "vcode"

    def createNewInstance(self,attack):
        tem = "".join(chr(abs(x)) for x in attack.getRequestTemplate())
        tem = re.findall("Cookie: (.+?)\r\n",tem)[0]
        print(tem)
        return DetectXss(attack,tem)

class DetectXss(IIntruderPayloadGenerator):
    def __init__(self,attack,cookie):
        self.target="captcha's link"
        self.cookie = cookie
        self.max = 1
        self.num = 0
        self.attack = attack

    def hasMorePayloads(self):
        if self.num == self.max:
            return False
        else:
            return True

    def getNextPayload(self,payload):
        print("invoked")
        headers = {'Cookie':self.cookie}
        r = requests.get(self.target,headers=headers)
        f = open('/root/code.jpg','w')
        f.write(r.content)
        f.close()
        os.system('python /root/githubs/burp-plus/code.py')

        f = open('/root/result.txt','r')
        code = f.read()
        f.close()

        self.num += 1
        return code

    def reset(self):
        print("reset")
        self.num = 0
        return
