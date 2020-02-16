create database good_php;

grant all on good_php.* to dbuser@localhost identified by '1234';

use good_php

create table users (
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  modified datetime
);

create table quizes(

);

desc users;
