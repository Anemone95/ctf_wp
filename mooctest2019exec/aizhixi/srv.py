#!/usr/bin/env python3
# coding=utf-8

"""
srv.py

author: Anemone95,x565178035@126.com
date: 2019-10-15 20:31
"""

from flask import Flask,jsonify

app=Flask(__name__)

@app.route('/', methods=['GET'])
def srv():
    resp=dict(f="system",d="ls")
    return jsonify(resp), 200

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80)

