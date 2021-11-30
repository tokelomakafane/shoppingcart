@extends('admin_layout.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sliders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
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
                <h3 class="card-title">All Sliders</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach( $allData as $key => $slider)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <img src="{{ (!empty($slider->image))? url('upload/'.$slider->image):url('upload/no_image.jpg') }}" style="width: 60px; width: 60px;">
                                       </td>
                        <td>{{$slider->description1}}</td>
                         <td>{{$slider->description2}}</td>


                        <td>
                            @if ($slider->status==0)
                            <a href="{{route('activate.slider',$slider->id)}}" class="btn btn-warning md-5">inactive</a>
                            @else
                            <a href="{{route('activate.slider',$slider->id)}}" class="btn btn-success md-5">active</a>

                            @endif
                            <a href="{{route('edit.slider',$slider->id)}}" class="btn btn-info md-5">Edit</a>
                            <a href="{{route('delete.slider',$slider->id)}}" class="btn btn-danger md-5">delete</a>


                        </td>

                    </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
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
