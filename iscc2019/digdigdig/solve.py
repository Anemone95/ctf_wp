#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-14 15:11

import angr, claripy

def angr_example():
    program_path="./dig_dig_dig"
    base=0x400000
    p = angr.Project(program_path)
    argv1 = claripy.BVS('argv1', 30*8) #命令行参数
    state = p.factory.full_init_state(args = [program_path,argv1])
    simgr = p.factory.simulation_manager(state)
    simgr.explore(find=0x1112+base, avoid=0x1120+base) #成功路径，失败路径
    found=simgr.found[0]
    solution = found.se.eval(argv1, cast_to=bytes)
    return solution
if __name__ == '__main__':
    print(angr_example())

