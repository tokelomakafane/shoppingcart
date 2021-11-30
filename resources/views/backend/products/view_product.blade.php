@extends('admin_layout.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title">All Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach( $allData as $key => $product)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <img src="{{ (!empty($product->image))? url('upload/'.$product->image):url('upload/no_image.jpg') }}" style="width: 60px; width: 60px;">
                                       </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product['Category']['name']}}</td>
                        <td>{{$product->price}}</td>


                        <td>
                            @if ($product->status==0)
                            <a href="{{route('activate.product',$product->id)}}" class="btn btn-warning md-5">inactive</a>
                            @else
                            <a href="{{route('activate.product',$product->id)}}" class="btn btn-success md-5">active</a>

                            @endif
                            <a href="{{route('edit.product',$product->id)}}" class="btn btn-info md-5">Edit</a>
                            <a href="{{route('delete.product',$product->id)}}" class="btn btn-danger md-5">delete</a>


                        </td>

                    </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
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
