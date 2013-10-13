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

*aptitude install postfix postfix-mysql Alles mit Ok einfach weiter
*service postfix stop
*mkdir -p /_data/_mail
*in /etc mv postfix postfix.bak
*die /etc/postfix von boggo kopiert
*in /etc/postfix/main.cf den hostnamen von muchtel auf monkeydev geändert
*aptitude install maildrop
*sudo groupadd -g 2000 vmail
*sudo useradd -s /usr/sbin/nologin -g vmail -u 2000 vmail -d /home/vmail -m
*mail postfächer von boggo.de nach /_data/_mail/ kopiert
*chown -R vmail:vmail /_data/_mail
*aptitude install courier-pop-ssl courier-pop courier-imap courier-imap-ssl courier-authdaemon courier-authlib-mysql
*in /etc mv courier courier.bak
*courier config verz von boggo.de kopiert
*aptitude install sasl2-bin libsasl2-2 libsasl2-modules libsasl2-modules-sql libpam-mysql
*vim /etc/default/saslauthd START=yes OPTIONS="-c -m /var/spool/postfix/var/run/saslauthd -r"
*mkdir -p /var/spool/postfix/var/run/saslauthd
*vim /etc/pam.d/smtp

`
auth    required   pam_mysql.so user=<msqluser> passwd=<mysqlpass> host=127.0.0.1 db=syscp table=mail_users usercolumn=username passwdcolumn=password_enc crypt=1
account sufficient pam_mysql.so user=<mysqluser> passwd=<mysqlpass> host=127.0.0.1 db=syscp table=mail_users usercolumn=username passwdcolumn=password_enc crypt=1
`

*adduser postfix sasl

*CREATE USER 'syscp'@'localhost' IDENTIFIED BY 'vegeha6213';
*GRANT ALL PRIVILEGES ON `syscp`.* to 'syscp'@'localhost';
*CREATE DATABASE syscp;
*Als syscp in mysql anmelden: mysql -u syscp -p
*DB wechseln \u syscp
*\. /_data/_mailstuff/syscp.sql dump importieren
*service postfix start
*service courier-authdaemon start
*service courier-imap-ssl start
*service courier-imap start
*service courier-pop-ssl start
*service courier-pop start


