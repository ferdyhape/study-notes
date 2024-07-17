# UUID LARAVEL

## WHY USE UUID?

UUID (Universally Unique Identifier) is a 128-bit number used to uniquely identify information in computer systems. It is a 36-character string that is unique across all space and time. UUID is a better alternative to auto-incrementing integers because it is more secure and less predictable.

## Steps:

1. create migration and model, for example using table name 'Products'
   ```bash
   php artisan make:model Product -m
   ```
2. open the migration file and change the data type of the id field to uuid

   ```php
   <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up()
        {
            Schema::create('products', function (Blueprint $table) {
                $table->uuid('id')->primary(); // change the data type to uuid
                $table->string('name');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('products');
        }
    };

   ```

3. run the migration
   ```bash
   php artisan migrate
   ```
4. open the model file and add the following code

   ```php
   namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Concerns\HasUuids;

    class Product extends Model
    {
        use HasFactory, HasUuids;

        protected $guarded = ['id']; // optional, if using fillable, remove this line and change fillable to protected $fillable = ['name'];
    }

   ```

5. testing using tinkers on terminal

   ```bash
   php artisan tinker
   ```

   ```php
   App\Models\Product::create(['name' => 'Product 1']);
   ```

6. check the data in the database, the id field should be filled with a UUID
