# SHORTCUT LARAVEL ARTISAN COMMANDS

## KEY FOR SHORTCUTS

### Make

```bash
-m = migration
-c = controller
-r = resource (resource controller)
-f = factory
-s = seeder
-a = all (controller, model, migration, resource, factory, seeder)
```

Example:

- create model, migration, controller, resource, factory, and seeder

  ```bash
  php artisan make:model Product -a
  ```

- create model, migration, and controller

  ```bash
  php artisan make:model Product -m -c
  ```

  or

  ```bash
  php artisan make:model Product -mc
  ```

- create model, migration, resource, and seeder

  ```bash
  php artisan make:model Product -m -r -s
  ```

  or

  ```bash
  php artisan make:model Product -mrs
  ```

### Migrate

```bash
- fresh = drop all tables and re-run all migrations
- refresh = rollback all migrations and re-run all migrations
- reset = rollback all migrations
- rollback = rollback the last migration
- status = show the status of each migration
```

Example:

- fresh migrate

  ```bash
  php artisan migrate:fresh
  ```

- reset migrate

  ```bash
  php artisan migrate:reset
  ```

### Seeder

```bash
- --seed = run all seeders
- --class = class (specific seeder)
```

Example:

- run all seeders

  ```bash
  php artisan db:seed

  ```

- run specific seeder

  ```bash
  php artisan db:seed --class=ProductSeeder
  ```

### Route

```bash
-l = list all routes
-c = clear route cache
-r = route cache
```

Example:

- list all routes

  ```bash
  php artisan route:list
  ```

- clear route cache

  ```bash
    php artisan route:clear
  ```

- route cache

  ```bash
  php artisan route:cache
  ```

### Note:

For more shortcuts, will be updated soon.
