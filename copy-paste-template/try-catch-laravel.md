# TRY CATCH BLOCK IN LARAVEL

### Description

This template is used to implement the try-catch block in Laravel. The try-catch block is used to handle exceptions that may occur during the execution of your code. It allows you to catch and handle exceptions gracefully.

### Template

- Controller

  ```php
  use Exception;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\DB;
  use App\Services\ServiceName;


  public function functionName(Request $request)
  {
    $validatedData = $request->validate([
        'field_name' => 'required'
    ]);

    DB::beginTransaction();
    try {
        ServiceName::functionName($validatedData);
        DB::commit();
        return response()->json(['message' => 'Success message']);
    } catch (Exception $e) {
        DB::rollBack();
        return response()->json(['message' => $e->getMessage()], 500);
    }

  }
  ```

### Explanation

1. `$validatedData = $request->validate([ 'field_name' => 'required' ]);` is used to validate the request data.
2. `DB::beginTransaction();` is used to start a database transaction.
3. `try` block is used to execute the code that may throw an exception.
4. `ServiceName::functionName($validatedData);` is the code that may throw an exception.
5. `DB::commit();` is used to commit the database transaction if no exception is thrown.
6. `catch (Exception $e)` block is used to catch the exception and rollback the database transaction using `DB::rollBack();`.
7. `return response()->json(['message' => $e->getMessage()], 500);` is used to return the error message in the response.

### Additional Information

1. Why use try-catch block in Laravel?

   The try-catch block is used to handle exceptions in Laravel. It allows you to catch and handle exceptions that may occur during the execution of your code.

2. Why use database transactions in Laravel?

   Database transactions are used to ensure data integrity and consistency in the database. They allow you to group multiple database operations into a single unit of work that either succeeds or fails as a whole.

3. Why validation outside the try block?

   It is a good practice to validate the request data before executing the code that may throw an exception. This helps to ensure that the data is valid and prevent unnecessary exceptions.
