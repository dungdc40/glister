@extends('layouts.template')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Import Export Excel to database - Tuts Make
        </div>
        <div class="card-body">
            <form action="{{ url('import') }}" method="POST" name="importform" 
               enctype="multipart/form-data">
               {{ csrf_field() }}
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import File</button>
            </form>
        </div>
    </div>
</div>
    
@endsection