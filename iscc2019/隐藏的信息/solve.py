#!/usr/bin/env python
# coding=utf-8

# @file ans.py
# @brief ans
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-02 17:01
import base64

def ans():
    with open('./message.txt', 'r') as f:
        text=f.readline()
    arr=text.split()
    s=""
    for e in arr:
        s+=chr(int(e,8))
    print(base64.b64decode(s))
if __name__ == '__main__':
    ans()

