<?php

namespace App\Exports;

use App\Models\Uploadfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UploadfileExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Uploadfile::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Filename',
            'Email',
            'Created at',
            'Updated at'
        ];
    }

}