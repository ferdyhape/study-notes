# HOSTING LARAVEL ON PANEL | (PUBLIC_HTML)

## Steps:

1. Zip your Laravel project folder.
2. Upload the zip file to your server (Root directory).
3. Extract the zip file (extracted folder name example: `laravel-project`).
4. Open the extracted folder and copy file and folder in public directory folder to public_html folder.
5. Open `index.php` file in public_html folder and change the path after `require` function.
   before:
   ```php
   require __DIR__.'/../vendor/autoload.php';
   ```
   after:
   ```php
   require __DIR__.'/../laravel-project/vendor/autoload.php';
   ```
6. Genrate symbolic link for storage folder (Run the following command in the terminal)

   ```bash
   ln -s /home/username/laravel-project/storage/app/public /home/username/public_html/storage
   ```

7. Update the `.env` file in the laravel-project folder
   ```bash
    APP_ENV=production
    APP_URL=http://yourdomain.com
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    DB_HOST=localhost
    DB_PORT=3306
   ```

## Troubleshooting:

- Permission issue: If you face permission issue, you can change the permission of the storage folder.
  ```bash
  chmod -R 777 /home/username/laravel-project/storage
  ```
  if you face permission issue in the public_html folder, you can change the permission of the public_html folder.
  ```bash
  chmod -R 777 /home/username/public_html
  ```
- Symbolic link issue: If you face symbolic link issue, you can remove the symbolic link and create it again.
  ```bash
  rm -rf /home/username/public_html/storage && ln -s /home/username/laravel-project/storage/app/public /home/username/public_html/storage
  ```
- Htaccess issue: If you face htaccess issue, you can copy the htaccess file from the public directory to the public_html directory.
  `bash
cp /home/username/laravel-project/public/.htaccess /home/username/public_html/.htaccess
`
  or if you don't have the htaccess file in the public directory, you can create a new htaccess file in the public_html directory.
  `bash
    touch /home/username/public_html/.htaccess
    `

  and add the following code in the htaccess file.

  ```bash
  # Default Laravel htaccess code
  <IfModule mod_rewrite.c>
  <IfModule mod_negotiation.c>
  Options -MultiViews -Indexes
  </IfModule>

      RewriteEngine On

      # Handle Authorization Header
      RewriteCond %{HTTP:Authorization} .
      RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

      # Redirect Trailing Slashes If Not A Folder...
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteCond %{REQUEST_URI} (.+)/$
      RewriteRule ^ %1 [L,R=301]

      # Send Requests To Front Controller...
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteRule ^ index.php [L]

  </IfModule>
  ```

  or you can also add the following code in the htaccess file.

  ```bash

    # BEGIN CyberPanel Generated Rules
    ### Rewrite Rules Added by CyberPanel Rewrite Rule Generator

    RewriteEngine On
    RewriteCond %{HTTPS}  !=on
    RewriteRule ^/?(.*) https://%{SERVER_NAME}/$1 [R,L]
    ### End CyberPanel Generated Rules.

    # BEGIN WordPress
    # The directives (lines) between BEGIN WordPress and END WordPress are
    # dynamically generated, and should only be modified via WordPress filters.
    # Any changes to the directives between these markers will be overwritten.
    <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
    </IfModule>

    # END WordPress

    # Block WordPress xmlrpc.php requests
    <Files xmlrpc.php>
    order deny,allow
    deny from all
    allow from 123.123.123.123
    </Files>
  ```
