--- 
customlog: 
  - 
    format: combined
    target: /etc/apache2/logs/domlogs/plerean.com
  - 
    format: "\"%{%s}t %I .\\n%{%s}t %O .\""
    target: /etc/apache2/logs/domlogs/plerean.com-bytes_log
documentroot: /home/plereanc/public_html
group: plereanc
hascgi: 1
homedir: /home/plereanc
ip: 36.50.77.63
ipv6: 
  2001:0df7:5300:0009:0000:0000:0000:003f: 
    dedicated: 1
owner: root
phpopenbasedirprotect: 1
port: 8081
scriptalias: 
  - 
    path: /home/plereanc/public_html/cgi-bin
    url: /cgi-bin/
serveradmin: webmaster@plerean.com
serveralias: www.plerean.com ipv6.plerean.com mail.plerean.com
servername: plerean.com
ssl: 1
usecanonicalname: 'Off'
user: plereanc
userdirprotect: ''
