@extends('layouts.app')
  
@section('content')
   
<div class="container mt-5">
   
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Tambah Kategori
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
            {{-- <form method="post" action="{{ route('category.store') }}" id="myForm">
            @csrf
                <div class="form-group">
                    <label for="category_name">Judul Buku</label>                    
                    <input type="text" name="category_name" class="form-control" id="category_name" aria-describedby="category_name" >                
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form> --}}
            {!! Form::open(['route' => 'category.store']) !!}
            {!! Form::token(); !!}
            <div class="form-group">
                {!! Form::label('category_name', 'Nama Kategori'); !!}
                {!! Form::text('category_name', null , array('class' => 'form-control'));!!}
            </div>
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            </div>
            <a class="btn btn-success mt-3" href="{{ route('category.index') }}">Kembali</a>
        </div>
    </div>
    </div>
@endsection