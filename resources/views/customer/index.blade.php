@extends('layouts.template')

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection  

@section('content')


@if(!$customers)
Tạo tài khoản mới 
<a href="{{ url('customers/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>
@else
<div class="panel-heading text-center"> <h2>Danh sách thành viên</h2></div>
<div class="panel-body">
	<div>
		<a href="{{ route('customers.create')}}" class="btn btn-primary"> Thêm thành viên</a>
	</div>
	<br/>
	<table class="table" id='sorting-data-table'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Tên</th>
				<th>SĐT</th>
                <th>Điểm</th>
				<th>Đăng ký từ</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($customers as $customer)
			<tr>
				<td>{{ $customer->id }}</td>
				<td>{{ $customer->name }}</td>
                <td>{{ $customer->tel }}</td>
                <td>{{ $customer->points }}</td>
				<td>{{ $customer->created_at }}</td>
				<td><a href="{{ route('orders.create', ['tel' => $customer->tel])}}" class="btn btn-success text-center">Tạo đơn</a></td>
				<td> <a href="{{ route('customers.show',$customer->id )}}" class="btn btn-info"> Chi tiết </a></td>
				<td> <a href="{{ route('customers.edit',$customer->id )}}" class="btn btn-primary"> Sửa </a></td>
                <td>
                <form action="{{ route('customers.destroy', $customer->id)}}" method="post">
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
{{ $customers->links() }}
@endif
@endsection