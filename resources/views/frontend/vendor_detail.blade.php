@extends('layouts.frontend.frontend_layout')


@section('content')

    <div class="container-fluid">
       <div class="row p-2">

         <div class="col-12 mb-4">
            <div class="card">
               <div class="card-img">
                  <img src="{{asset("storage/shop_backgrounds/$vendor->shop_background_profile")}}" height="450px" class="w-100" alt="">
               </div>
            </div>

            <div class="card rounded border-right-0 border-left-0 border-bottom-0" style="background-color: #f5f5f5">
               <div class="card-img text-center">
                  <img src="{{asset("storage/shop_profiles/$vendor->shop_profile")}}" style="margin-top: -80px" height="150px" width="150px" class="rounded-circle" alt="">
                  <span>{{$vendor->shop_name}}</span>
               </div>
               
            </div>

         </div>

         <div class="col-12 col-md-8 mt-4">
            <div class="row">
               @foreach ($products as $product)
               <div class="col-12 col-md-3">
                  <div class="product-item bg-light mb-4">
                     <div class="product-img position-relative overflow-hidden">
                         <img class="img-fluid w-100" src="{{asset('storage/frontend/products/small/'.$product->image)}}" alt="">
                         <div class="product-action">
                             <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                             <a class="btn btn-outline-dark btn-square" href="{{route("itemdetail",$product->id)}}"><i class="fas fa-info"></i></a>
                           
                         </div>
                     </div>
                     <div class="text-center py-4">
                         <a class="h6 text-decoration-none text-truncate" href="">{{$product->name}}</a>
                         <div class="d-flex align-items-center justify-content-center mt-2">
                             <h5>{{$product->price}}</h5><h6 class="text-muted ml-2"><del>{{$product->price}}</del></h6>
                         </div>
                         <div class="d-flex align-items-center justify-content-center mb-1">
                             <small class="fa fa-star text-primary mr-1"></small>
                             <small class="fa fa-star text-primary mr-1"></small>
                             <small class="fa fa-star text-primary mr-1"></small>
                             <small class="fa fa-star text-primary mr-1"></small>
                             <small class="fa fa-star text-primary mr-1"></small>
                             <small>(99)</small>
                         </div>
                     </div>
                 </div>
               </div>
               
              @endforeach
            </div>
         </div>
         <div class="col-12 col-md-4">
            <div class="shop-info">
               <div class="card">
                  <div class="card-body">
                     <h6>Shop Located</h6>
                     <p>{{$vendor->owner->city}}</p>


                     <h6>Shop Description </h6>
                     <p> Our Shop</p>

                     <h6>Shop Address</h6>
                     <p>{{$vendor->shop_address}}</p>

                     <h6>Shop Mobile</h6>
                     <p>{{$vendor->shop_mobile}}</p>

                     <h6>Shop Email</h6>
                     <p>@if($vendor->shop_email) {{$vendor->shop_email}}  @else No email available @endif</p>

                     <h6>Shop Website</h6>
                     <p>@if($vendor->shop_website) {{$vendor->shop_website}}  @else No website available @endif</p>
                  </div>
               </div>
            </div>
         </div>

       </div>
    </div>




   <!-- Back to Top -->
   <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@endsection