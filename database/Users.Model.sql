DROP TABLE IF EXISTS "user" CASCADE;

CREATE EXTENSION IF NOT EXISTS "pgcrypto";

CREATE TABLE IF NOT EXISTS "user" (
    "userID" uuid PRIMARY KEY DEFAULT gen_random_uuid(),
    "Username" varchar(256) NOT NULL,
    "role" varchar(256) NOT NULL,
    "fName" varchar(256) NOT NULL,
    "lName" varchar(256) NOT NULL,
    "Password" varchar(256) NOT NULL
);

SELECT "Username", "Password" FROM "user";