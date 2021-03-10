CREATE TABLE users (
	name 		varchar(80) UNIQUE,
	email 		varchar(50) UNIQUE,
	password 	varchar(50)
);

INSERT INTO users VALUES 
	('user1', 'user1@gmail.com', '11112222Aa'),
	('user2', 'user2@gmail.com', '12345678Zx'),
	('user3', 'user3@gmail.com', '11111111XXc');