drop table PRODUCT_CATEGORY;
drop table PRODUCT_IMAGE;
drop table CLIENT;
drop table CATEGORY;
drop table PRODUCT;
drop table PROJECT;
drop table ADMIN;


create table CLIENT
(
    client_id int auto_increment
        primary key,
    client_gname varchar(50) not null,
    client_fname varchar(50) not null,
    client_street varchar(100),
    client_suburb varchar(50),
    client_state varchar(6),
    client_pc varchar(4),
    client_email varchar(50),
    client_mobile varchar(12),
    client_mailinglist varchar(1)


);
create table CATEGORY
(
    category_id int auto_increment
        primary key,
    category_name varchar(100) not null

);
create table PRODUCT
(
    product_id int auto_increment
        primary key,
    product_name varchar(100) not null,
    product_purchase_price int,
    product_sale_price int,
    product_country_of_origin varchar(40)

);
create table PRODUCT_CATEGORY
(
    product_id int  not null,
    category_id int not null,
    constraint PRODUCT_CATEGORY_id__pk
        primary key (product_id, category_id),
    constraint PRODUCT_CATEGORY_id_fk
        foreign key (product_id) references PRODUCT (product_id),
    constraint CATEGORY_PRODUCT_id_fk
        foreign key (category_id) references CATEGORY (category_id)


);
create table PROJECT
(
    project_id int not null primary key,
    project_desc varchar(100) not null ,
    project_country varchar(50),
    project_city varchar(50)


);
create table PRODUCT_IMAGE
    (
        image_id int not null primary key auto_increment,
        product_id int not null,
        image_name  varchar(40) not null,
        constraint PRODUCT_IMAGE_PRODUCT_id_fk
            foreign key (product_id) references PRODUCT (product_id)

);
create table ADMIN
(
    admin_id int not null primary key,
    uname varchar(255),
    pword  varchar(255)

);





