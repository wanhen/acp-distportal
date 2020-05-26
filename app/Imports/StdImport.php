<?php

namespace App\Imports;

use App\Models\StdUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;


class StdImport implements ToModel, 
WithHeadingRow, 
WithCalculatedFormulas, 
WithValidation, 
WithBatchInserts, 
WithChunkReading, 
WithMultipleSheets
{

    use Importable;
    public $period = null;
    
    public function model(array $row)
    {
        // dd($row);
        
        ini_set('max_execution_time', 14000);
        return new \App\Models\UploadStd([
            'month' => $row['month'],
            'week' => $row['week'],
            'date' => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date'])),
            'item_code' => $row['internal_id'],
            'cust_id' => $row['customerproject_internal_id'],
            'trans_type' => $row['type'],
            'qty' => ($row['qty_sold'] == null ? 0 : $row['qty_sold']),
            'unit' => $row['purchase_unit_units'],
            'item_name_old' => $row['item_display_name_old'],
            'cust_name' => $row['customerproject_company_name'],
            'cust_category' => $row['customerproject_customer_category'],
            'brand' => $row['item_parent_class'],
            'subbrand' => $row['class_name'],
            'salesperson' => $row['primary_sales_rep'],
            'item_name' => $row['item_display_name'],
            'amount' => ($row['amount'] == null ? 0 : $row['amount']),
            'amount_gross' => ($row['amount_gross'] == null ? 0 : $row['amount_gross']),
            'discount' => ($row['discount_total'] == null ? 0 : $row['discount_total']),
            'address' => $row['address_shipping_address_line_1'],
            'cust_type' => $row['customerproject_line_customer_type'],
            'document_number' => $row['document_number'],
            'kota' => $row['kota'],
            'provinsi' => $row['propinsi'],
            'nama_toko_pusat' => $row['customerproject_nama_toko_pusat'],
            'nama_pasar' => $row['customerproject_pasar'],
            'cust_category_sub' => $row['customerproject_sub_category_cbs'],
            'regional' => $row['customerproject_regional'],
            'area' => $row['customerproject_area'],
        ]);
    }

    // use heading row
    public function headingRow(): int
    {
        return 1;
    }

    // batchinsert
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    // validation
    public function rules(): array
    {
        return [
            // 'no_faktur' => 'required',
            // 'tanggal' => 'required|date',
            // 'code_item' => 'required',
            // 'harga' => 'required!numeric|between:0,9999999999999',
            // 'quantity' => 'required|numeric|between:0.00,999.99',
            // 'code_item' => 'required|exists:temp_item,internal_id',
            // https://stackoverflow.com/questions/29183075/validation-check-if-1-equal-to-some-value-from-database-laravel-5/41040414
            
        ];
    }

    // only sheet 1
    public function sheets(): array
    {
        // return [
        //     0 => $this,
        // ];
        return [
            'Sheet1' => $this,
            // 'Sheet2' => new SecondSheetImport(),
        ];
    }

   
}
