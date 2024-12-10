# Optimizing OOP Usage with Traits in Laravel Models | Relationship Example

## Case Study

Imagine you've got a bunch of models like `Post`, `Comment`, and `Like`, and each of them needs to relate to a `User`. Writing the same relationship code again and again can be pretty annoying, right? 😩

#### Example Without Traits

```php
// Post.php
public function user()
{
    return $this->belongsTo(User::class);
}

// Comment.php
public function user()
{
    return $this->belongsTo(User::class);
}

// Like.php
public function user()
{
    return $this->belongsTo(User::class);
}
```

This repetition can become cumbersome, especially if you need to maintain consistency across many models. 😩

#### Example With Traits

Wouldn’t it be better if you could refactor this into a trait and reuse the relationship logic? 😍

```php
// Post.php
use HasUser;

// Comment.php
use HasUser;

// Like.php
use HasUser;
```

Cleaner, right? Now, let’s break down how to implement this for better maintainability and readability.

## Step-by-Step Guide

1. <b>Create a Custom Command to Generate Traits (For Laravel Versions Below 11)</b>s

   If you’re using Laravel under version 11, you can create a command to generate the trait. Run this command:

   ```bash
   php artisan make:command CreateTraitCommand
   ```

   Then, open the generated file in `app/Console/Commands/CreateTraitCommand.php` and add edit the code like this:

   ```php
   <?php

   namespace App\Console\Commands;

   use Illuminate\Console\Command;
   use Illuminate\Support\Facades\File;

   class CreateTrait extends Command
   {
       /**
        * The name and signature of the console command.
        *
        * @var string
        */
       protected $signature = 'make:trait {name}';

       /**
        * The console command description.
        *
        * @var string
        */
       protected $description = 'Create a new trait';

       /**
        * Execute the console command.
        */
       public function handle()
       {
           $name = $this->argument('name');

           $traitPath = app_path("Traits/{$name}.php");

           // Cek apakah trait sudah ada
           if (File::exists($traitPath)) {
               $this->error("Trait {$name} already exists!");
               return;
           }

           // Membuat direktori jika belum ada
           if (!File::exists(app_path('Traits'))) {
               File::makeDirectory(app_path('Traits'));
           }

           // Template isi trait
           $traitTemplate = "<?php

   namespace App\Traits;

   trait $name
   {
       // Add your methods here
   }
   ";

           // Menulis file trait baru
           File::put($traitPath, $traitTemplate);

           $this->info("Trait {$name} created successfully.");
       }
   }
   ```

2. <b>Create Trait</b>

   Run this command to create a trait:

   ```bash
   php artisan make:trait HasUser
   ```

   Then, open the generated file in `app/Traits/HasUser.php` and add the relationship code like this:

   ```php
   <?php

   namespace App\Traits;

   trait HasUser
   {
       public function user()
       {
           return $this->belongsTo(User::class);
       }
   }
   ```

3. <b>Use Trait in Model</b>

   Use the trait in your model like this:

   ```php
   // Post.php
   <?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;

   class Post extends Model
   {
       use HasUser;
   }
   ```

   and so on for other models like `Comment` and `Like`, and you’re good to go! 😎
