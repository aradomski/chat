/*MYSQL*/
CREATE TABLE users (
user_id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(user_id),
login         varchar(30),
olsah         varchar(35),
email		varchar(30),
registrationdate  date,
status            int
);

CREATE TABLE posts
(post_id integer AUTO_INCREMENT, 
date date, 
time time,
user_id integer, 
tresc text,
Primary Key (post_id), 
Foreign Key (user_id) references users(user_id));
/*PSQL*/
CREATE TABLE users (
user_id       serial Primary Key,
login         varchar(30),
olsah         varchar(35),
email		varchar(30),
registrationdate  date,
status            int
);
CREATE TABLE posts
(post_id serial Primary Key,
date date, 
time time,
user_id integer Foreign Key references users(user_id), 
tresc text,
);
