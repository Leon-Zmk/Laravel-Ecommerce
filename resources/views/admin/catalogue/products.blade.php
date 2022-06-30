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
               

               
                
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <a href="{{route("addproducts")}}" class="btn btn-primary">Add Products</a>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Section</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Color</th>
                            <th>Add By</th>
                            <th>Control</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                       @foreach ($products as $product)
                          <tr>
                              <td>{{$product->id}}</td>
                              <td>{{$product->name}}</td>
                              <td>{{$product->code}}</td>
                              <td>{{$product->section->name}}</td>
                              <td>{{$product->category->name}}</td>
                              <td>
                                
                                <img src="{{asset("storage/frontend/products/small/$product->image")}}" style="width:150px;height:150px" class="rounded rounded-circle" alt="">
                              </td>
                              <td>
                                @if($product->color)
                                   {{$product->color}}
                               @endif
                              </td>
                              <td>
                                @if ($product->admin_type=="vendor")
                                      <a href="{{route("managementDetail",$product->vendor_id)}}">Vendor</a>
                                   @else
                                     {{$product->admin_type}}
                                @endif
                              </td>
                              <td>
                                @if ($product->status==0)
                                <a  class="prodtoggleStatus" id="product-id-{{$product->id}}" href="javascript:void(0)" product_id="{{$product->id}}" >
                                  <i class="fas fa-toggle-off text-black" status="inactive"></i>
                                </a>
                              @else 
                              <a  class="prodtoggleStatus" id="product-id-{{$product->id}}" href="javascript:void(0)" product_id="{{$product->id}}">
                                  <i class="fas fa-toggle-on text-success" status="active"></i>
                                </a>
                                @endif
                                <a href="{{route("productUpdate",$product->id)}}"><i class="text-primary fas fa-user-edit"></i></a>
                                <a href="{{route("attributes",$product->id)}}" title="Add Attributes"><i class="text-primary fas fa-plus-square"></i></a>
                                <a href="{{route("images",$product->id)}}" title="Add Images"><i class="text-primary fas fa-plus-circle"></i></a>

                                <form action="{{route("productDelete",$product->id)}}" class="d-inline" method="POST">

                                  @csrf

                                  <button class=" border-0">
                                    <i class=" text-danger fas fa-trash-alt"></i>
                                  </button>

                                </form>

                              </td>
                              <td>{{$product->created_at}}</td>
                          </tr>
                       @endforeach
                     
                   
                    </tbody>
                  
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

    <!-- DataTables  & Plugins -->
``<script src={{asset("plugins/datatables/jquery.dataTables.min.js")}}></script>
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





<!-- Page specific script -->
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