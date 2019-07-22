@extends('layouts.template')

@section('content')


<div class="panel-heading text-center"> <h2>Chỉnh sửa đơn hàng</h2></div>
<div class="panel-body">


  <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
    
      <form method="post" action="{{ route('orders.update', $order->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')

    <input type="hidden" name="customer_tel" id="customer_tel" class="form-control" value="{{ $order->customer->tel}}" />

    <label for="price">Giá tiền:</label>
    <input type="number" name="price" id="price" class="form-control" value="{{ $order->price}}" />

    <br>
    {{ method_field('PUT') }}
    <input type="submit" class="btn btn-primary" value="Sửa" />
  </form>
</div>


@endsection