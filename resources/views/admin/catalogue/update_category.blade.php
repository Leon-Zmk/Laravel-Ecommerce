@extends("layouts.admin.admin_layout")

@section("content")

<div class="wrapper">
    <!-- Navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Categories Management</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Catalogue Management</li>
                <li class="breadcrumb-item active">Update Category</li>

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

                @if(session("success_message"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>  {{session("success_message")}} </strong>
                
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               @endif
               
             
               

                <div class="card col-12 col-md-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="">
                            Update Categories
                        </div>
                        <div class=" d-flex justify-content-end" style="width:250px">
                            <a href="{{route("categoriesManagement")}}" class="btn btn-primary">Categories List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route("addCategories")}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="{{$category->name}}" class="  form-control">
                            </div>
                             <div class="form-group">
                                <label for="section_id">Section</label>
                                <select name="section_id" id="section_id" class=" custom-select">
                                  <option selected disabled >Select Section</option>
                                  @foreach ($sections as $section)
                                      <option value="{{$section->id}}" @if($category->section_id==$section->id) selected @endif>{{$section->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="append-category">
                              @include("admin.catalogue.append_category")
                            </div>
                             <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" value="{{$category->url}}" name="url" id="url" class="  form-control">
                            </div>
                             <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" value="{{$category->description}}" name="description" id="description" class="  form-control">
                            </div>
                             <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                             <button class="btn btn-primary">Add</button>
                        </form>
                    </div>
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
   
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>

@endsection

@push('script')

    <script src={{asset("plugins/jquery/jquery.min.js")}}></script>
    <script src={{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
    <!-- overlayScrollbars -->
    <script src={{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
    <!-- AdminLTE App -->
    <script src={{asset("js/admin_js/adminlte.js")}}></script>
    <script src="{{asset("js/admin_js/custom.js")}}"></script>

@endpush