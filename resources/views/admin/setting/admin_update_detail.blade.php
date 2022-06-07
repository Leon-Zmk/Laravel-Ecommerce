@extends("layouts.admin.admin_layout")

@section("content")

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Setting</li>
              <li class="breadcrumb-item active">Update admin Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div> 

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Info</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

               
               
                <form method="POST" action="{{route("adupdate")}}" enctype="multipart/form-data">
                  @csrf

                 

                  <div class="card-body">

                    <div class="text-center">
                      
                        <img src="{{asset("storage/user_profile/".auth()->guard('admin')->user()->image)}}" class="rounded rounded-circle" id="user_img" style="width:150px;height:150px" alt="">
                        
                        <div class="form-group">
                            <input type="file" hidden id="image" name="image">
                        </div>
                      </div>
                  
                    @if(session("error_message"))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>  {{session("error_message")}} </strong>
                    
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                   @endif
    
                   @if(session("success_message"))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>  {{session("success_message")}} </strong>
                   
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                  @endif
                  
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" disabled readonly class="form-control" id="email" value="{{auth()->guard("admin")->user()->email}}" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="type">Admin Role</label>
                      <input type="text" name="type" readonly disabled class="form-control" id="type" value="{{auth()->guard("admin")->user()->type}}" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name"  class="form-control" placeholder="{{auth()->guard("admin")->user()->name}}" id="name" >
                      @error("name")
                      <span class="text-danger">
                        {{$message}} 
                      </span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" name="mobile" class="form-control" placeholder="{{auth()->guard("admin")->user()->mobile}}" id="mobile" >

                      @error("mobile")
                        <span class="text-danger">
                          {{$message}} 
                        </span>
                      @enderror
                    </div>
        
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>

              </div>
            </div>

          
          </div>
        </div>
              
    </section>

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