<?php

namespace Modules\Connector\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);
        $return = [];
        foreach ($array['product_variations'] as $key => $value) {
            foreach ($value['variations'] as $k => $v) {
                $return['id'] = $array['id'];
                $return['sku'] = $v['sub_sku'];
                $return['images'] = $array['image_url'];

                $return['purchasePrice'] = $v['default_purchase_price'];
                $return['desc'] = '';

                if ($value['is_dummy']) {
                   $return['name'] = $array['name'];
                }else{
                   $return['name'] = $array['name'] .' - '.$v['name'];
                }

               if (isset($v['group_prices'])) {
                    $return['sellingPrice'] = $v['group_prices'];
                }else{
                    $return['sellingPrice'] = $v['sell_price_inc_tax'];
                }
            }
        }


        return $return;
    }

    private function __excludeFields(){
        return [
            'created_at',
            'updated_at',
            'brand_id',
            'unit_id',
            'category_id',
            'sub_category_id',
            'tax',
            'tax_type',
        ];
    }
}
