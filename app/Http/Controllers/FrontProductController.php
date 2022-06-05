<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontProductController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $product = Product::All();

        return view('iproduct', compact('product'));
    }
}
