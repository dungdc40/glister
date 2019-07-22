@extends('layouts.template')

@section('content')

<div class="panel-heading text-center"> <h2>Sửa thành viên</h2></div>
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
      <form method="post" action="{{ route('customers.update', $customer->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')

    <label for="name">Tên:</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name}}" />

      <label for="tel">Số điện thoại:</label>
    <input type="text" name="tel" id="tel" class="form-control" value="{{ $customer->tel}}" />

      <label for="points">Điểm:</label>
    <input type="number" name="points" id="points" class="form-control" value="{{ $customer->points}}" />

    <br>
    {{ method_field('PUT') }}
    <input type="submit" class="btn btn-primary" value="Sửa" />
  </form>
</div>

@endsection