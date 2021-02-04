use pizzeria;
drop database imaginest;
create database imaginest;
use imaginest;

CREATE TABLE IF NOT EXISTS `users`(
	iduser int PRIMARY KEY auto_increment,
    mail varchar(40) unique,
    username varchar(16) unique,
    passHash varchar(60),
    userFirstName varchar(60),
    userLastName varchar(120),
    creationDate datetime,
    lastSignIn datetime,
    removeDate datetime,
    active tinyint(1),
    activationDate datetime,
	activationCode varchar(64),
    resetPass tinyInt(1),
    resetPassExpiry datetime,
    resetPassCode  varchar(64)
)engine=InnoDB;
select * from users;
UPDATE `users` set active = 1,lastSignIn = "2021-01-28 18:37:12" where iduser = 1;
SELECT * FROM `users` where mail = "alexilloalexillo13@gmail.com" OR username = "alexilloalexillo13@gmail.com" AND passHash = "1234";
