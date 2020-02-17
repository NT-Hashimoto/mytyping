create database good_php;

grant all on good_php.* to dbuser@localhost identified by '1234';

flush privileges;

use good_php

create table users (
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  modified datetime,
  score int
);

create table quizzes(
  id int not null auto_increment primary key,
  quiz varchar(255) unique
);

desc users;
