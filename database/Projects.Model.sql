CREATE EXTENSION IF NOT EXISTS "pgcrypto";

CREATE TABLE IF NOT EXISTS "projects" (
    "projectID" uuid PRIMARY KEY DEFAULT gen_random_uuid(),
    "projectName" varchar(256) NOT NULL,
    "projectDescription" text,
    "createdAt" timestamp DEFAULT CURRENT_TIMESTAMP
);