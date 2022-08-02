@extends('layouts.frontend.frontend_layout')


@section("content")


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @foreach ($product->images as $key=>$image)

                        <div class="carousel-item  {{$key == 0 ? 'active' : ''}}">
                               
                         

                            <img class="w-100 h-100" src="{{asset("storage/frontend/products/medium/".$image->name)}}" alt="Image">

                            

                            
                        </div>
                        
                        @endforeach
                      
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$product->name}}</h3>
                    <br>
                    <br>
                    <h6 class="font-weight-semi-bold mb-4" >Price: <span id="itemprice">{{$product->price}} MMK</span></h6>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Sizes:</strong>
                        <form id="order" action="{{route("saveorder")}}" method="POST">

                            @csrf
                            @foreach ($product->attributes as $attribute)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="text" hidden id="product_id" name="product_id" value="{{$product->id}}">
                                <input type="text" hidden id="quantity_url" value="{{route("getsizequantity")}}">
                                <input type="text" hidden id="csrf" value="{{csrf_token()}}">
                                <input type="radio" form="order"  class="custom-control-input size-radio"  value="{{$attribute->id}}" id="{{$attribute->id}}" name="product_attribute_id">
                                <label class="custom-control-label" for="{{$attribute->id}}">{{$attribute->size}}</label>
                            </div>
                            @endforeach

                            <input type="text" form="order" name="product_id" hidden value="{{$product->id}}" id="product_id">

                        </form>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Color: &nbsp; &nbsp;{{strtoupper($product->color)}}</strong>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn  btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="number" id="quantityinput" name="order_quantity" form="order"  class="form-control cartinput bg-secondary border-0 text-center quantityinput" value="1">
                            <div class="input-group-btn">
                                <button class="btn  btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button form="order" class="btn btn-primary px-3 addtocart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                 
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                           <p>
                               {{$product->description}}
                           </p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                   @foreach ($products as $key=>$producT)
                   <div class="{{"product-item-$key"}} bg-light">
                    <div class="{{"product-img-$key"}} position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{asset("storage/frontend/products/small/$producT->image")}}" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{route("itemdetail",$producT->id)}}"><i class="fas fa-info"></i></a>
                            
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{$producT->name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h6>{{$producT->price}} &nbsp; MMK</h6><h6 class="text-muted ml-2">@if($product->discount==0)   @else <del>{{$product->discount}} MMK</del></h6>    @endif
                        </div>
                       
                    </div>
                </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


@endsection


