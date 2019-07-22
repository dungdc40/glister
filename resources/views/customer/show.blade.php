
@extends('layouts.template')

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection  


@section('content')
@if (Session::has('success'))
<div class="alert alert-success" style="padding-left: 40px;">{{ Session::get('success') }}</div>
@endif

<div class="panel-heading text-center"> 
<h2>Lịch sử mua hàng </h2>
</div>

<div class='col-xs-3'> <strong> Tên: </strong></div>
<div class='col-xs-9'> {{ $customer->name }} </div>
<div class='col-xs-3'> <strong> SĐT: </strong></div>
<div class='col-xs-9'>{{ $customer->tel }} </div>
<div class='col-xs-3'> <strong> Tổng điểm: </strong></div>
<div class='col-xs-9'> {{ $customer->points }} </div>
<div class='col-xs-12'>
<div style='text-align: center; padding: 20px'>
<a href="{{ route('orders.create', ['tel' => $customer->tel])}}" class="btn btn-primary text-center"> Tạo đơn hàng mới </a>
</div>
</div>

@if($orders->count() > 0)
<div class="panel-body ">
<div class="text-center"> 
<h2>Chi tiết các đơn hàng</h2>
</div>
	<table class="table" id='sorting-data-table'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Giá tiền</th>
				<th>Ngày tạo</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
        @foreach($orders as $order)
		
			<tr>
				<td>{{ $order->id }}</td>
				<td>{{ $order->price }}</td>
                <td>{{ $order->created_at }}</td>
				<td> <a href="{{ route('orders.edit',$order->id )}}" class="btn btn-primary"> Sửa </a></td>
                <td>
                <form action="{{ route('orders.destroy', $order->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                </form>
                </td>
			</tr>
			
        @endforeach    
		</tbody>
	</table>
</div>

@else
<div class="panel-body">
Chưa có đơn hàng
</div>

@endif
@endsection


