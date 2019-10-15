#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-13 20:58

import base64

def decode(en_msg):
    raw_de=base64.b64decode(en_msg)
    plain=''
    for byte in raw_de:
        x=byte-16
        x=x^32
        plain+=chr(x)
    return plain

def solve():
    correct = 'eYNzc2tjWV1gXFWPYGlTbQ=='
    print(decode(correct))

if __name__ == '__main__':
    solve()

