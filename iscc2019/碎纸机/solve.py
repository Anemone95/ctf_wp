#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-04 09:55

import numpy as np
import matplotlib.pyplot as plt
from scipy import misc

def extract(filename):
    with open(filename, 'rb') as f:
        content=f.read()

    return content[-1250:]

def solve():
    contents=[]
    for i in range(1,11):
        contents.append(extract('./extracted/puzzle{}.jpg'.format(i)))

    for i in range(10):
        showpng(contents[i],50,"puzzle{}".format(i+1))

def showpng(content, xx, name):
    yy, xx, depth = 1250//xx, xx, 8
    new=[]
    for y in range(yy):
        tmp=[]
        for x in range(xx):
            rgb=content[y*xx+x]
            print(y*xx+x)
            tmp.append([rgb, rgb, rgb])
        new.append(tmp)
    # new[y][x][rgb]
    lena=np.array(new)    #生成np.array
    misc.imsave('{}.png'.format(name), lena)    #保存图片

if __name__ == '__main__':
    solve()

