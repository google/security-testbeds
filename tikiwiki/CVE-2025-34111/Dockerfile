FROM tikiwiki/php:5-apache


USER www-data
WORKDIR /var/www/html

#  Download and unpack TikiWiki 15.1 from the official Situla branch
RUN curl -L https://sourceforge.net/projects/tikiwiki/files/Tiki_15.x_Situla/15.1/tiki-15.1.zip/download -o tiki.zip \
    && unzip tiki.zip \
    && mv tiki-15.1/* . \
    && rm -r tiki.zip tiki-15.1

