<?php


namespace App\Http\Controllers\FrontendControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\ProductsAttribute;

class OrderController extends Controller
{
    
    public function saveOrder(Request $request){
        
        $productattrprice=ProductsAttribute::find($request->product_attribute_id);

        
        $order=new Order();
        $order->product_id=$request->product_id;
        $order->product_attribute_id=$request->product_attribute_id;
        $order->order_quantity=$request->order_quantity;
        $order->product_price=$productattrprice->price;
        $order->item_total_fee= $request->item_price * $request->order_quantity;
        $order->is_deliver_status=0;
        $order->order_member_id=auth()->user()->id;

        $order->save();

        return  redirect()->back();

    }

    public function Cart(){

        $orders=Order::where("order_member_id",auth()->user()->id)->get();
        return view("frontend.cart",compact("orders"));
    }

    public function updateCart(Request $request){


        $order=Order::find($request->order_id);
    

        
            if($request->newVal){
                
            $order->order_quantity=$request->newVal;
            $order->item_total_fee=$order->product_price * $request->newVal;
            $order->update();
            }

       
        
        return response($order->getAttri->price);

    }

    public function deleteorder(Request $request){

        $order=Order::find($request->orderid);
        $order->delete();

        return redirect()->back();

    }

    public function Purchase(Request $request){

        
        $buyer=new Buyer();

        $buyer->user_id=auth()->user()->id;
        $buyer->name=$request->name;
        $buyer->phone=$request->phone;
        $buyer->email=$request->email;
        $buyer->Region=$request->region;
        $buyer->City=$request->city;
        $buyer->Township=$request->township;
        $buyer->building_no=$request->building_no;
        $buyer->shipping_fee=$request->shipping_fee;
        $buyer->sub_total=$request->sub_total;
        $buyer->all_total=$request->all_total;
        $buyer->address=$request->address;

        $buyer->save();

        $orders=Order::where("order_member_id",auth()->user()->id)->where("is_pending","!=","1")->get();


        foreach ($orders as $key => $order) {
            
            $order->is_pending=1;
            $order->save();
        }
        

        return redirect()->back();


    }

}
