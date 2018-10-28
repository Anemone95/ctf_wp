#!/usr/bin/env python
# coding=utf-8

# @file burp.py
# @brief burp
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-10-12 19:52
import requests


def single():
    proxies = {
        "http": "http://127.0.0.1:8080",
        "https": "http://127.0.0.1:8080"}

    burp0_url = "http://114.55.36.69:8021/"
    burp0_headers = {
        "Host":"192.168.5.132",
        "Upgrade-Insecure-Requests": "1",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9",
        "Connection": "close"}
    res=requests.get(burp0_url, headers=burp0_headers, timeout=1, proxies=proxies)
    print res.text
    return res.text


if __name__ == '__main__':
    single()
