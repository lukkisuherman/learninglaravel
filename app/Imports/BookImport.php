<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BookImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Book([
            'title' => $row[1],
            'author' => $row[2],
            'publication_year' => $row[3],
            'publisher' => $row[4],
            'id_category' => $row[5],
        ]);
    }
}
