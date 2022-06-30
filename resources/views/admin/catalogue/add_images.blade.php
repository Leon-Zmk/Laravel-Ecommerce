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
                <li class="breadcrumb-item active">Add Images</li>

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

               @if(session("delete_message"))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>  {{session("delete_message")}} </strong>
               
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
              @endif
               
             
               

                <div class="card col-12 col-md-7">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="">
                            Add Images
                        </div>
                        <div class=" d-flex justify-content-end" style="width:250px">
                            <a href="{{route("productsManagement")}}" class="btn btn-primary">Products List</a>
                        </div>
                    </div>
                    <div class="card-body">
                           <div>
                               <label for="">Name</label>
                               {{$product->name}}
                           </div>
                           <div>
                            <label for="">Code</label>
                            {{$product->code}}
                          </div>
                            <div>
                                <label for="">Price</label>
                                {{$product->price}}
                            </div>
                            <div>
                                <label for="">Color</label>
                                {{$product->color}}
                            </div>
                            <div>
                                
                                <img src="{{asset("storage/frontend/products/small/$product->image")}}" alt="">
                            </div>

                            <form action="{{route("addimages")}}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <input type="text" hidden name="product_id" value="{{$product->id}}">
                                <div class="form-inline  border  p-4">
                                    <input type="file" multiple name="images[]"  class="form-control p-1">

                                    @error('images')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @error('images.*')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-center align-items-center mt-4">
                                    <button class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Control</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                  @if (!is_null($product->images))
                                        
                                    @foreach ($product->images as $image)
                                    <tr class="text-center align-middle">
                                        <th class="align-middle">{{$image->id}}</th>
                                        <th>
                                            <img src="{{asset("storage/frontend/products/small/$image->name")}}" style="width:100px;heigh;100px" class="rounded-circle" alt="">
                                        </th>
                                        <th class="align-middle">
                                            @if ($image->status==0)
                                            <a  class="imagetoggleStatus" id="image-id-{{$image->id}}" href="javascript:void(0)" image_id="{{$image->id}}" >
                                              <i class="fas fa-toggle-off text-black" status="inactive"></i>
                                            </a>
                                          @else 
                                          <a  class="imagetoggleStatus" id="image-id-{{$image->id}}" href="javascript:void(0)" image_id="{{$image->id}}">
                                              <i class="fas fa-toggle-on text-success" status="active"></i>
                                            </a>
                                        @endif
                                        <form action="{{route("imagedelete")}}" class="d-inline ml-4" method="POST">
                                            @csrf
                                            <input type="text" hidden  name="imageid" value="{{$image->id}}">

                                            <button class="border-0 "><i class="text-danger fas fa-trash-alt"></i></button>
                                        </form>
                                        </th>
                                        <th class="align-middle">
                                            {{$image->created_at->diffforhumans()}}
                                        </th>
                                    </tr>
                                    @endforeach

                                  @endif
                                
                            
                                </tbody>
                            
                            </table>

                        </div>
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

    <script src={{asset("plugins/datatables/jquery.dataTables.min.js")}}></script>
<script src={{asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}></script>
<script src={{asset("plugins/datatables-responsive/js/dataTables.responsive.min.js")}}></script>
<script src={{asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/dataTables.buttons.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}></script>
<script src={{asset("plugins/jszip/jszip.min.js")}}></script>
<script src={{asset("plugins/pdfmake/pdfmake.min.js")}}></script>
<script src={{asset("plugins/pdfmake/vfs_fonts.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.html5.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.print.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.colVis.min.js")}}></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endpush