# SELECT 2 LARAVEL

### Description

This template is used to implement select2 in Laravel. Select2 is a jQuery based replacement for select boxes. It supports searching, remote data sets, and infinite scrolling of results.

### Template

- Controller

  ```php
  use App\Models\ModelName;

  public function getSelect2Data(Request $request)
  {
      $search = $request->search;
      $data = ModelName::where('name', 'like', "%$search%")->get();
      return response()->json($data);
  }
  ```

- Blade for input

  ```html
  <select class="form-control" name="name" id="select-name">
    <option value="">Select Name</option>
  </select>

  <script>
    $('#select-name').select2({
        placeholder: 'Select Name',
        ajax: {
            url: '{{ route('route_name') }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
  </script>
  ```

- Blade for filter <b>(with all option)</b>

  ```html
  <select class="form-control" name="name" id="filter-name">
    <option value="">Select Name</option>
  </select>

  <script>
    $('#filter-name').select2({
        placeholder: 'Select Name',
        allowClear: true,
        ajax: {
            url: '{{ route('route_name') }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                data.unshift({id: '', name: 'All'});
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
  </script>
  ```
