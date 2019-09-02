#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-10 15:48
import base64
def solve():
    with open('./runnable.exe', 'r') as f:
        content=f.read()
    with open('./out.png', 'wb') as f:
        f.write(base64.b64decode(content))
if __name__ == '__main__':
    solve()

