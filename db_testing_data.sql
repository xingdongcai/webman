INSERT INTO admin(uname, pword) VALUES ('admin',SHA2('admin',0));
INSERT INTO admin(uname, pword) VALUES ('admin2',SHA2('admin2',0));






INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Harry','Potter','1 Melbourne Street','Melbourne','VIC','3000','harry@mail.com','0413987754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Mary','Lee','100 Sydney Street','Sydney','NSW','2000','mary@gmail.com','0413557754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Loren','Chan','10 High Street','Clayton','VIC','3168','lor@gmail.com','0413557324',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Bruce','Lee','100 Tax Street','Sydney','NSW','2000','bruce@gmail.com','0413557754',0);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Jason','Mery','80 Sydney Street','Sydney','NSW','2000','jason@gmail.com','0657557754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Henry','White','21 Swan Street','Sydney','NSW','2000','henry@gmail.com','0413287754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Jon','Snow','12 Kendy Street','Sydney','NSW','2000','jon@gmail.com','0413998754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Chris','Swift','2 Kris Street','Richmond','VIC','3132','kris@gmail.com','0413838754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Ben','Bond','12 Mail Street','Sydney','NSW','2000','jon@gmail.com','0413998754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Lin','Lau','12 Chad Street','Melbourne','VIC','3000','lin@gmail.com','0413848754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Hedy','Brown','7 Ken Street','Sydney','NSW','2000','jon@gmail.com','0413944754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Lory','White','1/3 Lock Street','South Yarra','VIC','3141','jon@gmail.com','0403998754',1);
INSERT INTO client(client_gname,client_fname, client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES ('Emma','Bilston','3 Ann Street','Prahran','VIC','3181','emma@gmail.com','0443198554',0);


INSERT INTO project(project_desc, project_country, project_city) values ('good','china','beijing');

INSERT INTO category(category_name) values ('Electronics');
INSERT INTO category(category_name) values ('Clothing');
INSERT INTO category(category_name) values ('Home');
INSERT INTO category(category_name) values ('Sports');


INSERT INTO product(product_name, product_purchase_price, product_sale_price, product_country_of_origin) VALUES ('guitar','112','250','china');