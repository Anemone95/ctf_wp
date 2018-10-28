#!/usr/bin/env python
# coding=utf-8

# @file xor.py
# @brief xor
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-09-22 17:05

def xor():
    arr=[chr(i) for i in range(ord('a'),ord('z'))]+[chr(i) for i in range(ord('A'),ord('Z'))]
    test=['`','~','!','@','%','^','*','(',')','-','+','{','}','[',']',':','<','>','.',',',';','|']
    for i in test:
        for j in test:
            res=chr(ord(i)^ord(j))
            if res in arr:
                print i,j,res
'''
[ < g
[ > e
] ) t
| : F
@ , l
[ : a
[ < g

'[[]|@[['^'<>):,:<'
'''


if __name__ == '__main__':
    xor()

