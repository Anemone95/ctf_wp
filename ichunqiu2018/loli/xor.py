#!/usr/bin/env python
# coding=utf-8

def xor():
    with open('./1.png', 'rb') as f, open('xor.png', 'wb') as wf:
        for each in f.read():
            wf.write(chr(ord(each) ^ 0xff))


if __name__ == '__main__':
    xor()
