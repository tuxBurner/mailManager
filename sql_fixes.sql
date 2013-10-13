alter table panel_domains add unique (domain);
alter table mail_virtual add unique (email);
alter table mail_users add unique (email);