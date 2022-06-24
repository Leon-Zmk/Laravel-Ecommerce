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
                            Add Attributes
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

                            <form action="{{route("addattributes")}}" method="POST" class="mt-4">
                                @csrf
                                <div class="form-group">
                                  @error('sizes')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  @error('sizes.*')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  @error('skus')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  @error('skus.*')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  @error('prices')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  @error('prices.*')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  @error('stocks')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  @error('stocks.*')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                    <div class="field_wrapper">
                                        <div class="mb-4">
                                            <input type="text" name="product_id" hidden value="{{$product->id}}">
                                            <input style="width: 120px" type="text" name="sizes[]" placeholder="Size" value=""/>
                                            <input style="width: 120px" type="text" name="skus[]" placeholder="Code" value=""/>
                                            <input style="width: 120px" type="number" name="prices[]" placeholder="Price" value=""/>
                                            <input style="width: 120px" type="number" name="stocks[]" placeholder="Stock" value=""/>
                                             <a href="javascript:void(0);" class="add_button btn btn-sm mb-1 btn-primary" title="Add field">Add</a>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary">Add Attributes</button>
                            </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                      @error('uprices.*')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                      @error('ustock.*')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Size</th>
                                        <th>Sku</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                  @if (!empty($product->attributes))
                                        
                                    @foreach ($product->attributes as $attribute)
                                    <tr>
                                        <th>{{$attribute->id}}</th>
                                        <th>{{$attribute->size}}</th>
                                        <th>{{$attribute->sku}}</th>
                                        <th>
                                          <input type="text" hidden form="attributeUpdate"  name="attributesid[]" style="width: 150px;" value="{{$attribute->id}}">
                                          <input type="number" form="attributeUpdate" name="uprices[]" style="width: 150px" value="{{$attribute->price}}">
                                        </th>
                                        <th>
                                          <input type="number" form="attributeUpdate"  name="ustocks[]" style="width: 150px" value="{{$attribute->stock}}">

                                        </th>
                                        <th>
                                            @if ($attribute->status==0)
                                            <a  class="attrtoggleStatus" id="attribute-id-{{$attribute->id}}" href="javascript:void(0)" attribute_id="{{$attribute->id}}" >
                                              <i class="fas fa-toggle-off text-black" status="inactive"></i>
                                            </a>
                                          @else 
                                          <a  class="attrtoggleStatus" id="attribute-id-{{$attribute->id}}" href="javascript:void(0)" attribute_id="{{$attribute->id}}">
                                              <i class="fas fa-toggle-on text-success" status="active"></i>
                                            </a>
                                        @endif
                                        <form action="{{route("attributeDelete")}}" class="d-inline ml-4" method="POST">
                                            @csrf
                                            <input type="text" hidden name="attributeid" value="{{$attribute->id}}">

                                            <button class="border-0 "><i class="text-danger fas fa-trash-alt"></i></button>
                                        </form>
                                        </th>
                                    </tr>
                                    @endforeach

                                  @endif
                                
                            
                                </tbody>
                            
                            </table>
                            <form action="{{route("attributeUpdate")}}" id="attributeUpdate" method="POST">
                              @csrf
                              <button class="btn btn-primary">Update</button>
                            </form>
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