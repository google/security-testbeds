FROM tikiwiki/php:5-apache

# 1. Fix Debian Stretch repo references and disable expiry checks
RUN sed -i \
      -e 's|http://deb.debian.org/debian|http://archive.debian.org/debian|g' \
      -e 's|http://security.debian.org/debian-security|http://archive.debian.org/debian-security|g' \
      -e '/stretch-updates/d' \
      /etc/apt/sources.list \
    && echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid

# 2. Update apt and install wget + unzip (allow unauthenticated due to deprecated archive)
RUN apt-get update \
    && apt-get install -y --allow-unauthenticated wget unzip \
    && apt-get clean

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
