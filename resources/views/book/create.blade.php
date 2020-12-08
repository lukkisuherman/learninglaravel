@extends('layouts.app')
  
@section('content')
   
<div class="container mt-5">
   
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Tambah Buku
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
            {{-- <form method="post" action="{{ route('book.store') }}" id="myForm"> --}}
                {!! Form::open(['route' => 'book.store', 'enctype'=>'multipart/form-data']) !!}
            {{-- @csrf --}}
            <div class="form-group">
                {!! Form::label('title', 'Judul Buku'); !!}
                {!! Form::text('title', null, array_merge(['class' => 'form-control'])); !!}
            </div>
            <div class="form-group">
                {!! Form::label('author', 'Penulis'); !!}
                {!! Form::text('author', null, array('class' => 'form-control')); !!}
            </div>
            <div class="form-group">
                {!! Form::label('publication_year', 'Tahun Terbit'); !!}
                {!! Form::text('publication_year', null, array('class' => 'form-control')); !!}
            </div>
            <div class="form-group">
                {!! Form::label('publisher', 'Penerbit'); !!}
                {!! Form::text('publisher', null, array('class' => 'form-control')); !!}
            </div>
            <div class="form-group">
                {!! Form::label('id_category', 'Kategori'); !!}
                {!! Form::select('id_category', \App\Models\BookCategory::pluck('category_name', 'id'), null, ['class' => 'form-control']) !!}
            </div>
            {{-- <div class="form-group">
                {!! Form::label('image', 'Foto'); !!}
                {!! Form::file('image'); !!}
            </div> --}}
            <div class="form-group">
                <label for="Foto">Foto Buku</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
                {{-- <div class="form-group">
                    <label for="title">Judul Buku</label>                    
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="title" >                
                </div>
                <div class="form-group">
                    <label for="author">Penulis</label>                    
                    <input type="text" name="author" class="form-control" id="author" aria-describedby="author" >                
                </div>
                <div class="form-group">
                    <label for="publication_year">Tahun Terbit</label>                    
                    <input type="text" name="publication_year" class="form-control" id="publication_year" aria-describedby="publication_year" >                
                </div>
                <div class="form-group">
                  <label for="publisher">Penerbit</label>                    
                  <input type="text" name="publisher" class="form-control" id="publisher" aria-describedby="publisher" >
                </div>
                <div class="form-group">
                  <label for="id_category">Kategori</label>                    
                  <select class="form-control" name="id_category" id="id_category">
                      @foreach ($category as $c)
                        <option value="{{$c->id}}">{{$c->category_name}}</option>
                      @endforeach
                  </select>
                </div> --}}
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            {{-- </form> --}}
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            </div>
            <a class="btn btn-success mt-3" href="{{ route('book.index') }}">Kembali</a>
        </div>
    </div>
    </div>
@endsection