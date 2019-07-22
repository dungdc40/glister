@extends('layouts.template')

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection  

@section('content')
@if (Session::has('success'))
<div class="alert alert-success" style="padding-left: 40px;">{{ Session::get('success') }}</div>
@endif
<div class="panel-heading text-center"> <h2>Danh sách đơn hàng</h2></div>
<div class="panel-body">
	<table class="table" id='sorting-data-table'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Giá</th>
				<th>ID khách hàng</th>
				<th>Đăng ký từ</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr>
				<td>{{ $order->id }}</td>
				<td>{{ $order->price }}</td>
                <td>{{ $order->customer_id }}</td>
                <td>{{ $order->created_at }}</td>
				<td> <a href="{{ route('orders.edit',$order->id )}}" class="btn btn-primary"> Sửa </a></td>
                <td>
                <form action="{{ route('orders.destroy', $order->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                </form>
            </td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection