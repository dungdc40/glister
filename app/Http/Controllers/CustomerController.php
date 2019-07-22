<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Order;
use Illuminate\Validation\Rule;
use App\Imports\ImportCustomers;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
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
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        if($search) {
            $customers = Customer::where('tel',$search)->simplePaginate(1);
            return view('customer.index')->with('customers', $customers)->with('success', 'Customer is searched');
        } else {
            $customers = Customer::latest('updated_at')->simplePaginate(10);
            return view('customer.index')->with('customers', $customers);
        }
       
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'name' => 'required',
            'tel' => 'required|unique:customers|max:11|min:10',
        ]);
        $fields = $request->all();
        $fields['created_at'] = '2022-10-10 00:00:00';
		Customer::create($fields);
        return redirect('/customers')->with('success', 'Khách hàng đã tạo thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $orders = $customer->orders->sortByDesc('updated_at');
    
		return view('customer.show')->with('customer', $customer)->with('orders', $orders);
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
        $customer = Customer::findOrFail($id);
		return view('customer.edit')->withCustomer($customer);
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
            'name' => 'required',
            'tel' => 'required|min:10|max:11|unique:users,email,'.$id,
            'points' => 'required|numeric',
        ]);
        Customer::whereId($id)->update($validator);

        return redirect('/customers')->with('success', 'Khách hàng đã cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('/customers')->with('success', 'Khách hàng đã bị xóa');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ImportCustomers, request()->file('file'));
            
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExport()
    {
       return view('customer.import');
    }
    
}
