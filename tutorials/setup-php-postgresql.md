# SETUP PHP POSTGRESQL

## Ammunition

- Ubuntu 22.04.3 LTS

## Steps

1. Install PostgreSQL

   ```bash
   sudo apt install postgresql postgresql-contrib
   ```

2. Check Postgree Version

   ```bash
   psql --version
   ```

3. Check PostgreSQL status

   ```bash
   sudo systemctl status postgresql
   ```

4. If PostgreSQL is not running, start it with the command:

   ```bash
   sudo systemctl start postgresql
   ```

5. Enable PostgreSQL to start on boot:

   ```bash
   sudo systemctl enable postgresql
   ```

6. Login to postgresql as superuser
   ```bash
   sudo -u postgres psql
   ```
7. Create a database
   ```sql
   CREATE DATABASE database_name;
   ```
8. Create a user
   ```sql
   CREATE USER user_name WITH PASSWORD 'password';
   ```
9. Grant privileges to the user
   ```sql
   GRANT ALL PRIVILEGES ON DATABASE database_name TO user_name;
   ```
10. Exit from postgresql
    ```bash
    \q
    ```

## Available Commands

<b>Note</b> : Assume you are logged in as superuser (with command: sudo -u postgres psql)

- General Commands
  | Command | Description |
  | ----------------------------------------------------------------- | --------------------------------- |
  | `\l` | Show all databases |
  | `\c database_name` | Connect to a database |
  | `\dt` | Show all tables |
  | `\d table_name` | Show table structure |
  | `\du` | Show all users |
  | `\dp` | Show user privileges |
  | `DROP DATABASE database_name;` | Drop a database |
  | `DROP USER user_name;` | Drop a user |
  | `GRANT ALL PRIVILEGES ON DATABASE database_name TO user_name;` | Grant all privileges to a user |
  | `REVOKE ALL PRIVILEGES ON DATABASE database_name FROM user_name;` | Revoke all privileges from a user |
  | `ALTER USER user_name WITH PASSWORD 'new_password';` | Change user password |
  | `\q` | Exit from postgresql |

- Data Management Command
  | Command | Description |
  | ----------------------------------------------------------------- | --------------------------------- |
  | `SELECT * FROM table_name;` | Show all data in a table |
  | `INSERT INTO table_name (column1, column2, ...) VALUES (value1, value2, ...);` | Insert data into a table |
  | `UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;` | Update data in a table |
  | `DELETE FROM table_name WHERE condition;` | Delete data from a table |
  | `SELECT COUNT(*) FROM table_name;` | Count total data in a table |
  | `SELECT DISTINCT column_name FROM table_name;` | Show distinct data in a column |

- Table Management Command
  | Command | Description |
  | ----------------------------------------------------------------- | --------------------------------- |
  | `CREATE TABLE table_name (column1 datatype1, column2 datatype2, ...);` | Create a table |
  | `ALTER TABLE table_name ADD column_name datatype;` | Add a column to a table |
  | `ALTER TABLE table_name DROP COLUMN column_name;` | Drop a column from a table |
  | `ALTER TABLE table_name RENAME COLUMN column_name TO new_column_name;` | Rename a column in a table |
  | `ALTER TABLE table_name RENAME TO new_table_name;` | Rename a table |
  | `DROP TABLE table_name;` | Drop a table |
  | `TRUNCATE TABLE table_name;` | Truncate a table |

- Index Management Command
  | Command | Description |
  | ----------------------------------------------------------------- | --------------------------------- |
  | `CREATE INDEX index_name ON table_name (column_name);` | Create an index |
  | `DROP INDEX index_name;` | Drop an index |

- Backup and Restore Command
  | Command | Description |
  | ----------------------------------------------------------------- | --------------------------------- |
  | `pg_dump -U user_name database_name > file_name.sql` | Backup a database |
  | `psql -U user_name -d database_name -f file_name.sql` | Restore a database |

- See Log and Status Command
  | Command | Description |
  | ----------------------------------------------------------------- | --------------------------------- |
  | `SELECT * FROM pg_stat_activity;` | Show all active connections |
  | `SELECT * FROM pg_locks;` | Show all active locks |
  | `SELECT pg_size_pretty(pg_database_size('database_name'));` | Show database size |

<b>Highlight</b> :

- If you want to delete a database, you cannot drop it while you're connected to it. PostgreSQL prevents deleting a database that is currently in use.

- To successfully delete a database:

  1. Exit the current database session using `\q` or connect to a different database (e.g., `postgres`).
  2. Connect to a different database (e.g., `postgres`) using `\c postgres`.
  3. Drop the database with `DROP DATABASE database_name`;.
  4. Verify the deletion using `\l` to list databases.

- If there are active connections to the database you want to delete, you can terminate them manually before dropping the database:
  ```sql
  SELECT pg_terminate_backend(pid)
  FROM pg_stat_activity
  WHERE datname = 'your_database_name';
  ```
