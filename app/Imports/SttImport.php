<?php

namespace App\Imports;

use App\Models\UploadStt;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithBatchInserts;


class SttImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, WithValidation, WithBatchInserts, WithMultipleSheets
{

    use Importable;

    public $dist_code = null;
    public $report_date = null;
    public $period = null;
        
    public function model(array $row)
    {
        // dd($row);      
        // 'dist_code','report_date','period','tanggal','no_faktur','code_salesman','nama_salesman','code_customer','nama_customer','alamat','kota','channel','type_outlet','brand','code_item','nama_item','code_item_acp','harga','qty1','unit1','qty2','unit2','diskon','revenue'
        return new \App\Models\UploadStt([
            //
            'dist_code'   => $this->dist_code,
            'report_date'   => $this->report_date,
            'period' => $this->period,            
            'tanggal'  => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal'])),
            // 'tanggal' => $row['tanggal'],
            'no_faktur' => $row['no_faktur'],
            'code_salesman' => $row['code_salesman'],
            'nama_salesman' => $row['nama_salesman'],
            'code_customer' => $row['code_customer'],
            'nama_customer' => $row['nama_customer'],
            'alamat' => $row['alamat'],
            'kota' => $row['kota'],
            'channel' => $row['channel'],
            'type_outlet' => $row['type_outlet'],
            'brand' => $row['brand'],            
            'code_item' => $row['code_item'],
            'nama_item' => $row['nama_item'],
            'code_item_acp' => $row['code_item_acp'],
            'harga' => ($row['harga_per_item'] == null ? 0:$row['harga_per_item']),            
            'qty1' => ($row['qty_duscarton'] == null ? 0 : $row['qty_duscarton']),
            'unit1' => 'Dus',
            'qty2' => ($row['qty_pcsbtlrencengkgjerigen'] == null ? 0 : $row['qty_pcsbtlrencengkgjerigen']),
            'unit2' => 'Pcs',
            'diskon' => ($row['diskon'] == null ? 0 : $row['diskon']),
            'revenue' => ($row['revenue_gross_rp'] == null ? 0 : $row['revenue_gross_rp']),
        ]);
    }

    // use heading row
    public function headingRow(): int
    {
        return 7;
    }

    // batchinsert
    public function batchSize(): int
    {
        return 3000;
    }

    // validation
    public function rules(): array
    {
        return [
            'no_faktur' => 'required',
            // 'tanggal' => 'required|date',
            'code_item' => 'required',
            // 'harga' => 'required!numeric|between:0,9999999999999',
            // 'quantity' => 'required|numeric|between:0.00,999.99',
            // 'code_item' => 'required|exists:temp_item,internal_id',
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
