# MailManage

## Infos
This is a simple php script which can be used to manage email addresses for a vmail-setup

## Configuration
* Copy the **config.php.dist** file to **config.php**
* Change the settings in the **config.php** for your needs
* chmod 0777 templates_c
* you can user php createPassword.php <password> to create a hashed password

## Database
Database schema is located under: *sql/initial.sql*

## Installing a vmail server under Ubuntu

* aptitude install postfix postfix-mysql Alles mit Ok einfach weiter
* service postfix stop
* mkdir -p /_data/_mail
* in /etc mv postfix postfix.bak
* copy vmailsetup/postfix to /etc/postfix
* change <domain> in /etc/postfix/main.cf
* user = <mysqluser>
  password = <mysqlpass>
  dbname = <mysqldb>
* aptitude install maildrop
* sudo groupadd -g 2000 vmail
* sudo useradd -s /usr/sbin/nologin -g vmail -u 2000 vmail -d /home/vmail -m
* chown -R vmail:vmail /_data/_mail
* aptitude install courier-pop-ssl courier-pop courier-imap courier-imap-ssl courier-authdaemon courier-authlib-mysql
* in /etc mv courier to courier.bak
* copy vmailsetup/courier to /etc/courier
* user = <mysqluser>
  password = <mysqlpass>
  dbname = <mysqldb>
* aptitude install sasl2-bin libsasl2-2 libsasl2-modules libsasl2-modules-sql libpam-mysql
* vim /etc/default/saslauthd START=yes OPTIONS="-c -m /var/spool/postfix/var/run/saslauthd -r"
* mkdir -p /var/spool/postfix/var/run/saslauthd
* copy  vmailsetup/smtp to /etc/pam.d/smtp
* adduser postfix sasl
* sql/initial.sql mit db user imporieren
* service postfix start
* service courier-authdaemon start
* service courier-imap-ssl start
* service courier-imap start
* service courier-pop-ssl start
* service courier-pop start


