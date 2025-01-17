# BLADE TEMPLATING IN LARAVEL

### Description

This template is based on personal experience.

### Overview

- Tree structure of views folder

  ```bash
  resources
  │  └── views
  │      └── layouts
  │          └── app.blade.php
  |          └── navbar.blade.php
  │          └── footer.blade.php
  │      └── pages
  │          └── home.blade.php
  ```

- app.blade.php: Main layout file
- navbar.blade.php: Navbar partial view
- footer.blade.php: Footer partial view
- home.blade.php: Home page view

### Template

- app.blade.php

  ```php
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>@yield('title')</title>
      @stack('styles') <!-- for additional styles for specific page -->
    </head>
  </html>
  <body>
    @include('layouts.navbar')
    <div class="container">@yield('content')</div>
    @stack('scripts') <!-- for additional scripts for specific page -->
    @include('layouts.footer')
  </body>
  ```

- navbar.blade.php

  ```html
  <nav>
    <ul>
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('about') }}">About</a></li>
      <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
  </nav>
  ```

- footer.blade.php

  ```html
  <footer>
    <p>&copy; 2021 All rights reserved</p>
  </footer>
  ```

- home.blade.php

  ```php
    @extends('layouts.app')
    @section('title', 'Home')
    @section('content')

    @push('styles')
    <link rel="stylesheet" href="path/to/css">
    @endpush

    <h1>Welcome to Home Page</h1>

    @push('scripts')
    <script src="path/to/js"></script>
    @endpush
    @endsection
  ```

### Additional Information

1. @extends: Specifies the parent layout file.
2. @section: Defines a section of content to inject into the parent layout.
3. @yield: Acts as a placeholder in the parent layout for content sections.
4. @include: Embeds a partial view (e.g., navbar or footer).
5. @stack and @push: Used to dynamically include scripts or styles in a specific section.
