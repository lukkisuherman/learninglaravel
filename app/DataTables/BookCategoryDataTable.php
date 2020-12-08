<?php

namespace App\DataTables;

use App\Models\BookCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Barryvdh\Snappy\Facades\SnappyPdf;
use PDF;

class BookCategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
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
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BookCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BookCategory $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('bookcategory-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
                Button::make('pdf')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('category_name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BookCategory_' . date('YmdHis');
    }
}
