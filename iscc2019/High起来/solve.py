#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-20 20:13

def solve():
    s = '中口由羊口中中大中中中井'
    d = {'口':'0', '由':'1', '中':'2', '人':'3', '工':'4', '大':'5', '王':'6', '夫':'7', '井':'8', '羊':'9'}
    result = ''
    for i in s:
        if i in d:
            result += d[i]
        else:
            result += i
    print(result)

if __name__ == '__main__':
    solve()

