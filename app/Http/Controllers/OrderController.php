<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Order;
use App\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest('updated_at')->simplePaginate(10);

		return view('order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int  $tel
     * @return \Illuminate\Http\Response
     */
    public function create($tel = null)
    {
        return view('order.create')->with('tel', $tel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response     
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'price' => 'required|numeric|min:1000',
            'customer_tel' => 'required|numeric|exists:customers,tel',
        ]);

        $point = floor(($request->price)/100000);
        $customer = Customer::where(['tel' => $request->customer_tel])->first();

        $current_point = $customer->points + $point;
        $customer->points = $current_point;
        $customer->save();

        $customer_id = $customer->id;
        $insert = Array('price' => $request->price, 'customer_id' => $customer_id);
        Order::create($insert);

        $orders = $customer->orders;   
        return redirect()->route('customers.show', ['customer' =>  $customer, 'orders'  => $orders])
        ->withSuccess('Đơn hàng được tạo thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
		return view('order.show')->withOrder($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return Response  
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
		return view('order.edit')->withOrder($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'price' => 'required|numeric',
            'customer_tel' => 'required|numeric|exists:customers,tel',
        ]);

        $order = Order::findOrFail($id);
        $old_point =  floor(($order->price)/100000);
        $new_point = floor(($request->price)/100000);
        $customer = Customer::where(['tel' => $request->customer_tel])->first();
        $current_point = $customer->points + $new_point - $old_point ;
        $customer->points = $current_point;
        $customer->save();

        $order->price = $request->price;
        $order->save();
        
        $orders = $customer->orders;
        return redirect()->route('customers.show', ['customer' =>  $customer, 'orders'  => $orders])
        ->withSuccess('Đơn hàng được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customer_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $customer = Customer::find($order->customer_id);
        $old_point =  floor(($order->price)/100000);
        $current_point = $customer->points - $old_point ;
        $customer->points = $current_point;
        $customer->save();
        $order->delete();

        $orders = $customer->orders;
        return redirect()->route('customers.show', ['customer' =>  $customer, 'orders'  => $orders])
        ->withSuccess('Đơn hàng đã bị xóa!');
    }
}
