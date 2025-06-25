CREATE TABLE public."UserDB" (
    id int NOT NULL PRIMARY KEY,
    username varchar(256) NOT NULL,
    password varchar(256) NOT NULL,
    firstname varchar(256) NOT NULL,
    middlename varchar(256),
    lastname varchar(256) NOT NULL
);