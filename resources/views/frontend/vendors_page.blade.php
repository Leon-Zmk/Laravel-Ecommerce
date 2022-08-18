@extends('layouts.frontend.frontend_layout')


@section('content')

    <div class="container">
       <div class="row">
         @foreach ($vendors as $vendor)
          <div class="col-12 col-md-3">
            <div class="product-item  bg-light">
               <div class="product-img  position-relative overflow-hidden">
                   <img class="img-fluid w-100" src="{{asset("storage/shop_profiles/$vendor->shop_profile")}}" style="height:200px" alt="">
                   <div class="product-action">
                     
                       <a class="btn btn-outline-dark btn-square" href="{{route("vendordetail",$vendor->id)}}"><i class="fas fa-info"></i></a> 
                   </div>
               </div>
               <div class="text-center py-4">
                   <a class="h6 text-decoration-none text-truncate" href="">{{$vendor->shop_name}}</a>
               </div>
           </div>
          
          </div>
          @endforeach
       </div>
    </div>




   <!-- Back to Top -->
   <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@endsection