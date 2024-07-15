# IMPLEMENT SERVICE CLASS IN LARAVEL

## Why Implement Service Class In Laravel?

When you have a lot of business logic in your controller, it will be hard to maintain and test. By implementing a service class, you can separate the business logic from the controller and make it easier to maintain and test.

## STEPS:

1. Install the package `timwassenburg/laravel-service-generator` with the command `composer require timwassenburg/laravel-service-generator --dev`, this package will help to generate the service class
2. Create a service class with the command `php artisan make:service ServiceName`, replace `ServiceName` with the name of the service class
3. Implement the business logic in the service class
4. Call the service class from the controller

## Example Case

Suppose you have a controller that has a lot of business logic like this:

```php
// Controller before implementing service class

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // send email
        Mail::to($user->email)->send(new WelcomeMail($user));

        // send notification
        $user->notify(new WelcomeNotification($user));

        return response()->json(['message' => 'User created successfully']);
    }
}
```

You can see that the controller has a lot of business logic like creating a user, sending an email, and sending a notification. By implementing a service class, you can separate the business logic like this:

```php
// Service class

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class UserService
{
    public function createUser($name, $email, $password)
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        // send email
        Mail::to($user->email)->send(new WelcomeMail($user));

        return $user;
    }
}
```

And then you can call the service class from the controller like this:

```php

// Controller after implementing service class

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $this->userService->createUser($request->name, $request->email, $request->password);

        return response()->json(['message' => 'User created successfully']);
    }
}
```
