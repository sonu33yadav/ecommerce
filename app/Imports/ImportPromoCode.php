<?php

namespace App\Imports;

use App\Models\PromoCode;
use App\Models\PromoPrimaryType;
use App\Models\PromoSecondaryType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportPromoCode implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        if (!isset($row[0]) || !isset($row[1]) || !isset($row[2]) || !isset($row[5]) || !isset($row[6]) || !isset($row[7]) || !isset($row[8]) || !isset($row[9])) {
            return null;
        }
        $pCode = $row[0];
        $exist = PromoCode::where('code', $pCode)->first();
        if($exist)
            return null;

        $data = array();
        $data['code'] = $row[0];
        $pType = PromoPrimaryType::where('type_name', $row[1])->first();
        if($pType){
            $data['primary_type'] = $pType->id;
            $data['amount'] = $row[2];
            if(isset($row[3]) && $row[3] && isset($row[4]) && $row[4]){
                $sType = PromoSecondaryType::where('type_name',$row[3])->first();
                if($sType){
                    $data['secondary_type'] = $sType->id;
                    $data['secondary_info'] = $row[4];
                }else{
                    $data['secondary_type'] = null;
                    $data['secondary_info'] = null;
                }
            }

            $start_date = $row[5];
            if($start_date && strpos($start_date, '/') !== false){
                $val = explode("/", $start_date);
                $start_date = $val[2]."-".$val[0]."-".$val[1];
            }
            $end_date = $row[6];
            if($end_date && strpos($end_date, '/') !== false){
                $val = explode("/", $end_date);
                $end_date = $val[2]."-".$val[0]."-".$val[1];
            }
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['desc'] = $row[7];
            $data['limit'] = $row[8];
            if($row[9] == "TRUE" || $row[9] == "true"){
                $data['enable_member_limit'] = 1;
            }else{
                $data['enable_member_limit'] = 0;
            }

            return new PromoCode($data);
        }else
            return null;
    }

    public function startRow(): int
    {
        return 2;
    }
}
