FROM tikiwiki/php:5-apache


# 3. Download and unpack TikiWiki 15.1 from the official Situla branch
WORKDIR /var/www/html
RUN wget https://sourceforge.net/projects/tikiwiki/files/Tiki_15.x_Situla/15.1/tiki-15.1.zip/download -O tiki.zip \
    && unzip tiki.zip \
    && rm tiki.zip \
    && mv tiki-15.1/* . \
    && mv tiki-15.1/.* . 2>/dev/null || true \
    && rmdir tiki-15.1

# 4. Ensure Apache user owns the files
RUN chown -R www-data:www-data /var/www/html
