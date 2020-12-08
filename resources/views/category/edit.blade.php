@extends('layouts.app')
  
@section('content')
   
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Edit Kategori
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="post" action="{{ route('category.update', $category->id) }}" id="myForm">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="category_name">Nama Kategori</label>                    
                    <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $category->category_name }}" aria-describedby="title" >                
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('category.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection