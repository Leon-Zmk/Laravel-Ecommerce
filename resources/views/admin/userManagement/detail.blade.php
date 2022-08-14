@extends("layouts.admin.admin_layout")

@section("content")

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show Admin Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Management</li>
              <li class="breadcrumb-item active">Admin Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div> 

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->

            <div class="col-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{$userdetail->name}}</h3>
                    <h5 class="widget-user-desc">{{$userdetail->type}}</h5>
                  </div>
                  <div class="text-center margin-minus">
                    <img class="custom-img-ratio" src="{{asset("storage/user_profile/".$userdetail->image)}}" alt="User Avatar">
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">Email</h5>
                          <span class="description-text">{{$userdetail->email}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">Phone</h5>
                          <span class="description-text">{{$userdetail->mobile}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Address</h5>
                          <span class="description-text">{{$userdetail->personal->address}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Shop Name</h5>
                          <span class="description-text">{{$userdetail->business->shop_name}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Shop Website</h5>
                          <span class="description-text">{{$userdetail->business->shop_website}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Shop Phone</h5>
                          <span class="description-text">{{$userdetail->business->shop_mobile}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Shop Email</h5>
                          <span class="description-text">{{$userdetail->business->shop_email}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Shop Image Verification</h5>
                          <a href="{{asset("storage/verification_images/".$userdetail->business->shop_image_verification)}}">View Image</a>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Stat Or Division</h5>
                          <span class="description-text">{{$userdetail->personal->city}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                </div>
                <!-- /.widget-user -->
              </div>

            

           
          </div>
        </div>
       </section>

</div>

@endsection\

@push('script')

    <script src={{asset("plugins/jquery/jquery.min.js")}}></script>
    <script src={{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
    <!-- overlayScrollbars -->
    <script src={{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
    <!-- AdminLTE App -->
    <script src={{asset("js/admin_js/adminlte.js")}}></script>
    <script src="{{asset("js/admin_js/custom.js")}}"></script>
@endpush