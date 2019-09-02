#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-10 16:08

def solve():
    with open('./Welcome.txt') as f:
        content=f.read()

    table={
        '蓅烺計劃': 'A',
        '洮蓠朩暒': 'B',
        '戶囗': 'C',
        '萇條': 'D',
        '洮蓠朩暒戶囗': 'BC',
        '洮蓠朩暒蓅烺計劃': 'BA',
        '萇條蓅烺計劃': 'DA',
        '萇條戶囗':'DC'
        }
    #  table={
        #  '蓅烺計劃': '.',
        #  '洮蓠朩暒': '.',
        #  '戶囗': '.',
        #  '萇條': '.',
        #  '洮蓠朩暒戶囗': '_',
        #  '洮蓠朩暒蓅烺計劃': '_',
        #  '萇條蓅烺計劃': '_',
        #  '萇條戶囗':'_'
        #  }
    arr=content.split()
    print(set(arr))
    res=[]
    for e in arr:
        res.append(table[e])
    print(" ".join(res))
if __name__ == '__main__':
    solve()

