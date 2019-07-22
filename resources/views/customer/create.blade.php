@extends('layouts.template')

@section('content')

<div class="panel-heading text-center"> <h2>Thêm thành viên</h2></div>
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

    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <div class="form-group">
        <label for="name">Tên:</label>
        <input type="text" name="name" id="name" class="form-control" />
    </div>
    <div class="form-group">
        <label for="tel">Số điện thoại:</label>
        <input type="text" name="tel" id="tel" class="form-control" />
    </div>
        <input type="hidden" name="points" id="points" class="form-control" value="5" />

        <br>

        <input type="submit" class="btn btn-primary" value="Thêm" />
    </form>
</div>
@endsection