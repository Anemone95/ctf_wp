#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-13 20:03
from z3 import *

def solve():
    intarr=[1,2,3,4,5,6,7,8]
    arr = [Int("i_{}".format(i)) for i in range(8)]
    s = Solver()
    for i in range(8):
        s.add(0<arr[i], arr[i]<=8)
    s.add(arr[0]+arr[7]-1-1==5)
    s.add(arr[1]+arr[6]-1-1==12)
    s.add(arr[0]<arr[7])
    for k in range(1,8):
        for l in range(0,k):
            s.add(arr[l]!=arr[k])
            s.add(intarr[k]-intarr[l]!=(arr[k]-arr[l]))
            s.add(intarr[k]-intarr[l]!=(arr[l]-arr[k]))
    print(s.check())
    m=s.model()
    for i in range(8):
        print(i,m.evaluate(arr[i]))

if __name__ == '__main__':
    solve()

