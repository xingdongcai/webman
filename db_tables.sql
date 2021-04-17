# drop table PRODUCT_CATEGORY;
# drop table PRODUCT_IMAGE;
# drop table CLIENT;
# drop table CATEGORY;
# drop table PRODUCT;
# drop table PROJECT;
# drop table ADMIN;


create table client
(
    client_id int auto_increment
        primary key,
    client_gname varchar(50) not null,
    client_fname varchar(50) not null,
    client_street char(100) null,
    client_suburb varchar(50) null,
    client_state varchar(20) null,
    client_pc varchar(4) null,
    client_email varchar(50) null,
    client_mobile varchar(12) null,
    client_mailinglist tinyint(1) null
);


create table category
(
    category_id int auto_increment
        primary key,
    category_name varchar(100) not null
);

create table product
(
    product_id int auto_increment
        primary key,
    product_name varchar(100) not null,
    product_purchase_price double(11,2) null,
    product_sale_price double(11,2) null,
    product_country_of_origin varchar(40) null
);


create table product_category
(
    product_id int not null,
    category_id int not null,
    primary key (product_id, category_id),
    constraint CATEGORY_PRODUCT_id_fk
        foreign key (category_id) references category (category_id),
    constraint PRODUCT_CATEGORY_id_fk
        foreign key (product_id) references product (product_id)
);


create table project
(
    project_id int auto_increment
        primary key,
    project_desc varchar(100) not null,
    project_country varchar(50) null,
    project_city varchar(50) null
);


create table product_image
(
    image_id int auto_increment
        primary key,
    product_id int not null,
    image_name varchar(40) not null,
    constraint PRODUCT_IMAGE_PRODUCT_id_fk
        foreign key (product_id) references product (product_id)
);


create table admin
(
    admin_id int auto_increment
        primary key,
    uname varchar(255) null,
    pword varchar(255) null
);
create table searchtable
(
    category_id int default 0 not null,
    category_name varchar(100) not null
);






