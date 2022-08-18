@extends("layouts.frontend.frontend_layout")


@section("content")


 <!-- Cart Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <input type="text" hidden  id="csrf" value="{{csrf_token()}}">

                    
                    @forelse ($orders as $order)


                    <tr order_id="{{$order->id}}" order_stock="{{$order->getAttri->stock}}" order_price="{{$order->getAttri->price}}">
                        
                        <input type="text" hidden  name="url" id="url" value="{{route("updatecart")}}">
                        <input type="text" hidden  id="csrf" value="{{csrf_token()}}">
                        <input type="text" hidden  id="price" value="{{$order->getAttri->price}}">

                        <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">{{$order->getProduct->name}}</td>
                        <td class="align-middle">{{$order->getAttri->price}}</td>
                        <input type="text" hidden  name="order_id" id="order_id" value="{{$order->id}}">

                        <td class="align-middle">
                            <div class="input-group quantity  mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary  btn-minus{{$order->id}}" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" class="form-control form-control-sm bg-secondary border-0 text-center quantityinput" input_id="{{$order->id}}" id="quantityinput{{$order->id}}"  value="{{$order->order_quantity}}" >
                                

                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary  btn-plus{{$order->id}}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle totalPrice" id="totalPrice{{$order->id}}">{{$order->getAttri->price * $order->order_quantity}}</td>
                        <input type="text" hidden  name="url" id="url" value="{{route("deleteorder")}}">
                        <td class="align-middle"><button class="btn btn-sm btn-danger" form="cartdel{{$order->id}}"><i class="fa fa-times"></i></button></td>

                        <form action="{{route("deleteorder")}}" id="cartdel{{$order->id}}" method="POST">
                            @csrf
                            <input type="text" hidden name="orderid" value="{{$order->id}}">
                        </form>
                    </tr>
                        @empty
                            
                       
                    @endforelse
                  
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <input type="radio" id="delivery" checked> 
            <label for="delivery">Delivery Option</label>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="itemtotal">{{App\Models\Order::getPrice()}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium" >Shipping</h6>
                        <h6 class="font-weight-medium" id="shipping">  @if(!empty($order)) {{$order->getProduct->shipping_fee}} @else 0  @endif</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="alltotal">@if(!empty($order)) {{App\Models\Order::getPrice()+ $order->getProduct->shipping_fee}} @else @endif</h5>



                    </div>
                    <br>
                   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Proceed To Order
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route("purchase")}}" id="orderform" method="post">
                @csrf
                <input type="text" hidden  name="shipping_fee" value=@if(!empty($order)){{$order->getProduct->shipping_fee}} @else @endif> 
                <input type="text" hidden  class="itemtotal"  name="sub_total" value="{{App\Models\Order::getPrice()}}"> 
                <input type="text" hidden  class="alltotal"  name="all_total" value=@if(!empty($order)){{ App\Models\Order::getPrice()+ $order->getProduct->shipping_fee }} @else @endif> 
                <input type="text" hidden  class="owner_id"  name="owner_id" value=@if(!empty($order)){{  $order->getProduct->admin_id }} @else @endif> 

                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Email</label>
                  <input type="text" name="email" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Region</label>
                    <input type="text" name="region" class="form-control" id="recipient-name">
                  </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">City</label>
                  <input type="text" name="city" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Township</label>
                    <input type="text" name="township" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Building No (Or) LandMark</label>
                    <input type="text" name="building_no" class="form-control" id="recipient-name">
                  </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Address</label>
                  <textarea class="form-control" name="address" id="message-text"></textarea>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="orderform" class="btn btn-primary">Order</button>
        </div>
      </div>
    </div>
  </div>
                    
                    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Your Address And Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="recipient-name">
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="recipient-name">
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="recipient-name">
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">City</label>
                                <input type="text" name="city" class="form-control" id="recipient-name">
                              </div>
                              <div class="form-group">
                                <label for="message-text" class="col-form-label">Address</label>
                                <textarea class="form-control" name="address" id="message-text"></textarea>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Order</button>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection