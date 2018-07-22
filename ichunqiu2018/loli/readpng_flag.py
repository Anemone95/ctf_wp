#!/usr/bin/env python
# coding=utf-8

# @file readpng.py
# @brief readpng
# @author x565178035,x565178035@126.com
# @version 1.0
# @date 2018-07-21 1
import matplotlib.image as mpimg  # mpimg 用于读取图片5:18

# png[y][x][rgb]

res_str = []
res = []


def readpng():
    png = mpimg.imread('./00006777.png')
    yy, xx, depth = png.shape
    for y in range(yy):
        if y % 2 == 0:
            for x in range(1, xx - 1, 9):
                _str = "0b" + str(int(png[y][x][0])) + str(int(png[y][x + 1][0])) + str(int(png[y][x + 2][0])) + str(int(png[y][x + 3][0])) + str(
                    int(png[y][x + 4][0])) + str(int(png[y][x + 5][0])) + str(int(png[y][x + 6][0])) + str(int(png[y][x + 7][0]))
                res_str.append(_str)
                res.append(bin2hex(_str))
    print res_str
    with open('res.bin', 'wb') as f:
        for each in res:
            f.write(chr(each))


def bin2hex(_bin="0b101"):
    return int(_bin, 2) ^ 0xFF


if __name__ == '__main__':
    readpng()
    #  bin2hex("0b101")
