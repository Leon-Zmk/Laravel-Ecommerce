@extends('layouts.frontend.frontend_layout')


@section('content')

     <!-- Breadcrumb Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    
    <!-- Shop Start -->
    <div class="container-fluid ">

        <div class="row shop px-xl-5 ">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
              @if (!$brands->isEmpty())
              <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Brands</span></h5>
              <div class="bg-light p-4 mb-30">
                  <form>
                     @foreach($brands as $key=>$brand)
      
                 
                      <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                          <input type="checkbox"  class="custom-control-input brand" value="{{$brand->id}}" name="brandfilter[]"  id="{{"brand-all-".$key}}">
                          <label class="custom-control-label" for="{{"brand-all-".$key}}">{{$brand->name}}</label>
                      </div>
      
                     @endforeach
                    
                  </form>
              </div>
              @endif
                <!-- Price End -->
                
                <!-- Color Start -->
                @if (!$colors->isEmpty())
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                       
                            @foreach ($colors as $color)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input color " value="{{$color}}" name="colorfilter[]"  id="{{"price-all-".$color}}">
                                <label class="custom-control-label" for="{{"price-all-".$color}}">{{$color}}</label>
                            </div>
                          
                            @endforeach
                    </form>
                </div>
               
                @endif
                <!-- Color End -->
        
                <!-- Size Start -->
                @if (!$products->isEmpty())
                    
               
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                       
                            @foreach($productSizes as $size)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox"  class="custom-control-input form-control size " value="{{$size}}" name="sizefilter[]"  id="{{"size-all-".$size}}">
                                <label class="custom-control-label" for="{{"size-all-".$size}}">{{$size}}</label>
                            </div>
                            @endforeach
                      
                    </form>
                </div>
        
                @endif
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->
        
        
            <!-- Shop Product Start -->
               
            <!-- Shop Product End -->
            <input type="text" id="url" hidden value="{{$category}}">
            <input type="text" id="csrf" hidden value="{{csrf_token()}}">
           
               
            <div class="col-md-8 test">
                @include('frontend.specific_ajax_products')
            </div>
           
        </div>
        
        
       
    </div>
    <!-- Shop End -->




   <!-- Back to Top -->
   <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@endsection