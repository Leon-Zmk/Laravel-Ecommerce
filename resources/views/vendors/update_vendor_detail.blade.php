@extends("layouts.admin.admin_layout")

@section("content")

<?php


?>

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

            @if($detail_type=="password")

            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Password Info</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

               
               
                <form method="POST" action="{{route("vupdate","password")}}">
                  @csrf
                  <div class="card-body">

                    <div class="card-body">

                      
                  
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
                      <label for="current_password">Current Password</label>
                      <input type="password" name="current_password"  class="form-control" id="current_password" placeholder="Password">

                      <span id="current_password_span">

                      </span>

                    </div>
                    <div class="form-group">
                      <label for="new_password">New Password</label>
                      <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password">

                      @error("new_password")
                        <span class="text-danger">
                          {{$message}} 
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Password">

                      @error("confirm_password")
                        <span class="text-danger">
                          {{$message}} 
                        </span>
                      @enderror
                    </div>
        
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
            </div>

              @elseif($detail_type=="personal")

              <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Update Personal Info</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <br>
                  <br>
                  
                  @if(session("success_message"))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>  {{session("success_message")}} </strong>
                  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                 @endif
                  
                 
                  <form method="POST" action="{{route("vupdate","personal")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    
                      <div class="text-center">
                        
                        <img src="{{asset("storage/user_profile/".auth()->guard('admin')->user()->image)}}" class="rounded rounded-circle" id="user_img" style="width:150px;height:150px" alt="">
                        
                        <div class="form-group">
                            <input type="file" hidden id="image" name="image">
                        </div>
                      </div>
      
                    
                    
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" name="name" value="{{Auth::guard("admin")->user()->personal->name}}"   class="form-control" id="name" >

                        @error("name")

                          <span class="text-danger">
                              {{$message}}
                          </span>

                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="city">City</label>
                        <select name="city" id="city" class=" custom-select">
                          <option value="">Select Your City</option>
                          @foreach (App\Models\Statordivision::all() as $stsord)
                              <option value="{{$stsord->stat_or_division}}" @if ($stsord->stat_or_division == Auth::guard("admin")->user()->personal->city) selected  @endif>{{$stsord->stat_or_division}}</option>
                          @endforeach
                        </select>
                        @error("city")

                        <span class="text-danger">
                            {{$message}}
                        </span>

                      @enderror
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{Auth::guard("admin")->user()->personal->phone}}" class="form-control" id="phone" placeholder="{{App\Models\Vendor::find(auth()->guard('admin')->user()->vendor_id)->phone}}" >
                        @error("phone")

                        <span class="text-danger">
                            {{$message}}
                        </span>

                      @enderror
                      </div>

                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="address" name="address" value="{{Auth::guard("admin")->user()->personal->address}}" class="form-control" id="address" placeholder="{{App\Models\Vendor::find(auth()->guard('admin')->user()->vendor_id)->address}}" >
                        @error("address")

                        <span class="text-danger">
                            {{$message}}
                        </span>

                      @enderror
                      </div>
          
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>

             @else

             <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Business Info</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

               
               
                <form method="POST" action="{{route("vupdate","business")}}" enctype="multipart/form-data">
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
                      <input type="shop_name" name="shop_name" value='{{$vshop->shop_name }}'  class="form-control" id="shop_name"  placeholder="shop_name">
                      @error('shop_name')
                          {{$message}}
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="shop_address">Address</label>
                      <input type="shop_address" name="shop_address"  value='{{ $vshop->shop_address }}'   class="form-control" id="shop_address"  placeholder="shop_address">
                      @error('shop_address')
                      {{$message}}
                  @enderror
                    </div>
                    <div class="form-group">
                      <label for="shop_webiste">Website</label>
                      <input type="shop_webiste" name="shop_webiste" value='{{ $vshop->shop_website }}'  class="form-control" id="shop_webiste"  placeholder="shop_website">
                      @error('shop_website')
                      {{$message}}
                  @enderror
                    </div>
                    <div class="form-group">
                      <label for="shop_mobile">Mobile</label>
                      <input type="shop_mobile" name="shop_mobile" value='{{ $vshop->shop_mobile }}'  class="form-control" id="shop_mobile"  placeholder="shop_mobile">
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
                    <button type="submit" class="btn btn-primary">Update</button>
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

            @endif

            

           
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