#!/usr/bin/env python
# coding=utf-8

# @file qufan.py
# @brief qufan
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-09-22 17:34

def qufan():
    a=''
    for i in "getFlag()":
        b=~ord(i)
        print hex(b & 0x000000ff)

if __name__ == '__main__':
    qufan()

