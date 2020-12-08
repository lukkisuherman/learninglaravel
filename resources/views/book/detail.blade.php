@extends('layouts.app')
  
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Detail Buku
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Judul: </b>{{$book->title}}</li>
                    <li class="list-group-item"><b>Penulis: </b>{{$book->author}}</li>
                    <li class="list-group-item"><b>Tahun Terbit: </b>{{$book->publication_year}}</li>
                    <li class="list-group-item"><b>Penerbit: </b>{{$book->publisher}}</li>
                    <li class="list-group-item"><b>Kategori: </b>{{$book->category->category_name}}</li>
                </ul>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('book.index') }}">Kembali</a>

        </div>
    </div>
</div>
@endsection