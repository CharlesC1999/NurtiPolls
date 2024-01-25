import os
import random
import string
import time
import re

def random_string(length=10):
    """生成一個指定長度的隨機字符串"""
    letters = string.ascii_letters
    return ''.join(random.choice(letters) for i in range(length))

def extract_number(filename):
    """從檔案名稱中提取開頭的數字"""
    match = re.match(r'(\d+)', filename)
    if match:
        return match.group(1) + '_'
    else:
        return ''

def rename_files(directory):
    """重命名檔案，保留原始檔案名稱開頭的數字"""
    files = [f for f in os.listdir(directory) if f.endswith(('.png', '.jpg', '.jpeg', '.gif', '.bmp'))]
    for filename in files:
        number_prefix = extract_number(filename)
        new_name = number_prefix + random_string() + os.path.splitext(filename)[1]
        os.rename(os.path.join(directory, filename), os.path.join(directory, new_name))
        print(f'已將 "{filename}" 重命名為 "{new_name}"')

# 使用範例
directory_path = 'D:/Web/NurtiPolls/server_data/class/c_image/c_image_number'  # 將這裡替換成您的圖片目錄路徑
rename_files(directory_path)