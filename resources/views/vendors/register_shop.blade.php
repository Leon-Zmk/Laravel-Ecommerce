@extends("layouts.admin.admin_layout")

@section("content")



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Setting</li>
              <li class="breadcrumb-item active">Update admin Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div> 

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->

           @if(auth()->guard("admin")->user()->business == [])

          
           <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Register Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

             
             
              <form method="POST" action="{{route("registershop")}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                
  
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

                    @error('email')
                        
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="shop_name">Shop Name</label>
                    <input type="shop_name" name="shop_name"   class="form-control" id="shop_name"  placeholder="shop_name">
                    @error('shop_name')
                        {{$message}}
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="shop_address">Address</label>
                    <input type="shop_address" name="shop_address"    class="form-control" id="shop_address"  placeholder="shop_address">
                    @error('shop_address')
                    {{$message}}
                @enderror
                  </div>
                  <div class="form-group">
                    <label for="shop_webiste">Website</label>
                    <input type="shop_webiste" name="shop_webiste"  class="form-control" id="shop_webiste"  placeholder="shop_website">
                    @error('shop_website')
                    {{$message}}
                @enderror
                  </div>
                  <div class="form-group">
                    <label for="shop_mobile">Mobile</label>
                    <input type="shop_mobile" name="shop_mobile"  class="form-control" id="shop_mobile"  placeholder="shop_mobile">
                    @error('shop_mobile')
                    {{$message}}
                @enderror
                  </div>
                  <div class="form-group">
                    <label for="shop_profile">Shop Profile</label>
                    <input type="file" name="shop_profile" class="form-control">
                    @error('shop_profile')
                    {{$message}}
                @enderror
                  </div>
                  <div class="form-group">
                    <label for="shop_background_profile">Shop Background Profile</label>
                    <input type="file" name="shop_background_profile" class="form-control">
                    @error('shop_background_profile')
                    {{$message}}
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="shop_image_verification">Shop_Image_Verification</label>
                    <input type="file" name="shop_image_verification" class="form-control">
                    @error('shop_image_verification')
                    {{$message}}
                   @enderror
                  </div>
                  
      
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-6">
              <div class="">
                <div class="background">
                  <img src="" alt="">
                </div>
                <div class="profile">
                  <img src="" alt="">
                </div>
              </div>
          </div>

        

       
      </div>  

           @else 

            Have

            @endif
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