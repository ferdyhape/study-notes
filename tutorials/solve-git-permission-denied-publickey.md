# SOLVE GIT PERMISSION DENIED PUBLICKEY ON UBUNTU

## Problem:

When trying to clone a repository or run Git commands via SSH on your server, you might encounter the following error:

```bash
root@your-server:/www/wwwroot/your-project# git clone git@github.com:username/repository.git
Cloning into 'repository'...
The authenticity of host 'github.com (20.205.243.166)' can't be established.
ED25519 key fingerprint is SHA256:+DiY3wvvV6TuJJhbpZisF/zLDA0zPMSvHdkr4UvCOqU.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
Warning: Permanently added 'github.com' (ED25519) to the list of known hosts.
git@github.com: Permission denied (publickey).
fatal: Could not read from remote repository.

Please make sure you have the correct access rights
and the repository exists.
```

## Steps:

1. Open your terminal on your VPS.
2. Generate a new SSH key with the following command (press `Enter` to accept all defaults when prompted):
   ```bash
   ssh-keygen -t ed25519 -C "your_email@example.com"
   ```
3. Start the SSH agent in the background:
   ```bash
   eval "$(ssh-agent -s)"
   ```
4. Add your newly generated SSH private key to the SSH agent:
   ```bash
   ssh-add ~/.ssh/id_ed25519
   ```
5. View and copy the content of your public SSH key:
   ```bash
   cat ~/.ssh/id_ed25519.pub
   ```
6. Register the SSH key in your GitHub account:
   - Login to GitHub and go to **Settings** -> **SSH and GPG keys**.
   - Click **New SSH key**.
   - Enter a title (e.g., "My VPS Production Server") and paste the public key content you copied in step 5 into the "Key" field.
   - Click **Add SSH key**.
7. Test the SSH connection to GitHub to ensure it has been successfully authenticated:
   ```bash
   ssh -T git@github.com
   ```
   If successful, you will see a message like this:
   ```text
   Hi username! You've successfully authenticated, but GitHub does not provide shell access.
   ```
8. Go back to your project directory and run your git clone command again using SSH:
   ```bash
   git clone git@github.com:username/repository.git
   ```

## Note:

- If you encounter the warning `The authenticity of host 'github.com' can't be established`, simply type `yes` and press `Enter` to save GitHub to your known hosts list.
- Always make sure to copy the `.pub` file content (public key) for GitHub registration, **NOT** the private key file.
- If you used a custom name or different file path for your keys during step 2, adjust the path in steps 4 and 5 accordingly.
