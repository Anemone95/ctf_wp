#!/usr/bin/env python
# coding=utf-8

# @file angr_example.py
# @brief angr_example
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2018-08-23 17:43

import angr

def angr_example():
    p = angr.Project("martricks")
    simgr = p.factory.simulation_manager(p.factory.full_init_state())
    simgr.explore(find=0x400A84, avoid=0x400A90) #成功路径，失败路径

    return simgr.found[0].posix.dumps(0).strip('\0\n')

if __name__ == '__main__':
    print main()
