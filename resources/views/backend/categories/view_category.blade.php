@extends('admin_layout.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All categories</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <tbody>
                    @foreach($allData as $key => $category)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>{{$category->name}}</td>


                        <td>
                            <a href="{{route('edit.category',$category->id)}}" ><i class="nav-icon fas fa-edit"></i></a>
                            <a href="{{route('delete.category',$category->id)}}" id="delete" ><i class="nav-icon fas fa-trash"></i></a>

                        </td>

                    </tr>
                @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
