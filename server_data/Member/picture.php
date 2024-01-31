<!-- wu 讀取檔案  -->
<?php
echo __DIR__;

$path = 'C:\xampp\htdocs\project1\server_data\Member\image_members';

$handle = opendir($path);
while ($file = readdir($handle)) {
    echo "$file<br>";
}

closedir($handle);
