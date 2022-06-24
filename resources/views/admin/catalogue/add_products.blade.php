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
              <h1>Products Management</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Catalogue Management</li>
                <li class="breadcrumb-item active">Add Products</li>

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
                            Add Products
                        </div>
                        <div class=" d-flex justify-content-end" style="width:250px">
                            <a href="{{route("productsManagement")}}" class="btn btn-primary">Products List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route("addproducts")}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="  form-control">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select name="category_id" id="category_id" class=" custom-select">
                                  <option selected disabled >Select Category</option>
                                    @foreach ($categories as $section)
                                        <optgroup label="{{$section->name}}"></optgroup>

                                        @foreach ($section->categories as $category)
                                            <option value="{{$category->id}}">&nbsp;&nbsp;&raquo;{{$category->name}}</option>

                                            @foreach ($category->subcategories as $scategory)
                                            <option value="{{$scategory->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;{{$scategory->name}}</option>
                                            @endforeach

                                        @endforeach
                                       
                                        
                                    @endforeach
                                </select>
                                @error('category_id')
                                   <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Select Brand</label>
                                <select name="brand_id" id="brand_id" class=" custom-select">
                                  <option selected disabled >Select Brand</option>
                                    @foreach ($brands as $brand)
                                      
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                       
                                    @endforeach
                                </select>
                                @error('brand_id')
                                   <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" name="color" id="color" class="  form-control">
                                @error('color')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="  form-control">
                                @error('code')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="  form-control">
                                @error('price')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="text" name="discount" id="discount" class="  form-control">
                                @error('discount')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="  form-control">
                                @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
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