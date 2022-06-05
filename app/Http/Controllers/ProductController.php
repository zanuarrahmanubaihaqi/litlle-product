<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Http\Requests\ProductRequest;
use App\ProductToCategory;
use DataTables;
use Faker\Provider\Lorem;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data_category = Category::All();
        
        return view('product.index', compact('data_category'));
    }

    public function getData()
    {
        return DataTables::of(Product::getDataProduct())->make(true);
    }

    public function store(ProductRequest $request)
    {
        $product_identifier = $request->product_identifier;
        $product_desc = $request->product_desc;
        $category = $request->category;
        $product_price = $request->product_price;
        $product_img = $request->file('the_img');
        $product_stock = $request->product_stock;
        $product_image_name = $product_img->getClientOriginalName();
        $message = "";

        if (!Product::checkProductIdentifier($product_identifier)) {
            $upload_proccess = $this->fileProcess($product_img);
            if($upload_proccess){
                $data_product = [
                    'product_identifier' => $product_identifier,
                    'product_desc' => $product_desc,
                    'product_price' => $product_price,
                    'product_stock' => $product_stock,
                    'product_image_name' => $product_image_name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                Product::saveData($data_product);
    
                for ($i = 0; $i < count($category); $i++) { 
                    $data_ptc = [
                        'ptc_product_id' => Product::getLastId(),
                        'ptc_category_id' => $category[$i],
                    ];
    
                    ProductToCategory::saveData($data_ptc);
                }
    
                $message = "success add data";
            } else {
                $message = "failed add data, upload is fail";
            }
        } else {
            $message = "product is added before";
        }

        return redirect()->route('product.index')->with('message', $message);
    }

    public function fileProcess($file)
    {
        $location = "uploads";
        $result = false;
        $file_name = $file->getClientOriginalName();
        
        if ($file->move($location, $file_name)) {
            $result = true;
        }

        return $result;
    }
}
