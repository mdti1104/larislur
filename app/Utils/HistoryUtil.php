<?php
namespace App\Utils;

use DB;
class HistoryUtil extends Util
{

    public function createhistory($data)
    {
        try {
            $history = DB::table('history_report')->insertGetId($data);

        } catch (\Throwable $th) {
            dd($th);
        }
        return $history;
    }
    public function quantity_stock($id,$qty,$location_id,$status)
    {
        if ($location_id != '') {
            $history =  DB::table('history_report')->where('id_product',(int) $id)->where('location_id',$location_id)->get();
        }else{
         $history =  DB::table('history_report')->where('id_product',(int) $id)->get();
        }
        if (!empty($history)) {
            $qty_stock = 0;
            foreach ($history as $key => $value) {
                if ($value->status == 'in') {
                    $qty_stock += $value->quantity_availible;
                }else if($value->status == 'out'){
                    $qty_stock -= $value->quantity_availible;
                }
            }
            $qty = ($status == 'in' ? $qty_stock + $qty : $qty_stock - $qty);

            return ($qty < 1 ? 0 : $qty );
        }else{
            return $qty;
        }

        
    }
  
}
    
