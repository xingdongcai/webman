create table customer
(
    customer_id int auto_increment
        primary key,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    password int(20) null,
    mobile_no int(20) null
);

create table product
(
    product_id int(20) not null,
    product_name varchar(25) not null,
    product_desc varchar(500) null,
    unit_price double(20,0) null,
    kit_id int(20) not null,
    constraint Product_product_id_uindex
        unique (product_id)
);

alter table product
    add primary key (product_id);



