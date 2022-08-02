<?php


namespace App\Http\Controllers\FrontendControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    
    public function saveOrder(Request $request){
        
        $order=new Order();
        $order->product_id=$request->product_id;
        $order->product_attribute_id=$request->product_attribute_id;
        $order->order_quantity=$request->order_quantity;
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
            $order->update();
            }

       
        
        return response($order->getAttri->price);

    }

}
