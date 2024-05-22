create database duck_store;

use duck_store;

create table customers
(
  customerid int unsigned not null auto_increment primary key,
  name char(60) not null,
  address char(80) not null,
  city char(30) not null,
  state char(20),
  zip char(10),
  country char(20) not null
);

create table orders
(
  orderid int unsigned not null auto_increment primary key,
  customerid int unsigned not null,
  amount float(6,2),
  date date not null,
  order_status char(10),
  ship_name char(60) not null,
  ship_address char(80) not null,
  ship_city char(30) not null,
  ship_state char(20),
  ship_zip char(10),
  ship_country char(20) not null
);

create table product
(
   productid char(7) not null primary key,
   title char(100),
   catid int unsigned,
   price float(4,2) not null,
   description varchar(255)
);

create table categories
(
  catid int unsigned not null auto_increment primary key,
  catname char(60) not null
);

create table order_items
(
  orderid int unsigned not null,
  productid char(13) not null,
  item_price float(4,2) not null,
  quantity tinyint unsigned not null,
  primary key (orderid, productid)
);

create table users
(
  username char(16) not null primary key,
  password char(40) not null,
  hasadmin bool not null
);

grant select, insert, update, delete
on duck_store.*
to duck_store@localhost identified by 'password';
