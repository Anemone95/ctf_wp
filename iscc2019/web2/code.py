from PIL import Image
import pytesseract

image = Image.open('/root/code.jpg')
code = pytesseract.image_to_string(image)

f = open('/root/result.txt','w')
f.write(code)
f.close()
