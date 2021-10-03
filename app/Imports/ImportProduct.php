<?php

namespace App\Imports;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportProduct implements OnEachRow,WithStartRow
{
    public function __construct()
    {

    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();
        if (!isset($row[0]) || !isset($row[1]) || !isset($row[3]) || !isset($row[7]) || !isset($row[8]) || !isset($row[9])) {
            return null;
        }
        $category_name = $row[8];
        $category = Category::where('name', $category_name)->first();
        if($category == null)
            return null;
        $discount_price = $row[4];
        $cost_price = isset($row[2])?$row[2]:0;
        $selling_price = $row[3];
        $calc_price = $discount_price?$discount_price:$selling_price;
        $earning = $calc_price - $cost_price;
        $percentage_margin = $earning*100/$cost_price;

        if($discount_price && !$row[5])
            return null;
        if($discount_price && !$row[6])
            return null;
        $discount_price = $discount_price?$discount_price:0;
        $discount_start_date = $row[5];
        $discount_end_date = $row[6];
        if($discount_start_date && strpos($discount_start_date, '/') !== false){
            $val = explode("/", $discount_start_date);
            $discount_start_date = $val[2]."-".$val[0]."-".$val[1];
        }
        if($discount_end_date && strpos($discount_end_date, '/') !== false){
            $val = explode("/", $discount_end_date);
            $discount_end_date = $val[2]."-".$val[0]."-".$val[1];
        }

        $data = [
            'name' => $row[0],
            'description' => $row[1],
            'cost_price' => $row[2],
            'selling_price' => $row[3],
            'discount_price' => $discount_price,
            'discount_start_date' => $discount_start_date,
            'discount_end_date' => $discount_end_date,
            'stock_quantity' => $row[7],
            'category_id' => $category->id,
            'percentage_margin' => $percentage_margin,
            'status' => $row[9]=="Active"?1:0
        ];

        $new_product = Product::create($data);

        if($new_product){
            $attach = [
                'attach_id' => $new_product->id,
                'type' => 'product_image',
                'url' => asset('images/product/new-product.jpg')
            ];

            Attachment::create($attach);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public static function afterImport(AfterImport $event){
        dd($event);
    }
}
