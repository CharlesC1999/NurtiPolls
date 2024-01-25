import os
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin

def sanitize_filename(filename):
    """
    清理和格式化文件名，移除或替换非法字符，並限制文件名长度。
    """
    invalid_chars = '<>:"/\\|?*'
    for char in invalid_chars:
        filename = filename.replace(char, '_')
    # 限制文件名长度
    max_length = 50
    if len(filename) > max_length:
        filename = filename[:max_length]
    return filename

def download_images_with_product_name(url, save_folder):
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')

    # 根据提供的HTML结构调整选择器
    product_blocks = soup.find_all('div', class_='three shop columns new_arrivals_margin')

    for block in product_blocks:
        img_tag = block.find('img')
        if img_tag and img_tag.get('src'):
            img_url = img_tag['src']
            if not img_url.startswith('http'):
                img_url = urljoin(url, img_url)  # 处理相对URL

            # 仅提取<span>标签中的产品名称
            product_name_parts = block.find_all('span', class_='product-category')
            if product_name_parts:
                product_name = ' '.join(part.text.strip() for part in product_name_parts)
                product_name = sanitize_filename(product_name)  # 清理文件名

                img_response = requests.get(img_url, stream=True)
                if img_response.status_code == 200:
                    img_name = os.path.join(save_folder, product_name + '.jpg')
                    with open(img_name, 'wb') as f:
                        for chunk in img_response:
                            f.write(chunk)
                else:
                    print(f"无法下载图片: {img_url}, 响应状态码: {img_response.status_code}")
            else:
                print("找不到产品名称")
        else:
            print("找不到图片URL")

# 设定目标网站
urls = ['https://www.leezen.com.tw/product.php?cat=1&p=16']

# 创建保存图片的目录
save_folder = 'su'
if not os.path.exists(save_folder):
    os.makedirs(save_folder)

for url in urls:
    download_images_with_product_name(url, save_folder)