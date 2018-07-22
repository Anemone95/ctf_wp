#!/usr/bin/env python
# coding=utf-8

# @file step1.py
# @brief step1
# @author x565178035,x565178035@126.com
# @version 1.0
# @date 2018-07-22 15:51

import hashlib
md5 = hashlib.md5

str2hashfunc = {
    'sha256': lambda s: hashlib.sha256(s).hexdigest(),
    'sha224': lambda s: hashlib.sha224(s).hexdigest(),
    'sha384': lambda s: hashlib.sha384(s).hexdigest(),
    'sha512': lambda s: hashlib.sha512(s).hexdigest(),
    'sha1': lambda s: hashlib.sha1(s).hexdigest(),
    'md5': lambda s: hashlib.md5(s).hexdigest(),
}


def step1(hashstr, v):
    seed = 0
    while str2hashfunc[hashstr](str(seed))[-6:] != v:
        seed += 1
        if seed % 100000 == 0:
            print seed
    return str(seed)


def xash(data, xkey):
    assert len(xkey) == 16
    if len(data) < len(xkey):
        data += md5(xkey).digest()[:len(xkey) - len(data)]
    out = b''
    for n in range(len(data)):
        out += chr(ord(data[n]) ^ ord(xkey[n]))
    return out.encode('hex')


if __name__ == '__main__':
    # step1
    #  print step1('sha224', "2da188")
    # step2
    key = xash('1' * 16, "36e7738072ae81d5d9ff45380f502f10".decode("hex"))
    #  print "key",key
    key = key.decode('hex')
    key = "6a399ae94ed42b7838206bae0dffac1c".decode('hex')

    # step3
    coll = "1".encode("hex") + str2hashfunc['md5'](key)[:30]
    print coll.decode("hex")
    print xash("1", key)
    print xash(coll.decode("hex"), key)
