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
              <h1>Buyer Management</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Buyer Management</li>
                <li class="breadcrumb-item active">Buyers</li>

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
                            <th> Name</th>
                            <th> Phone </th>
                            <th>Email</th>
                            <th>Shipping</th>
                            <th>Sub Total</th>
                            <th>Total Price</th>
                            <th>is_delivered : &nbsp;</th>
                            <th>Region</th>
                            <th>City</th>
                            <th>Township</th>
                            <th>Address : &nbsp;</th>
                            <th>Control : &nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                      

                        @foreach($buyers as $buyer)

                        <tr>
                            <th>{{$buyer->id}}</th>
                            <th>{{$buyer->name}}</th>
                            <th>{{$buyer->phone}}</th>
                            <th>{{$buyer->email}}</th>
                            <th>{{$buyer->shipping_fee}}</th>
                            <th>{{$buyer->sub_total}}</th>
                            <th>{{$buyer->all_total}}</th>
                            <td>

                              {{-- @if($buyer->is_delivered == 0) <span class=" text-danger text-bold">No</span> @else <span class="text-success text-bold">Yes</span>  @endif  --}}

                              @if ($buyer->is_delivered==0)
                              <a  class="buyertoggleStatus" id="buyer-id-{{$buyer->id}}" href="javascript:void(0)" buyer_id="{{$buyer->id}}" >
                                <i class="fas fa-toggle-off text-black" status="inactive"></i>
                                <p id="status-text-{{$buyer->id}} " class="text-danger text-bold">Not Deliver</p>
                              </a>
                            @else 
                            <a  class="buyertoggleStatus" id="buyer-id-{{$buyer->id}}" href="javascript:void(0)" buyer_id="{{$buyer->id}}">
                                <i class="fas fa-toggle-on text-success" status="active"></i>
                                <p id="status-text-{{$buyer->id}} " class="text-success text-bold">Delivered</p>
                              </a>
                              @endif



                          </td>
                            <th>{{$buyer->Region}}</th>
                            <th>{{$buyer->City}}</th>
                            <th>{{$buyer->Township}}</th>
                            <th>{{$buyer->address}}</th>
                           
                            <th>
                              <form action="{{route("buyerdelete")}}" method="POST">
                                @csrf 

                                <input type="text" hidden name="buyer_id" value="{{$buyer->id}}">

                                <button onclick="return confirm('Are you sure to Delete')" class="btn btn-outline-danger">Delete Buyer</button>

                              </form>
                            </th>
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