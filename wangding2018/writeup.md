2018年网鼎杯，emmm，好不容易看到个算法题还花了很长时间，太难过了T_T
# 二叉树

## 0x01

下载题目后，得到一张红黑树的图片和README.txt. 将readme进行base64解码可以得到hit：

```
1.这是一棵红黑树
2.树从1-59上的果子依次为 ek`~3c:gf017b744/b38fd~abm7g5489e2{lf6z8d16hae`98}b|-21m.e:
3.依次从树上取走第 18,35,53,50,14,28,19,6,54,36 个果子,过程中保持红黑树性质不变
4.tmpflag为第 8,56,47,37,52,34,17,8,8,29,7,47,40,57,46,24,34,34,57,29,22,5,16,57,24,29,8,12,57,12,12,21,33,34,55,51,22,45,34,31,1,23 个果子
5.flag为 tmpflag 红色果子 ASCII +1 , 黑色果子 ASCII-1
6.让我们愉快的开始获取flag吧
```

## 0x02

经过提示，首先需要找一份红黑树的实现，并且按照图片构造一颗红黑树(如果不按图片会出现多解情况，因为这点被坑惨)，以下给出一个很好的python版红黑树实现

```python
# -*- coding: utf-8 -*-
BLACK = 0
RED = 1
#graphic elements of rbtree for printing
VC = '│'
HC = '─'
SIZE = 3
RIG = '┌' + HC * SIZE
LEF = '└' + HC * SIZE
SP = chr(32)
IND1 = SP * (SIZE + 1)
IND2 = VC + SP * SIZE

class rbnode(object):

    def __init__(self, key=None, value=None, color=BLACK,left=None,right=None,p=None):
        self.key = key
        self.value = value
        self.color = color
        self.left = left
        self.right = right
        self.p = p

    def __repr__(self):
        return '%s%s%s' % (self.key,'◆' if self.color is BLACK else '◇',self.value )

_NONE=rbnode()

class rbtree(object):

    def __init__(self, data=False,default_value=0, nodes=None):
        if nodes:
            self.root = nodes[28]
            self.default_value = default_value #for method: force_search
            self.nil = _NONE
        else:
            self.nil = _NONE
            self.root = self.nil
            self.default_value = default_value #for method: force_search
            if hasattr(data, '__iter__'):
                for key, value in data:
                    self.insert(rbnode(key,value))

    def __repr__(self):
        return '\n'.join(self.graph())

    def graph(self, x=False, prefix=''):
        "beautifully print rbtree, big key node first"
        if x is False:
            x = self.root
        if x is not self.nil:
            p = x.p
            last_prefix = ''
            if p is not self.nil:
                pp = p.p
                last_prefix = LEF if p.left is x else RIG
                if pp is not self.nil:
                    if (pp.left is p) is (p.left is x):
                        prefix = prefix + IND1
                    else:
                        prefix = prefix + IND2
            yield from self.graph(x.right, prefix)
            yield '%s%s%s' % (prefix, last_prefix, x)
            yield from self.graph(x.left, prefix)

    def search(self, key, x=False):
        "find node according to key, return self.nil if not found"
        if x is False:
            x = self.root
        while (x is not self.nil) and (key != x.key):
            if key < x.key:
                x = x.left
            else:
                x = x.right
        return x

    def insert(self, z):
        "insert z node with key and value"
        y = self.nil
        x = self.root
        while x is not self.nil:
            y = x
            if z.key < x.key:
                x = x.left
            else:
                x = x.right
        z.p = y
        if y is self.nil:
            self.root = z
        elif z.key < y.key:
            y.left = z
        else:
            y.right = z
        z.left = self.nil
        z.right = self.nil
        z.color = RED
        self.insert_fixup(z)

    def delete(self, z):
        y = z
        y_original_color = y.color
        if z.left is self.nil:
            x = z.right
            self.transplant(z, x)
        elif z.right is self.nil:
            x = z.left
            self.transplant(z, x)
        else:
            y = self.minimum(z.right)
            y_original_color = y.color
            x = y.right
            if y.p is z:
                x.p = y
            else:
                self.transplant(y, x)
                y.right = z.right
                y.right.p = y
            self.transplant(z, y)
            y.left = z.left
            y.left.p = y
            y.color = z.color
        if y_original_color is BLACK:
            self.delete_fixup(x)

    def is_empty(self):
        return self.root is self.nil

    def right_walk(self, x=False):
        if x is False:
            x = self.root
        if x is not self.nil:
            yield from self.right_walk(x.right)
            yield x
            yield from self.right_walk(x.left)

    def left_walk(self, x=False):
        if x is False:
            x = self.root
        if x is not self.nil:
            yield from self.left_walk(x.left)
            yield x
            yield from self.left_walk(x.right)

    def force_search(self,key):
        y = self.nil
        x = self.root
        while x is not self.nil:
            if key == x.key:
                return x
            y = x
            if key < x.key:
                x = x.left
            else:
                x = x.right
        z = rbnode()
        original_z = z
        z.key = key
        z.value = self.default_value
        z.p = y
        if y is self.nil:
            self.root = z
        elif z.key < y.key:
            y.left = z
        else:
            y.right = z
        z.left = self.nil
        z.right = self.nil
        z.color = RED
        self.insert_fixup(z)
        return original_z

    def maximum(self, x=False):
        if x is False:
            x = self.root
        while x.right is not self.nil:
            x = x.right
        return x

    def minimum(self, x=False):
        if x is False:
            x = self.root
        while x.left is not self.nil:
            x = x.left
        return x

    def successor(self, x):
        "return node with smallest key greater than x.key"
        if x.right is not self.nil:
            return self.minimum(x.right)
        y = x.p
        while (y is not self.nil) and (x is y.right):
            x = y
            y = y.p
        return y

    def predecessor(self, x):
        "return node with biggest key lower than x.key"
        if x.left is not self.nil:
            return self.maximum(x.left)
        y = x.p
        while (y is not self.nil) and (x is y.left):
            x = y
            y = y.p
        return y

    def left_rotate(self, x):
        y = x.right
        x.right = y.left
        if y.left is not self.nil:
            y.left.p = x
        y.p = x.p
        if x.p is self.nil:
            self.root = y
        else:
            if x is x.p.left:
                x.p.left = y
            else:
                x.p.right = y
        y.left = x
        x.p = y

    def right_rotate(self, x):
        y = x.left
        x.left = y.right
        if y.right is not self.nil:
            y.right.p = x
        y.p = x.p
        if x.p is self.nil:
            self.root = y
        else:
            if x is x.p.right:
                x.p.right = y
            else:
                x.p.left = y
        y.right = x
        x.p = y

    def insert_fixup(self, z):
        while z.p.color is RED:
            if z.p is z.p.p.left:
                y = z.p.p.right
                if y.color is RED:
                    z.p.color = BLACK
                    y.color = BLACK
                    z.p.p.color = RED
                    z = z.p.p
                else:
                    if z is z.p.right:
                        z = z.p
                        self.left_rotate(z)
                    z.p.color = BLACK
                    z.p.p.color = RED
                    self.right_rotate(z.p.p)
            else:
                y = z.p.p.left
                if y.color is RED:
                    z.p.color = BLACK
                    y.color = BLACK
                    z.p.p.color = RED
                    z = z.p.p
                else:
                    if z is z.p.left:
                        z = z.p
                        self.right_rotate(z)
                    z.p.color = BLACK
                    z.p.p.color = RED
                    self.left_rotate(z.p.p)
        self.root.color = BLACK

    def delete_fixup(self, x):
        while (x is not self.root) and (x.color is BLACK):
            if x is x.p.left:
                w = x.p.right
                if w.color is RED:
                    w.color = BLACK
                    x.p.color = RED
                    self.left_rotate(x.p)
                    w = x.p.right
                if (w.left.color is BLACK) and (w.right.color is BLACK):
                    w.color = RED
                    x = x.p
                else:
                    if w.right.color is BLACK:
                        w.left.color = BLACK
                        w.color = RED
                        self.right_rotate(w)
                        w = x.p.right
                    w.color = x.p.color
                    x.p.color = BLACK
                    w.right.color = BLACK
                    self.left_rotate(x.p)
                    x = self.root
            else:
                w = x.p.left
                if w.color is RED:
                    w.color = BLACK
                    x.p.color = RED
                    self.right_rotate(x.p)
                    w = x.p.left
                if (w.right.color is BLACK) and (w.left.color is BLACK):
                    w.color = RED
                    x = x.p
                else:
                    if w.left.color is BLACK:
                        w.right.color = BLACK
                        w.color = RED
                        self.left_rotate(w)
                        w = x.p.left
                    w.color = x.p.color
                    x.p.color = BLACK
                    w.left.color = BLACK
                    self.right_rotate(x.p)
                    x = self.root
        x.color = BLACK

    def transplant(self, u, v):
        if u.p is self.nil:
            self.root = v
        elif u is u.p.left:
            u.p.left = v
        else:
            u.p.right = v
        v.p = u.p
```
这段红黑树的果子为rbnode对象，整个树根据果子的key构建，果子的value可以可以放我们字符串的字符。
默认的红黑树时通过不断加入节点自动生成的，但是加入果子的顺序不同会造成树以及果子的颜色的不同，可以看到我对标准的红黑树构造函数做了修改，这样我们可以根据给出的图片（1.jpg）构造一个红黑树。
```python
if __name__ == '__main__':
	#提示2，果子的value
    _str=" ek`~3c:gf017b744/b38fd~abm7g5489e2{lf6z8d16hae`98}b|-21m.e:"

    nodes=[_NONE]
    for i in range(1,60):
        nodes.append( rbnode(key=i,value=_str[i]) )
        # node, color, l,r,p
    # 录入图片红黑树的信息
    tree=[
            [1,BLACK,0,2,3],
            [2,RED,0,0,1],
            [3,RED,1,4,6],
            [4,BLACK,0,5,3],
            [5,RED,0,0,4],
            [6,BLACK,3,8,10],
            [7,RED,0,0,8],
            [8,BLACK,7,9,6],
            [9,RED,0,0,8],
            [10,RED,6,18,23],
            [11,RED,0,0,12],
            [12,BLACK,11,13,14],
            [13,RED,0,0,12],
            [14,RED,12,16,18],
            [15,RED,0,0,16],
            [16,BLACK,15,17,14],
            [17,RED,0,0,16],
            [18,BLACK,14,20,10],
            [19,BLACK,0,0,20],
            [20,RED,19,21,18],
            [21,BLACK,0,22,20],
            [22,RED,0,0,21],
            [23,BLACK,10,26,28],
            [24,RED,0,0,25],
            [25,BLACK,24,0,26],
            [26,BLACK,25,27,23],
            [27,BLACK,0,0,26],
            [28,BLACK,23,43,0],
            [29,RED,0,0,30],
            [30,BLACK,29,31,32],
            [31,RED,0,0,30],
            [32,BLACK,30,34,35],
            [33,RED,0,0,34],
            [34,BLACK,33,0,32],
            [35,RED,32,37,43],
            [36,BLACK,0,0,37],
            [37,BLACK,36,40,35],
            [38,BLACK,0,39,40],
            [39,RED,0,0,38],
            [40,RED,38,41,37],
            [41,BLACK,0,42,40],
            [42,RED,0,0,41],
            [43,BLACK,35,53,28],
            [44,BLACK,0,0,45],
            [45,RED,44,46,48],
            [46,BLACK,0,47,45],
            [47,RED,0,0,46],
            [48,BLACK,45,50,53],
            [49,BLACK,0,0,50],
            [50,RED,49,51,48],
            [51,BLACK,0,52,50],
            [52,RED,0,0,51],
            [53,RED,48,57,43],
            [54,RED,0,0,55],
            [55,BLACK,54,56,57],
            [56,RED,0,0,55],
            [57,BLACK,55,59,53],
            [58,RED,0,0,59],
            [59,BLACK,58,0,57],
            ]
    for i in range(len(tree)):
        nodes[tree[i][0]].color=tree[i][1]
        nodes[tree[i][0]].left=nodes[tree[i][2]]
        nodes[tree[i][0]].right=nodes[tree[i][3]]
        nodes[tree[i][0]].p=nodes[tree[i][4]]
    # 打印二叉树
    tr=rbtree(nodes=nodes)
    print(tr)
```

**备注：**

这真的是一个红黑树的一个很好的实现，还可以可视化的打印整棵树，这里给出正常的构造树的方法，只需给出果子的key和value：

```python
if __name__ == '__main__':
    tr=rbtree(data={'1':'1','2':'2'}.items())
    print(tr)
```


## 0x03

根据提示3，从树上取走第 18,35,53,50,14,28,19,6,54,36 个果子：

```python
    for i in [18,35,53,50,14,28,19,6,54,36]:
        tr.delete(tr.force_search(i))

```

## 0x04

根据提示4和5，获取第[8,56,47,37,52,34,17,8,8,29,7,47,40,57,46,24,34,34,57,29,22,5,16,57,24,29,8,12,57,12,12,21,33,34,55,51,22,45,34,31,1,23]果子的值，并且按照颜色对其ascii+1或-1，即可得到flag

```python
    s=""
    for i in [8,56,47,37,52,34,17,8,8,29,7,47,40,57,46,24,34,34,57,29,22,5,16,57,24,29,8,12,57,12,12,21,33,34,55,51,22,45,34,31,1,23]:
        node=tr.force_search(i)
        if node.color==BLACK:
            s+=chr(ord(node.value)-1)
        else:
            s+=chr(ord(node.value)+1)
    print(s)
```

算出flag为：
flag{10ff49a7-db11-4e43-b4f6-66ef12ceb19d}

# martricks
刚拿到这题就感觉跟符号执行有关系，可惜没有贯彻思想继续做下去，不过解法蛮简单的，这里简单记录一下，也是当学习一下angr吧：

## 0x01

拿到题目ida打开，大概F5看一下，有一个判断，如果等于0就congrats否则wrong，那么记下这两处字符串的地址。

![1535025943800](assets\1535025943800.png)

## 0x02

接下来就可以用angr调用该文件，根据符号执行让我们执行到400A84地址，其中避免经过400A90地址

```python
import angr


def angr_example():
    p = angr.Project("./martricks")
    simgr = p.factory.simulation_manager(p.factory.full_init_state())
    simgr.explore(find=0x400A84, avoid=0x400A90)  # 成功路径，失败路径

    return simgr.found[0].posix.dumps(0).strip('\0\n')


if __name__ == '__main__':
    print angr_example()
```

等待一会后得到flag：

flag{Everyth1n_th4t_kill5_m3_m4kes_m3_fee1_aliv3}



**注：** 所有程序题目已经上传至GitHub：https://github.com/Anemone95/ctf_wp/tree/master/wangding2018
