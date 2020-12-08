<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Imports\BookImport;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Echo_;
use RealRashid\SweetAlert\Facades\Alert;



class BookController extends Controller
{
    protected $htmlBuilder;

    public function __construct(Builder $htmlBuilder)
    {
        $this->htmlBuilder = $htmlBuilder;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $book = Book::with('category')->get();
        $category = BookCategory::all();

        // if (request()->ajax()) {
        //     return DataTables::of(Book::query())->make(true);
        // }

        // $html = $builder->columns([
        //     ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
        //     ['data' => 'title', 'name' => 'title', 'title' => 'Judul'],
        //     ['data' => 'author', 'name' => 'author', 'title' => 'Penulis'],
        //     ['data' => 'publication_year', 'name' => 'publication_year', 'title' => 'Tahun Terbit'],
        //     ['data' => 'publisher', 'name' => 'publisher', 'title' => 'Penerbit'],
        //     ['data' => 'id_category', 'name' => 'id_category', 'title' => 'Kategori']
        // ]);

        if ($request->ajax()) {
            $data = Book::select(['*'])->with('category');;
            $datatables = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($images) {
                    $url = asset('storage/book/' . $images->image);
                    return '<img src="' . $url . '" border="0" width="50" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $editRoute = route('book.edit', ['book' => $row->id]);
                    $deleteRoute = route('book.destroy', ['book' => $row->id]);
                    $showRoute = route('book.show', ['book' => $row->id]);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');
                    $btn = "<div class='d-flex'>
                                <a href='{$showRoute}' class='btn btn-warning'>
                                    <i class='fa fa-eye'></i>
                                </a>
                                <a href='{$editRoute}' class='btn btn-primary'>
                                    <i class='fa fa-edit'></i>
                                </a>
                                <form method='POST' action='{$deleteRoute}'>{$csrf} {$method}
                                    <button class='btn btn-danger' onclick=\"return confirm('Apakah Anda ingin menghapus data ini?')\"><i class='fa fa-trash'></i>
                                    </button>
                                </form>
                                </div>";

                    return $btn;
                })
                ->rawColumns(['image', 'action']);
            return $datatables->make(true);
        }

        $dataTable = $this->htmlBuilder
            ->parameters([
                'paging' => true,
                'searching' => true,
                'info' => false,
                'searchDelay' => 350,
                'dom' => 'Bfrtip',
                'buttons' =>
                [
                    'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5', 'print'
                ],


            ])
            ->addColumn(['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'orderable' => false, 'searchable' => false, 'width' => 30])
            ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Judul'])
            ->addColumn(['data' => 'author', 'name' => 'author', 'title' => 'Penulis'])
            ->addColumn(['data' => 'publication_year', 'name' => 'publication_year', 'title' => 'Tahun Terbit'])
            ->addColumn(['data' => 'publisher', 'name' => 'publisher', 'title' => 'Penerbit'])
            ->addColumn(['data' => 'category.category_name', 'name' => 'category.category_name', 'title' => 'Kategori'])
            ->addColumn(['data' => 'image', 'name' => 'image', 'title' => 'Foto', 'orderable' => false, 'searchable' => false])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false, 'width' => 100]);

        return view('book.index', compact('book', 'dataTable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = BookCategory::all();
        return view('book.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required',
            'publisher' => 'required',
            'id_category' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/book', $image->hashName());

        $book = Book::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'author'   => $request->author,
            'publication_year'   => $request->publication_year,
            'id_category'   => $request->id_category,
            'publisher'   => $request->publisher
        ]);

        if ($book) {
            //redirect dengan pesan sukses
            Alert::success('Berhasil', 'Buku Berhasil Ditambahkan');
            return redirect()->route('book.index');
        } else {
            //redirect dengan pesan error
            Alert::error('Gagal', 'Gagal Menambahkan Buku');
            return redirect()->route('book.index');
        }

        // // menyimpan data file yang diupload ke variabel $file
        // $image = $request->file('image');

        // $nama_file = date('YmdHis') . "." . $image->getClientOriginalExtension();

        // // isi dengan nama folder tempat kemana file diupload
        // $tujuan_upload = 'data_file';

        // $image->move($tujuan_upload, $nama_file);

        // Book::create([
        //     'image' => $nama_file,
        //     'title' => $request->title,
        //     'author' => $request->author,
        //     'publication_year' => $request->publication_year,
        //     'publisher' => $request->publisher,
        //     'id_category' => $request->id_category,
        // ]);

        // return redirect()->route('book.index')
        //     ->with('success', 'Buku Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('book.detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        // $book = Book::find($id);

        $category = BookCategory::all();
        // $category = BookCategory::pluck('category_name', 'id');
        // $selectedID = 2;

        return view('book.edit', compact('book', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required',
            'publisher' => 'required'
        ]);

        //get data Blog by ID
        $book = Book::findOrFail($book->id);

        if ($request->file('image') == "") {

            $book->update([
                'title'     => $request->title,
                'author'   => $request->author,
                'publication_year'   => $request->publication_year,
                'publisher'   => $request->publisher,
                'id_category'   => $request->id_category
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/book/' . $book->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/book', $image->hashName());

            $book->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'author'   => $request->author,
                'publication_year'   => $request->publication_year,
                'publisher'   => $request->publisher,
                'id_category'   => $request->id_category
            ]);
        }

        if ($book) {
            //redirect dengan pesan sukses
            Alert::success('Berhasil', 'Buku Berhasil Diupdate');
            return redirect()->route('book.index');
        } else {
            //redirect dengan pesan error
            Alert::error('Gagal', 'Buku Gagal Diupdate');
            return redirect()->route('book.index');
        }

        // Book::find($id)->update($request->all());

        // return redirect()->route('book.index')->with('success', 'Buku Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        Storage::disk('local')->delete('public/book/' . $book->image);
        $book->delete();

        if ($book) {
            //redirect dengan pesan sukses
            Alert::success('Berhasil', 'Buku Berhasil Dihapus');
            return redirect()->route('book.index');
        } else {
            //redirect dengan pesan error
            Alert::error('Gagal', 'Buku Gagal Dihapus');
            return redirect()->route('book.index');
        }
    }

    public function export()
    {
        return Excel::download(new BookExport, 'book.xlsx');
    }

    public function import(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_book', $nama_file);

        // import data
        Excel::import(new BookImport, public_path('/file_book/' . $nama_file));

        // notifikasi dengan session
        Alert::success('Berhasil', 'Data Berhasil Diimport');

        // alihkan halaman kembali
        return redirect('/book');
    }
}
