#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-03 10:08

def solve():
    keyboard2char={
        "MNBVCDRTGHU":"r",
        "EFVGYWDCFT":"w",
        "NBVCXSWERF":"p",
        "QAZXCDEWV":"q",
        "XSWEFTYHN":"m",
        "TGBNMJUY":"o",
        "ZAQWDVFR":"n",
        "RFVGYHN":"h",
        "TYUIOJM":"t",
        "TGBNMJU":"u",
        "IUYHNBV":"s",
        "GRDXCVB":"a",
        "WSXCFE":"d",
        "CVGRED":"g",
        "YHNMKJ":"b",
        "QAZSCE":"k",
        "WSXCDE":"e",
        "QWERTY":" ",
        "RGNYGC":"x",
        "WSXCV":"l",
        "TRFVG":"f",
        "TRFVB":'c',
        "EFVGY":"v",
        "EFVT":"y",
        "WSX":"i",
    }
    with open("./keyes.txt", 'r') as f:
        s=f.readline()

    for k,v in keyboard2char.items():
        s=s.replace(k,v)

    print(s.upper())
if __name__ == '__main__':
    solve()

