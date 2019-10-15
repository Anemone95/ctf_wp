import base64

def encode(message):
    s = ''
    for i in message:
        x = ord(i) ^ 32
        x = x + 16
        s += chr(x)

    return base64.b64encode(s)

correct = 'eYNzc2tjWV1gXFWPYGlTbQ=='
flag = ''
print('Input flag:')
flag = raw_input()
if encode(flag) == correct:
    print('correct')
else:
    print('wrong')
