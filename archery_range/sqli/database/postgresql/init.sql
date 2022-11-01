-- Copyright 2019 Google LLC
--
-- Licensed under the Apache License, Version 2.0 (the "License");
-- you may not use this file except in compliance with the License.
-- You may obtain a copy of the License at
--
-- https://www.apache.org/licenses/LICENSE-2.0
--
-- Unless required by applicable law or agreed to in writing, software
-- distributed under the License is distributed on an "AS IS" BASIS,
-- WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
-- See the License for the specific language governing permissions and
-- limitations under the License.

-- Select database to use

\connect archery_range;

-- Create and initialize users with 5 rows

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  username varchar(20) NOT NULL,
  color varchar(20) NOT NULL,
  email varchar(50) NOT NULL,
  PRIMARY KEY (username)
);

INSERT INTO users VALUES ('casper.bessie','green','immanuel.walker@example.net'),
('jazmyne81','yellow','znicolas@example.net'),
('jaylan.zulauf','purple','ptowne@example.net'),
('ddietrich','orange','alarkin@example.org'),
('voreilly','green','lind.maye@example.org');

-- Create and initialize items with 20 rows

DROP TABLE IF EXISTS items;

CREATE SEQUENCE items_seq;

CREATE TABLE items (
  id int check (id > 0) NOT NULL DEFAULT NEXTVAL ('items_seq'),
  name varchar(20) NOT NULL,
  description varchar(100) NOT NULL,
  price decimal(6,2) NOT NULL,
  category varchar(20) NOT NULL,
  is_available boolean NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO items VALUES ('1','king penguin plush','Long beak, with yellow, black, and white fur.','160.31','toy','1'),
('2','honey badger plush','The most aggressive badger you will ever meet.','9999.99','toy','1'),
('3','monkey plush','This guy will swing from vine to vine.','2.50','toy','1'),
('4','sunflower seeds','Small seeds that are delicious and can even grow a sunflower.','0.00','food','1'),
('5','apple','Bright red spheres with a waxy coating.','107.01','food','1'),
('6','salmon','Use it as a pet or as dinner.','9999.99','food','0'),
('7','curry paste','Add some authentic flavor to any dish.','9999.99','food','1'),
('8','coconut','It has a tough exterior, but a delicious interior.','11.16','food','1'),
('9','ginger','I do not like this, so you can have it.','0.00','food','1'),
('10','cinnamon','Who knew we could turn this tree bark into something flavorful?','57.50','food','1'),
('11','totem pole','This pole is 40 feet tall.','737.67','furniture','0'),
('12','drawer','Store your stuff, it even has a lock on it!','584.29','furniture','1'),
('13','phone','Just a good old school phone.','25.92','electronic','0'),
('14','computer','It runs LINUX!','337.50','electronic','1'),
('15','flash drive','Small and spacious, it holds 20 GB','9999.99','electronic','1'),
('16','headphones','Active co-worker cancelling.','9999.99','electronic','0'),
('17','server','Run your own website and brag about it to your friends.','1658.52','electronic','1'),
('18','lotion','Keep your skin moisturized.','9999.99','hygiene','1'),
('19','body wash','Keep your skin clean.','9999.99','hygiene','1'),
('20','perfume','Did you know perfume is unisex? Perfume just has a higher concentration of essential oils.','0.00','hygiene','1');

-- Create and initialize carts with 10 rows

DROP TABLE IF EXISTS carts;

CREATE SEQUENCE carts_seq;

CREATE TABLE carts (
  id int check (id > 0) NOT NULL DEFAULT NEXTVAL ('carts_seq'),
  username varchar(20) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO carts VALUES ('1','voreilly'),
('2','jazmyne81'),
('3','jazmyne81'),
('4','casper.bessie'),
('5','jaylan.zulauf'),
('6','voreilly'),
('7','voreilly'),
('8','ddietrich'),
('9','jazmyne81'),
('10','jazmyne81');


-- Create and initialize cartitems with 20 rows

DROP TABLE IF EXISTS cartitems;

CREATE SEQUENCE cartitems_seq;

CREATE TABLE cartitems (
  id int check (id > 0) NOT NULL DEFAULT NEXTVAL ('cartitems_seq'),
  item_id int NOT NULL,
  quantity int NOT NULL,
  cart_id int NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO cartitems VALUES ('1','20','9','6'),
('2','3','4','6'),
('3','2','5','6'),
('4','13','1','6'),
('5','11','5','2'),
('6','14','9','2'),
('7','2','5','10'),
('8','6','6','9'),
('9','8','1','9'),
('10','19','12','9'),
('11','13','11','9'),
('12','12','44','9'),
('13','18','75','9'),
('14','1','6','5'),
('15','2','12','5'),
('16','3','15','9'),
('17','5','100','9'),
('18','7','16','9'),
('19','9','22','9'),
('20','20','4','9');