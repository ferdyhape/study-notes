# Django Deployment Guide with aaPanel, Nginx, and Python Manager

I get so bored when I have to search for more tutorials and solve more errors when deploying Django projects. So, I decided to write this tutorial to walk through the steps of how to deploy a Django project on your VPS server using aaPanel, Nginx, and Python Manager.

## Environment Specifications

- Operating System: Ubuntu 20.04 (VPS)
- Control Panel: aaPanel
- Python Manager: 2.0.0
- Django Version: 3.2.25
- Process Manager: Gunicorn
- Database: MySQL 5.7
- Web Server: Nginx 1.24.0

## Prerequisites

1. aaPanel installed on your server
2. Python Manager 2.0.0 installed via aaPanel
3. MySQL 5.7 installed and configured

## Deployment Steps

### 1. Project Setup

For this example, we'll use a sample project:

```bash
https://github.com/ferdyhape/Django_Product_Management.git
```

Clone the project to your server directory. For example, if your project directory is `/www/wwwroot/django`:

```bash
git clone https://github.com/ferdyhape/Django_Product_Management.git
```

Example of the cloning process:
<img src="/img/django-nginx/clone-project.png" width="700" style="display: block; margin-top: 10px;">

After cloning:
<img src="/img/django-nginx/after-clone.png" width="700" style="display: block; margin-top: 10px;">

### 2. Python Project Configuration

1. Access the aaPanel dashboard and navigate to Python Manager

   - If Python Manager isn't visible, enable it via App Store → Display on Dashboard
     <img src="/img/django-nginx/py-manager.png" width="700" style="display: block; margin-top: 10px;">

2. Click "Add Project" and configure your settings:
   <img src="/img/django-nginx/add-project.png" width="500" style="display: block; margin-top: 10px;">

### 3. Django Settings Configuration

1. Open your project's `settings.py` file and update the following:

Configure allowed hosts:

```python
ALLOWED_HOSTS = ['yourdomain.com', 'youripaddress']
```

<!-- ![Settings Allowed Host](/img/django-nginx/settings-allowed-host.png) -->
<img src="/img/django-nginx/settings-allowed-host.png" width="600" style="display: block; margin-top: 10px;">

### 4. Database Setup

1. In aaPanel, go to Database → MySQL tab and click "Add DB"
   <!-- ![Create DB](/img/django-nginx/create-db.png) -->
   <img src="/img/django-nginx/create-db.png" width="700" style="display: block; margin-top: 10px;">

2. Fill in the database details as needed
   <!-- ![DB Created](/img/django-nginx/db-created.png) -->
   <img src="/img/django-nginx/db-created.png" width="500" style="display: block; margin-top: 10px;">

3. Update your `settings.py` with the database configuration:

```python
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.mysql',
        'NAME': 'your_db_name',
        'USER': 'your_db_user',
        'PASSWORD': 'your_db_password',
        'HOST': 'localhost',
        'PORT': '3306',
        'OPTIONS': {
            "sql_mode": "STRICT_TRANS_TABLES",
        }
    }
}
```

4. Update timezone settings:

```python
TIME_ZONE = "Asia/Jakarta" # Change to your timezone
# USE_I18N = True
# USE_TZ = True
```

5. Configure static and media files:

```python
STATIC_URL = "/assets/"
STATICFILES_DIRS = [os.path.join(BASE_DIR, "assets")]

DEFAULT_AUTO_FIELD = "django.db.models.BigAutoField"

MEDIA_ROOT = os.path.join(BASE_DIR, "file_upload")  # file_upload is the folder name
MEDIA_URL = "/media/"  # media is the url name
```

### 5. Dependencies Installation

Navigate to your project's virtual environment directory (you'll see a unique folder name):

<!-- ![Unique Folder](/img/django-nginx/unique-folder.png) -->
<img src="/img/django-nginx/unique-folder.png" width="700" style="display: block; margin-top: 10px;">

Open terminal in that directory:

<!-- ![Terminal](/img/django-nginx/terminal.png) -->
<img src="/img/django-nginx/terminal.png" width="700" style="display: block; margin-top: 10px;">

Install requirements:

```bash
unique_folder_name/bin/pip3 install -r requirements.txt
```

Example of installation:

<!-- ![Install Requirements](/img/django-nginx/install-requirements.png) -->
<img src="/img/django-nginx/install-requirements.png" width="700" style="display: block; margin-top: 10px;">

Note: You can use the tab key to autocomplete the folder name.

### 6. Database Migration

Run migrations:

```bash
unique_folder_name/bin/python3 manage.py migrate
```

Example of migration:

<!-- ![Migrate DB](/img/django-nginx/migrate-db.png) -->
<img src="/img/django-nginx/migrate-db.png" width="700" style="display: block; margin-top: 10px;">

### 7. Domain Mapping

1. In Python Manager, click "Mapping" for your project:
   <!-- ![Mapping](/img/django-nginx/mapping.png) -->
   <img src="/img/django-nginx/mapping.png" width="700" style="display: block; margin-top: 10px;">

2. Configure project settings including user permissions:
   <!-- ![Config](/img/django-nginx/config.png) -->
   <img src="/img/django-nginx/config.png" width="600" style="display: block; margin-top: 10px;">

### 8. Nginx Configuration

1. Go to Website section in aaPanel and click "Config" on your project
   <!-- ![Nginx Config](/img/django-nginx/nginx-conf.png) -->
   <img src="/img/django-nginx/nginx-conf.png" width="700" style="display: block; margin-top: 10px;">

2. Add static files location to your Nginx configuration:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    ...

    # Add this location for the static files
    location /assets/ {
        autoindex on;
        alias /www/wwwroot/django/Django_Product_Management/assets/;
    }
    ...
}
```

### 9. File Upload Permissions

Set proper permissions for media uploads:

```bash
chown -R www-data:www-data file_upload
```

## Verification

Your Django application should now be accessible through your configured domain or IP address.

## Troubleshooting

- Check aaPanel's error logs if the application doesn't start
- Verify Nginx configuration syntax
- Ensure all file permissions are correctly set
- Confirm database connectivity

## Additional Notes

- Regularly backup your database and media files
- Keep your Django installation updated
- Monitor server resources through aaPanel
- Configure SSL certificate for production deployment
