<?php

namespace App\Imports;

use App\Models\SttUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;


class TempSttImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, WithValidation, SkipsOnFailure, WithMultipleSheets
{

    use Importable, SkipsFailures;

    public $cust_id = null;
    public $report_date = null;
    
    public function model(array $row)
    {
        // dd($this->cust_id);
        //dd($row);      
        return new \App\Models\SttUpload([
            //
            'cust_id'   => $this->cust_id,
            'report_date'   => $this->report_date,
            'bulan' => $row['bulan'],
            'tanggal'  => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal'])),
            'code_customer' => $row['code_customer'],
            'nama_customer' => $row['nama_customer'],
            'alamat' => $row['alamat'],
            'kota' => $row['kota'],
            'type_outlet' => $row['type_outlet'],
            'brand' => $row['brand'],
            'code_salesman' => $row['code_salesman'],
            'nama_salesman' => $row['nama_salesman'],
            'code_item' => $row['code_item'],
            'nama_item' => $row['nama_item'],
            'harga' => ($row['harga_per_item'] == null ? 0:$row['harga_per_item']),
            'satuan' => $row['satuan'],
            'qty' => ($row['quantity'] == null ? 0 : $row['quantity']),
            'diskon' => ($row['diskon'] == null ? 0 : $row['diskon']),
            'revenue' => ($row['revenue_rp'] == null ? 0 : $row['revenue_rp']),
        ]);
    }

    // use heading row
    public function headingRow(): int
    {
        return 1;
    }

    // validation
    public function rules(): array
    {
        return [
            // 'code_item' => 'required|int',
            'harga' => 'required!numeric|between:0,9999999999999',
            'quantity' => 'required|numeric|between:0.00,999.99',
            'code_item' => 'required|exists:temp_item,internal_id',
            // https://stackoverflow.com/questions/29183075/validation-check-if-1-equal-to-some-value-from-database-laravel-5/41040414
            
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
