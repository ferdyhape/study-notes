# UPLOAD FILE LARAVEL SERVICE

### Description

This template is used to upload files in Laravel using a service class. The service class contains two methods: `handleUploadFile` and `deleteFile`. The `handleUploadFile` method is used to upload a file to a specified folder and the `deleteFile` method is used to delete a file from the specified folder.

### Template

- Service Class

  ```php
  // Service class
  class ServiceName
  {
  public static function handleUploadFile($file, $folderName, $oldFile = null)
      {
          if ($file) {
              if ($oldFile) {
                  self::deleteFile($oldFile);
              }
              return $file->store($folderName, 'public');
          }
          return $oldFile;
      }

      public static function deleteFile($filePath)
      {
          if ($filePath) {
              Storage::disk('public')->delete($filePath);
          }
      }
  }
  ```

- Controller

  ```php
  use App\Services\ServiceName;

  class ControllerName extends Controller
  {
      public function store(PostRequest $request)
      {
          $data = $request->validated();
          $data['thumbnail'] = ServiceName::handleUploadFile($request->file('thumbnail'), 'post_thumbnails');
          $post = Post::create($data);
          return response()->json(['message' => 'Post created successfully', 'data' => $post]);
      }

      public function update(PostRequest $request, Post $post)
      {
          $data = $request->validated();
          $data['thumbnail'] = ServiceName::handleUploadFile($request->file('thumbnail'), 'post_thumbnails', $post->thumbnail);
          $post->update($data);
          return response()->json(['message' => 'Post updated successfully', 'data' => $post]);
      }

  }
  ```
