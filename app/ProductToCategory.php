<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductToCategory extends Model
{
    protected $table = 'product_to_category';
    protected $primaryKey = 'ptc_id';
    public $guarded = [];
    public $timestamps = false;

    protected $fillable = [
        'ptc_id',
        'ptc_product_id',
        'ptc_category_id'
    ];

    public static function saveData($data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            if (ProductToCategory::create($data)) {
                $result = true;
            }
            DB::commit();
            return $result;
        } catch (QueryException $e) {
            DB::rollback();
            $get_last_id = $this->getLastId();
            if ($get_last_id != null || $get_last_id != 0) {
                $id = $get_last_id->ptc_id;
            } else {
                $id = 0;
            }
            $data['ptc_id'] = $id + 1;
            self::saveData($data);
            $result = false;
        }
    }

    public static function getLastId() {
        $last_id = ProductToCategory::select('ptc_id')
                        ->orderByDesc('ptc_id')
                        ->first();
        if ($last_id != null) {
            $id = $last_id->ptc_id;
        } else {
            $id = 0;
        }

        return $id;
    }
}
