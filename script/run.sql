use tesztkitolto;


select * from users;

delete from users;

-- delete from users where uid = 3;

-- insert into users(logon, password, nev, email) values('', '', '', '');

select count(*) from users where login = 'jakab';