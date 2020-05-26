<?php

namespace App\Imports;

use App\Models\StokUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithBatchInserts;


class StokImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, WithValidation, WithBatchInserts, WithMultipleSheets
{

    use Importable;
    
    public $dist_code = null;
    public $report_date = null;
    
    public function model(array $row)
    {
        // dd($row);      
        return new \App\Models\UploadStt([
            //
            'dist_code' => $this->dist_code,
            'report_date' => $this->report_date,
            'item_code' => $row['item_code'],
            'subbrand'  => $row['by_subbrand'],
            'item_name' => $row['by_item'],
            'unit' => $row['unit_satuan'],
            'stock_ob' => $row['beginning'],
            'stock_in' => $row['in'],
            'stock_out' => $row['out'],
            'stock_bad' => $row['bad_stock'],
            'stock_above' => $row['above_1_year'],
            'stock_below' => $row['below_1_year'],

        ]);
    }

    

    // use heading row
    public function headingRow(): int
    {
        return 10;
    }

     // batchinsert
     public function batchSize(): int
     {
         return 2000;
     }

    // validation
    public function rules(): array
    {
        return [
            // 'item_code' => 'required|int',
            'item_code' => 'required|exists:acp_item,item_code',
            
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

    // only sheet 1
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }


}
