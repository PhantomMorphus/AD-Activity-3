CREATE EXTENSION IF NOT EXISTS "pgcrypto";

CREATE TABLE IF NOT EXISTS "tasks" (
    "taskID" uuid PRIMARY KEY DEFAULT gen_random_uuid(),
    "projectID" uuid NOT NULL REFERENCES "projects"("projectID") ON DELETE CASCADE,
    "assignedUserID" uuid REFERENCES "user"("userID") ON DELETE SET NULL,
    "taskName" varchar(256) NOT NULL,
    "taskDescription" text,
    "status" varchar(64) DEFAULT 'pending',
    "dueDate" date
);