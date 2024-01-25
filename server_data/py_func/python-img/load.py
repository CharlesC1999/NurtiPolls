import os
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin

def sanitize_filename(filename):

    invalid_chars = '<>:"/\\|?*'
    for char in invalid_chars:
        filename = filename.replace(char, '_')
    # file_length
    max_length = 50
    if len(filename) > max_length:
        filename = filename[:max_length]
    return filename

def download_images_from_url(url, save_folder):

    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')
    img_tags = soup.find_all('img')

    for img in img_tags:
        img_url = img.get('src')
        full_img_url = urljoin(url, img_url)
        img_response = requests.get(full_img_url, stream=True)
        if img_response.status_code == 200:
            img_name = os.path.join(save_folder, sanitize_filename(img_url.split('/')[-1]))
            with open(img_name, 'wb') as f:
                for chunk in img_response:
                    f.write(chunk)

# website links
urls = ['https://www.organicshops.cc/categories.aspx?cid=681', 'https://www.organicshops.cc/categories.aspx?cid=682', 'https://www.organicshops.cc/categories.aspx?cid=684']

save_folder = 'downloaded_images'
if not os.path.exists(save_folder):
    os.makedirs(save_folder)

for url in urls:
    download_images_from_url(url, save_folder)