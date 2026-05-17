# ADD ALIAS COMMAND TO UBUNTU

## Steps:

1. Open your terminal.
2. Open and edit your shell configuration file (usually `~/.bashrc` for the default Bash shell, or `~/.zshrc` if you are using Zsh) using nano editor:
   ```bash
   nano ~/.bashrc
   ```
3. Scroll to the very bottom of the file and add your custom alias commands. For example, to map different PHP binary paths to short alias commands:
   ```bash
   alias php83="/www/server/php/83/bin/php"
   alias php81="/www/server/php/81/bin/php"
   ```
4. Save the changes and exit the nano editor by pressing `Ctrl + O`, then `Enter` to save, and `Ctrl + X` to exit.
5. Apply the changes immediately to your current terminal session using the `source` command:
   ```bash
   source ~/.bashrc
   ```
6. Verify that the aliases are working properly by running the commands to check their versions:
   ```bash
   php83 -v
   php81 -v
   ```

## Note:

- To view the list of all currently active aliases on your system, simply run the command `alias`.
- If you want the alias to be available globally for all users on the server, add the alias lines to the `/etc/bash.bashrc` file instead of `~/.bashrc`.
- To temporarily bypass an alias and run the default or underlying system command, prepend a backslash before the command (example: `\php83`).
- To temporarily disable an alias, use the `unalias` command (example: `unalias php83`). To remove it permanently, delete the alias line from `~/.bashrc` and run `source ~/.bashrc`.
