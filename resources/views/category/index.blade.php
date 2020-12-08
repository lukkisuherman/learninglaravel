@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
            <div class="pull-left mt-2">
                <h2>Laravel 8 CRUD - Manajemen Kategori</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New User</a>
            </div>

            @include('sweetalert::alert')
    
    {!! $dataTable->table() !!}
    {{-- <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($category as $c)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $c->category_name }}</td>
            <td>
                <form action="{{ route('category.destroy',$c->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('category.show',$c->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('category.edit',$c->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table> --}}
  </div>
</div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://use.fontawesome.com/9ff0df3b41.js"></script>
@endpush
@push('scripts')
{{-- <script src="//cdn.datatables.net/1.10.22/js/jquery.js"></script> --}}
<script src="//cdn.datatables.net/1.10.22/js/dataTables.dataTables.min.js"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>



{!! $dataTable->scripts() !!}
@endpush