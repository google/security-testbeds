#!/bin/bash

wppass=$(cat /flag/wp-pass.txt)

# ele nao espera o server subir e roda de qualquer forma
sleep 2 

curl -X POST http://127.0.0.1:1337/wp-admin/install.php?step=2 \
-H "Cache-Control: max-age=0" \
-H "sec-ch-ua: \"Chromium\";v=\"125\", \"Not.A/Brand\";v=\"24\"" \
-H "sec-ch-ua-mobile: ?0" \
-H "sec-ch-ua-platform: \"Linux\"" \
-H "Upgrade-Insecure-Requests: 1" \
-H "Origin: http://127.0.0.1:1337" \
-H "Content-Type: application/x-www-form-urlencoded" \
-H "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.6422.112 Safari/537.36" \
-H "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7" \
-H "Sec-Fetch-Site: same-origin" \
-H "Sec-Fetch-Mode: navigate" \
-H "Sec-Fetch-User: ?1" \
-H "Sec-Fetch-Dest: document" \
-H "Referer: http://127.0.0.1:1337/wp-admin/install.php" \
-H "Accept-Encoding: gzip, deflate, br" \
-H "Accept-Language: en-US,en;q=0.9" \
-H "Connection: keep-alive" \
-d "weblog_title=WordPress&user_name=admin&admin_password=$wppass&admin_password2=$wppass&pw_weak=on&admin_email=admin%40kctf.com&Submit=Install+WordPress&language=" \
-o /dev/null > /dev/null 2>&1

# curl -X POST http://chal-wordpress.internet-ctf.kctf.cloud:1337/wp-admin/install.php?step=2 \
# -H "Cache-Control: max-age=0" \
# -H "sec-ch-ua: \"Chromium\";v=\"125\", \"Not.A/Brand\";v=\"24\"" \
# -H "sec-ch-ua-mobile: ?0" \
# -H "sec-ch-ua-platform: \"Linux\"" \
# -H "Upgrade-Insecure-Requests: 1" \
# -H "Origin: http://chal-wordpress.internet-ctf.kctf.cloud:1337" \
# -H "Content-Type: application/x-www-form-urlencoded" \
# -H "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.6422.112 Safari/537.36" \
# -H "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7" \
# -H "Sec-Fetch-Site: same-origin" \
# -H "Sec-Fetch-Mode: navigate" \\
# -H "Sec-Fetch-User: ?1" \
# -H "Sec-Fetch-Dest: document" \
# -H "Referer: http://chal-wordpress.internet-ctf.kctf.cloud:1337/wp-admin/install.php" \
# -H "Accept-Encoding: gzip, deflate, br" \
# -H "Accept-Language: en-US,en;q=0.9" \
# -H "Connection: keep-alive" \
# -d "weblog_title=WordPress&user_name=admin&admin_password=$wppass&admin_password2=$wppass&pw_weak=on&admin_email=admin%40kctf.com&Submit=Install+WordPress&language=" \
# -o /dev/null > /dev/null 2>&1