USE duck_store;


INSERT INTO product VALUES ('0101001','Bat',1,8.99,
'A bat duck');
INSERT INTO product VALUES ('0101002','Cow',1,8.99,
'A cow duck');
INSERT INTO product VALUES ('0101003','Pug',1,8.99,
'A pug duck');
INSERT INTO product VALUES ('0101004','Turtle',1,8.99,
'A turtle duck');
INSERT INTO product VALUES ('0102001','Elvis Presley',2,12.99,
'An Elvis Presley duck');
INSERT INTO product VALUES ('0102002','Godfather',2,15.99,
'A Godfather duck');
INSERT INTO product VALUES ('0102003','Harry Potter',2,9.99,
'A Harry Potter duck');
INSERT INTO product VALUES ('0102004','Paul McCartney',2,12.99,
'A Paul McCartney duck');
INSERT INTO product VALUES ('0103001','Football',3,9.99,
'A Football duck');
INSERT INTO product VALUES ('0103002','Soccer',3,9.99,
'A Soccer duck');
INSERT INTO product VALUES ('0103003','Tennis Man',3,8.99,
'A Tennis Man duck');
INSERT INTO product VALUES ('0103004','Tennis Woman',3,8.99,
'A Tennis Woman duck');
INSERT INTO product VALUES ('0104001','Christmas Tree',4,10.99,
'A Christmas Tree duck');
INSERT INTO product VALUES ('0104002','Nutcracker',4,10.99,
'A Nutcracker duck');
INSERT INTO product VALUES ('0104003','Red Ornament',4,8.99,
'A Red Ornament duck');
INSERT INTO product VALUES ('0104004','Santa Claus',4,12.99,
'A Santa Claus duck');

INSERT INTO categories VALUES (1,'Animals');
INSERT INTO categories VALUES (2,'Pop Culture');
INSERT INTO categories VALUES (3,'Sports');
INSERT INTO categories VALUES (4,'Seasonal');

INSERT INTO users VALUES ('admin', sha1('admin'), 1);