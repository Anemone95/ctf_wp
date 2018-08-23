#!/usr/bin/env python
# coding=utf-8

# @file test.py
# @brief test
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-08-22 10:28

from z3 import *
t1 = [115, 111, 109, 101, 32, 108, 101, 103, 101, 110, 100, 115, 32, 114, 32, 116, 111, 108, 100, 44, 32, 115, 111, 109, 101, 32, 116, 117, 114, 110, 32, 116, 111, 32, 100, 117, 115, 116, 32, 111, 114, 32, 116, 111, 32, 103, 111, 108, 100]
t2 = [170, 122, 36, 10, 168, 188, 60, 252, 130, 75, 81, 82, 94, 28, 130, 31, 121, 186, 181, 227, 67, 4, 253, 172, 16, 181, 99, 189, 141, 231, 53, 217, 211, 232, 66, 109, 113, 90, 9, 84, 233, 159, 76, 220, 162, 175, 17, 135, 148]
flag = [BitVec("flag%d"%i, 8) for i in range(49)]
m1 = [0 for i in range(49)]
m2 = [0 for i in range(49)]

i_23 = 23
for i in range(49):
    m1[i_23] = flag[i]^i_23
    m2[i] = t1[i_23]^i
    i_23 = (i_23+13)%49
a = 3
b = 4
c = 5
d = 41
s = Solver()
for i in range(7):
    for j in range(7):
        sum = 0
        for k in range(7):
            sum += m2[7*c+b]*m1[7*a+c]
            c = (c+5)%7
        # print(sum)
        s.add(sum==t2[d]^d)
        d = (d+31)%49
        b = (b+4)%7
    a = (a+3)%7
c = (s.check())
f = ""
if(c==sat):
    m=s.model()
    # print("flag",end='\n')
    for i in range(49):
        f += (chr(m[flag[i]].as_long()))
    print(f)
