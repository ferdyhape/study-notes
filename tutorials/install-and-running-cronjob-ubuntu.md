# INSTALL AND RUN CRONJOB ON UBUNTU

## Steps:

1. install cronjob with command "sudo apt-get install cron"
2. start cronjob with command "sudo service cron start"
3. check the status of cronjob with command "sudo service cron status"
4. create a .sh script for the execution to be done by cronjob (example: /home/ferdyhape/tes-cron/tes-cron.sh)
5. (optional) command "select-editor" to choose the editor used to edit crontab
6. add the script to the cronjob with the command "crontab -e", with the format

   ```bash
   # min hour day month day_of_week command
   * * * * * /bin/bash /home/ferdyhape/tes-cron/tes-cron.sh
   ```

7. save the changes and exit the editor
8. check the cronjob list with the command "crontab -l"
9. check the cronjob log with the command "grep CRON /var/log/syslog"

## Note:

- For the script to be executed by cronjob, the script must have execute permission. Give execute permission with the command "chmod +x /home/ferdyhape/tes-cron/tes-cron.sh"
- The cronjob will run every minute, to change the schedule, adjust the time in the format "min hour day month day_of_week command"
- To stop the cronjob, use the command "sudo service cron stop"
- To restart the cronjob, use the command "sudo service cron restart"
- To remove the cronjob, use the command "crontab -r"
