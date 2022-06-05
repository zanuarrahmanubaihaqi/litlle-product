<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    public $guarded = [];

    public static function saveData($data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            if (Category::create($data)) {
                $result = true;
            }
            DB::commit();
            return $result;
        } catch (QueryException $e) {
            DB::rollback();
            $get_last_id = $this->getLastId();
            if ($get_last_id != null || $get_last_id != 0) {
                $id = $get_last_id->category_id;
            } else {
                $id = 0;
            }
            $data['category_id'] = $id + 1;
            self::saveData($data);
            $result = false;
        }
    }

    public static function getLastId() {
        $last_id = Category::select('category_id')
                        ->orderByDesc('category_id')
                        ->first();
        if ($last_id != null) {
            $id = $last_id->category_id;
        } else {
            $id = 0;
        }

        return $id;
    }
}
