# Deploy Django with Nginx and Python Manager

## Tested on

- Ubuntu 20.04 (VPS)
- Panel using `aaPanel`
- Python Manager 2.0.0
- Django 3.2.25
- Startup mode using `gunicorn`
- Database using `MySQL 5.7`
- Web server using `Nginx 1.24.0`

## Prerequisites

1. Install Python Manager
2. Install MySQL

## Steps

1.  Prepare the Django project, for example, i have a project named `Django_Product_Management` below
    ```bash
    https://github.com/ferdyhape/Django_Product_Management.git
    ```
2.  Go to your files directory for the project, and then open the terminal on that directory. Then git clone the project.
    ```bash
    git clone https://github.com/ferdyhape/Django_Product_Management.git
    ```
    For example, my project directory is `/www/wwwroot/django`, so if your project directory is different, you can adjust it.
    <img src="/img/django-nginx/clone-project.png" alt="Git Clone" width="100%">
    <img src="/img/django-nginx/after-clone.png" alt="After Clone" width="100%">
3.  After the project is cloned, go to the `aaPanel` dashboard. Then go to `Python Manager` and click `Add Project` (if you don't see python manager, you can go to `App Store` and enable `Display on Dashboard`).
    <img src="/img/django-nginx/py-manager.png" alt="Python Manager" width="100%">
    Click `Add Project` then fill the input form like below:
    <img src="/img/django-nginx/add-project.png" alt="Add Project" width="100%">
    Then click `confirm` button.

4.  After the project is added, Open your project directory and then go to your settings.py file. Double click on the file to edit it. Then change the `ALLOWED_HOSTS` to your domain or IP address and save the file.

    ```python
    ALLOWED_HOSTS = ['yourdomain.com', 'youripaddress']
    ```

    <img src="/img/django-nginx/settings-allowed-host.png" alt="Settings Allowed Host" width="100%">
    For this step, dont close your online file editor, because we will use it again later. You can minimize it.

5.  Now, we will create a new database for the project. Go to the `aaPanel` > `Database`, make sure you in the `MySQL` tab. Then click `Add DB`.
    <img src="/img/django-nginx/create-db.png" alt="Add DB" width="100%">
    Fill the input as needed, then click `confirm` button.
    <img src="/img/django-nginx/db-created.png" alt="DB Created" width="100%">
    After the database is created, save the database name, username, and password. We will use it later.

6.  Now, go back to the file manager and open the related project directory. Then go to the online text editor and open the `settings.py` file. Find the `DATABASES` configuration and change it like below:

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

    <!-- <img src="/img/django-nginx/adjust-db-config.png" alt="Adjust DB Config" width="100%"> -->

    Other than that, find and comment the `USE_I18N` and `USE_TZ` configuration like below:

    ```python
     TIME_ZONE = "Asia/Jakarta"
     # USE_I18N = True
     # USE_TZ = True
    ```

    Now, scroll down and find the `STATIC_URL`, `STATICFILES_DIRS`, `MEDIA_URL`, and `MEDIA_ROOT` configuration (for the `MEDIA_URL` and `MEDIA_ROOT` for the image upload feature). take note of that configuration, we will use it later. For example, my configuration is like below:

    ```python
     STATIC_URL = "/assets/"

     STATICFILES_DIRS = [os.path.join(BASE_DIR, "assets")]

     # Default primary key field type
     # https://docs.djangoproject.com/en/4.2/ref/settings/#default-auto-field

     DEFAULT_AUTO_FIELD = "django.db.models.BigAutoField"

     MEDIA_ROOT = os.path.join(BASE_DIR, "file_upload")  # file_upload adalah nama folder
     MEDIA_URL = "/media/"  # media adalah nama url
    ```

7.  Okay, we completed the database and settings configuration. Now, we will install the required packages for the project.
    First, go to the project directory, you can see unique folder name like as below:
    <img src="/img/django-nginx/unique-folder.png" alt="Unique Folder" width="100%">
    That unique folder name is a virtual environment for the project. Open the terminal on that directory
    <img src="/img/django-nginx/terminal.png" alt="Open Terminal" width="100%">
    Then install the required packages using the following command:

    ```bash
    unique_folder_name/bin/pip3 install -r requirements.txt
    ```

    For example, this is the command for my project:
    <img src="/img/django-nginx/install-requirements.png" alt="Install Requirements" width="100%">
    (Note: if you have trouble writing the full folder name you can write the second or third letter and then press the `tab` button on your keyboard, it will automatically complete the folder name)

8.  After the required packages are installed, we will migrate the database. Run the following command:

    ```bash
     unique_folder_name/bin/python3 manage.py migrate
    ```

    For example, this is the command for my project:
    <img src="/img/django-nginx/migrate-db.png" alt="Migrate DB" width="100%">

9.  Okay, Again to to python manager, then click the `Mapping` button on the project that you have added. Then fill the input as needed your domain or IP address and the project directory. For example, my configuration is like below:
    <img src="/img/django-nginx/mapping.png" alt="Mapping" width="100%">
    Then click the `confirm` button. Next click the `config` button, then fill the input as needed, becase iam using user `www-data` for the project (for the permission upload file), so i fill the input like below:
    <img src="/img/django-nginx/config.png" alt="Config" width="100%">
    Then click the `confirm` button.

10. Now, we will configure the Nginx server. Go to the `aaPanel` > `Website`, becase we already mapping the project, you can see the project in the list. Click the `config` button on the project.
    <img src="/img/django-nginx/nginx-conf.png" alt="Nginx Config" width="100%">
    Then add the location for the static files, you can see at the `STATIC_URL` configuration in the `settings.py` (step 6) what is the value. For example, my configuration is like below:

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

    Because i use the `assets` folder for the static files, so i add the location like above. Then click the `confirm` button.

11. Last step, we will configure the permission for handling the upload file. Go to the project directory, then open the terminal on that directory. Then run the following command:

    ```bash
    chown -R www-data:www-data file_upload
    ```

12. Done, now you can access your project using your domain or IP address.
