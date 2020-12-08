@extends('layouts.app')
  
@section('content')
   
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Edit Buku
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
            <form method="post" action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data" id="myForm">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="title">Judul</label>                    
                    <input type="text" name="title" class="form-control" id="title" value="{{ $book->title }}" aria-describedby="title" >                
                </div>
                <div class="form-group">
                    <label for="author">Penulis</label>                    
                    <input type="text" name="author" class="form-control" id="author" value="{{ $book->author }}" aria-describedby="author" >                
                </div>
                <div class="form-group">
                    <label for="publication_year">Tahun Terbit</label>                    
                    <input type="text" name="publication_year" class="form-control" id="publication_year" value="{{ $book->publication_year }}" aria-describedby="publication_year" >                
                </div>
                <div class="form-group">
                    <label for="publisher">Penerbit</label>                    
                    <input type="text" name="publisher" class="form-control" id="publisher" value="{{ $book->publisher }}" aria-describedby="publisher" >                
                </div>
                <div class="form-group">
                    <label for="id_category">Kategori</label>                    
                    <select class="form-control" name="id_category" id="id_category">
                      @foreach ($category as $c)
                      <option value="{{$c->id}}"
                          @if ($c->id == $book->id_category)
                              selected
                          @endif
                          >{{$c->category_name}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label for="image">Foto Buku</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                {{-- <div class="form-group">
                    <label for="id_category">Kategori</label>                    
                    {!! Form::select('id_category', $category, $selectedID, ['class' => 'form-control']) !!}
                </div> --}}
                {{-- {!! Form::select('id_category', \App\Models\BookCategory::pluck('category_name', 'id'), null, ['class' => 'form-control']) !!} --}}
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('book.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection