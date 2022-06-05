<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use DB;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $guarded = [];

    public static function getDataProduct()
    {
        $data = DB::table('product')
                ->select('*')
                ->orderByDesc('product_id')->get();
        foreach ($data as $key => $value) {
            $cdata = DB::select("
                SELECT a.*, b.category_identifier
                FROM product_to_category a
                LEFT JOIN category b on b.category_id = a.ptc_category_id
                WHERE a.ptc_product_id = " . $value->product_id . "
            ");
            $data_length = count($cdata);
            $temp_category = "";
            foreach ($cdata as $k => $v) {
                $temp_category .= $k != $data_length - 1 ? " " . $v->category_identifier . ", " : " " . $v->category_identifier;
            }
            $data[$key]->product_category = $temp_category;
        }
                
        return $data;
    }

    public static function saveData($data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            if (Product::create($data)) {
                $result = true;
            }
            DB::commit();
            return $result;
        } catch (QueryException $e) {
            DB::rollback();
            $get_last_id = $this->getLastId();
            if ($get_last_id != null || $get_last_id != 0) {
                $id = $get_last_id->product_id;
            } else {
                $id = 0;
            }
            $data['product_id'] = $id + 1;
            self::saveData($data);
            $result = false;
        }
    }

    public static function getLastId() {
        $last_id = Product::select('product_id')
                        ->orderByDesc('product_id')
                        ->first();
        if ($last_id != null) {
            $id = $last_id->product_id;
        } else {
            $id = 0;
        }

        return $id;
    }

    public static function checkProductIdentifier($product_identifier) {
        $result = true;
        $data = Product::select('product_id')
                    ->where('product_identifier', '=', $product_identifier)->get();
        if (isset($data->product_id)) {
            $result = false;
        }

        return $result;
    }
}
