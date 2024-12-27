# GMAIL SMTP SETUP | Usage in Laravel

## Steps:

### Google Account Configuration

1. Login to your Google account.
2. Click on the profile icon in the top right corner.
3. Click on the "Manage your Google Account" button.
4. Click on the "Security" tab.
5. Click on the "2-Step Verification" option.
6. If you haven't enabled 2-Step Verification, click on the "Get Started" button and follow the instructions.
7. After enabling 2-Step Verification, click on the "App passwords" option.
   <b>Note: if this option not available, you can visit https://myaccount.google.com/apppasswords directly (you must have 2-Step Verification enabled).</b>
8. Input app name and click on the "Generate" button.
9. Copy the generated password and save it in a safe place.

### Laravel Configuration

1. Open your `.env` file
2. Set the following values:
   ```env
   MAIL_MAILER="smtp"
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=<<your_email@gmail.com>>
   MAIL_PASSWORD="<<your_generated_password>>"
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="hello@example.com"
   MAIL_FROM_NAME="${APP_NAME}"
   ```
3. Replace `<< >>` with your email and generated password.
4. Then run `php artisan config:cache`
5. Done.
