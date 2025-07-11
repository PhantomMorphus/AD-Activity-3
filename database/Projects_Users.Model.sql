CREATE EXTENSION IF NOT EXISTS "pgcrypto";

CREATE TABLE IF NOT EXISTS "project_users" (
    "projectID" uuid NOT NULL REFERENCES "projects"("projectID") ON DELETE CASCADE,
    "userID" uuid NOT NULL REFERENCES "user"("userID") ON DELETE CASCADE,
    PRIMARY KEY ("projectID", "userID")
);