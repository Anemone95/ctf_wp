#!/usr/bin/env python
# -*- coding:utf-8 -*-
from Crypto.Cipher import AES
from Crypto import Random

def encrypt(data, password):
    bs = AES.block_size
    pad = lambda s: s + (bs - len(s) % bs) * chr(bs - len(s) % bs)
    iv = "0102030405060708"
    cipher = AES.new(password, AES.MODE_CBC, iv)
    data = cipher.encrypt(pad(data))
    return data

def decrypt(data, password):
    unpad = lambda s : s[0:-ord(s[-1])]
    iv = "0102030405060708"
    cipher = AES.new(password, AES.MODE_CBC, iv)
    data  = cipher.decrypt(data)
    return unpad(data)

def generate_passwd(key):
    data_halt = "LvR7GrlG0A4WIMBrUwTFoA==".decode("base64")
    rand_int =  int(decrypt(data_halt, key).encode("hex"), 16)
    round = 0x7DC59612
    result = 1
    a1 = 0
    while a1 < round:
        a2 = 0
        while a2 < round:
            a3 = 0
            while a3 < round:
                result = result * (rand_int % 0xB18E) % 0xB18E
                a3 += 1
            a2 += 1
        a1 += 1
    return encrypt(str(result), key)


if __name__ == '__main__':

    key = raw_input("key:")

    if len(key) != 32:
        print "check key length!"
        exit()
    passwd = generate_passwd(key.decode("hex"))

    flag = raw_input("flag:")

    print "output:", encrypt(flag, passwd).encode("base64")



# key = md5(sha1("flag"))
# output = "u6WHK2bnAsvTP/lPagu7c/K3la0mrveKrXryBPF/LKFE2HYgRNLGzr1J1yObUapw"

