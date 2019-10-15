#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-15 20:42
import jwt
import base64

def solve():
    payload={"name":"anemone","priv":"other"}
    pubkey='''-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDMRTzM9ujkHmh42aXG0aHZk/PK
omh6laVF+c3+D+klIjXglj7+/wxnztnhyOZpYxdtk7FfpHa3Xh4Pkpd5VivwOu1h
Kk3XQYZeMHov4kW0yuS+5RpFV1Q2gm/NWGY52EaQmpCNFQbGNigZhu95R2OoMtuc
IC+LX+9V/mpyKe9R3wIDAQAB
-----END PUBLIC KEY-----'''
    pubkey='MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDMRTzM9ujkHmh42aXG0aHZk/PKomh6laVF+c3+D+klIjXglj7+/wxnztnhyOZpYxdtk7FfpHa3Xh4Pkpd5VivwOu1hKk3XQYZeMHov4kW0yuS+5RpFV1Q2gm/NWGY52EaQmpCNFQbGNigZhu95R2OoMtucIC+LX+9V/mpyKe9R3wIDAQAB'
    #  print(pubkey)
    #  encoded="eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiYW5lbW9uZSIsInByaXYiOiJvdGhlciJ9.Rmi03AHYfUfUheK7WmPUmm_lh3gFcIeqqgwATu00mXyCT6Q1nTc9yYViOJOW0SMDNXoIil14mzI0kL4ueHZ1nessbWVrTqtw3orYGhxGb_MtfWFnDCfQFeN7ZwLSKy21DG_8KJreA1QHvb5dnKlSgE2-oQoWJFz8iiyGOpJyC4A"
    #  print(len(base64.b64decode(pubkey)))
    token = jwt.encode(payload, key=pubkey, algorithm='HS512')
    print(token)

if __name__ == '__main__':
    solve()

