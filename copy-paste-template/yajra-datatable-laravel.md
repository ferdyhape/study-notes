# YAJRA DATATABLE LARAVEL

### Description

This template is based on personal experience. Of course, there are still many ways to use yajra datatable in laravel.

### Template

- Controller

  ```php
  use App\Models\ModelName;
  use Yajra\DataTables\Facades\DataTables;

  // i assume request using ajax to index method
  public function index()
  {
      if (request()->ajax()) {
          $data = ModelName::all();
          return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                  $btn = $btn.' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                  return $btn;
              })
              ->make(true);
      }

      return view('view_name');
  }


  // other way to use action column with view
  public function index()
  {
      if (request()->ajax()) {
          $data = ModelName::all();
          return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('action', 'view_name') // make sure view_name is in resources/views folder and $row variable will parsed to view, so you can use $row->id, $row->name, etc
              ->toJson();
      }

      return view('view_name');
  }

  ```

- View

  ```html
  <table class="table table-bordered" id="table-example">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    $(function () {
      $("#table-example").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('route_name') }}", // make sure route_name is defined in routes/web.php and connected to index method in controller
        columns: [
          { data: "DT_RowIndex", name: "DT_RowIndex" },
          { data: "name", name: "name" }, // replace name with your column name
          {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false,
          },
        ],
      });
    });
  </script>
  ```
