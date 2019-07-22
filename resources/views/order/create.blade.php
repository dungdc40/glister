@extends('layouts.template')

@section('content')

<div class="panel-heading text-center"> <h2>Tạo đơn hàng mới</h2></div>
<div class="panel-body">


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <div class="form-group">
        <input type="hidden" name="customer_tel" id="customer_tel" class="form-control" value="{{$tel}}"/>
    </div>
    <div class="form-group">
        <label for="price">Giá:</label>
        <input type="text" name="price" id="price" class="form-control" />
    </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Tạo" />
    </form>
</div>
@endsection