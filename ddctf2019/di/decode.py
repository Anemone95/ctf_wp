#!/usr/bin/env python
# coding=utf-8

# @file decode.py
# @brief decode
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-04-13 15:39

import base64

def decode(de_str):
    s=""
    hexstr=list(map(lambda e: str(hex(ord(e)))[2:],list(de_str)))
    hexstr="".join(hexstr)
    base64str=base64.b64encode(hexstr.encode("utf8"))
    base64str=base64.b64encode(base64str)
    print(base64str.decode("utf8"))

if __name__ == '__main__':
    decode("hello")
