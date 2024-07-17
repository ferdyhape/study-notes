```bash
# Laravel htaccess file for a single directory
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/public/
RewriteRule ^(.\*)$ /public/$1 [L]
```
