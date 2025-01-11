# EXPORT MYSQL DATABASE USING TERMINAL

## Steps

1. Run the following command in the terminal to export the database.
   ```bash
   mysqldump -u username -p database_name > database_name.sql
   ```
   - Replace `username` with your MySQL username.
   - Replace `database_name` with your database name.
   - It will ask for the MySQL password, enter the password and press enter.
2. Check the database_name.sql file in the current directory.
   ```bash
   ls -l database_name.sql
   ```

## Additional Information

- Using SSH, you want to download the exported database file to your local machine, you can use the following command.

  ```bash
  scp username@server_ip:/path/to/database_name.sql /path/to/local_directory
  ```

  - Replace `username` with your SSH username.
  - Replace `server_ip` with your server IP address.
  - Replace `/path/to/database_name.sql` with the path to the exported database file.
  - Replace `/path/to/local_directory` with the path to the local directory where you want to download the database file.
  - It will ask for the SSH password, enter the password and press enter.

- `pwd` command is used to print the current working directory.
- `ls` command is used to list the files and directories in the current directory.
- `ls -l` command is used to list the files and directories in the current directory with detailed information.
- `scp` command is used to copy files between hosts on a network.
