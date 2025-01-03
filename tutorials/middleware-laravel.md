# LARAVEL MIDDLEWARE

### Overview

- Laravel Default Middleware

  Actually, Laravel has some default middleware that can be used to protect your routes. Like `auth`, `verified`, `guest`, `throttle`, etc.
  But, how if you have case that need custom middleware? You must create your own middleware right?

- Case Study

  For example, you have a case that need to check if the user is admin or not. You can create a middleware to check if the user is admin or not.

- Users Table

  For this case, in users table, you have a column `role` that contains the user role. If the user role is `admin`, then the user is authorized to access the resource.

  | id  | name | email              | role  |
  | --- | ---- | ------------------ | ----- |
  | 1   | John | johndoe@gmail.com  | admin |
  | 2   | Jane | janefika@gmail.com | user  |

### Create Middleware

1. Create Middleware

   ```bash
   php artisan make:middleware CheckAdmin
   ```

2. Edit Middleware

   ```php
    // app/Http/Middleware/CheckAdmin.php
   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;

   class CheckAdmin
   {
       public function handle(Request $request, Closure $next)
       {
           if (auth()->user()->role !== 'admin') {
               return response()->json(['message' => 'You are not authorized to access this resource'], 403);
           }
           return $next($request);
       }
   }
   ```

3. Register Middleware

   Add the middleware to the `$routeMiddleware` property of your `app/Http/Kernel.php` file.

   ```php
   // app/Http/Kernel.php
   protected $routeMiddleware = [
      'isAdmin' => \App\Http\Middleware\CheckAdmin::class,
   ];
   ```

4. Use Middleware

   You can use the middleware in your routes

   ```php
   Route::get('/admin/user-management', UserManagementController::class)->middleware('isAdmin');
   ```

   Or you can use it in your controller constructor

   ```php
   // Controller
   public function __construct()
   {
       $this->middleware('isAdmin');
   }

   // Route
   Route::get('/admin/user-management', UserManagementController::class);
   ```

### Explanation

1. `php artisan make:middleware CheckAdmin` is used to create a new middleware named `CheckAdmin`.
2. In the `handle` method of the middleware, we check if the authenticated user's role is not equal to `admin`. If it is not, we return a JSON response with a `403` status code.
3. The `$next($request)` method is used to pass the request
4. The middleware is registered in the `$routeMiddleware` property of the `app/Http/Kernel.php` file.
5. The middleware can be applied to routes using the `middleware` method or in the controller constructor.
