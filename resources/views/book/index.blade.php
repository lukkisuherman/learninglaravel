@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
            <div class="pull-left mt-2">
                <h2>Laravel 8 CRUD - Manajemen Buku</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-info" data-toggle="modal" data-target="#importExcel"> Import Data</a>
                <a class="btn btn-warning" href="/book/export/excel"> Export Data</a>
                <a class="btn btn-success" href="{{ route('book.create') }}"> Tambah Buku</a>
            </div>

        @if(session()->has('status'))
            {{ session('status') }}
        @endif

        <!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/book/import" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
   
    {!! $dataTable->table(['class'=>'table table-bordered table-hover'], true) !!}
    {{-- <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Penerbit</th>
            <th>Kategori</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($book as $b)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $b->title }}</td>
            <td>{{ $b->author }}</td>
            <td>{{ $b->publication_year }}</td>
            <td>{{ $b->publisher }}</td>
            <td>{{ $b->category ? $b->category->category_name :"-" }}</td>
            <td>
                <form action="{{ route('book.destroy',$b->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('book.show',$b->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('book.edit',$b->id) }}">Edit</a>
   
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
    <div class="text-center">
        {{-- {!! $html->scripts() !!} --}}
    </div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
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