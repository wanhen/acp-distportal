<?php

namespace App\Imports;

use App\TempUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class TempUploadImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, WithValidation
{

    use Importable;
    
    public function model(array $row)
    {
        // dd($row);      
        return new \App\Models\TempUpload([
            //
            // 'date_report'   => $row['date_report'],
            'item_code' => $row['item_code'],
            'subbrand'  => $row['by_subbrand'],
            'item_name' => $row['by_item'],
            'unit' => $row['unit_satuan'],
        ]);
    }

    // use heading row
    public function headingRow(): int
    {
        return 10;
    }

    // validation
    public function rules(): array
    {
        return [
            'item_code' => 'required|int',
            // '1' => Rule::in(['patrick@maatwebsite.nl']),

            //  // Above is alias for as it always validates in batches
            //  '*.1' => Rule::in(['patrick@maatwebsite.nl']),
             
            //  // Can also use callback validation rules
            //  '0' => function($attribute, $value, $onFailure) {
            //       if ($value !== 'Patrick Brouwers') {
            //            $onFailure('Name is not Patrick Brouwers');
            //       }
            //   }
        ];
    }


}
