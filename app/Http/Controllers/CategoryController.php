<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;
use App\ProductToCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::All();

        return view('category.index', compact('data'));
    }

    public function store(CategoryRequest $request)
    {
        $category_identifier = $request->category_identifier;
        $category_status_active = $request->category_status_active;
        $message = "";

        $data = [
            'category_identifier' => $category_identifier,
            'category_status_active' => $category_status_active,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $message = Category::saveData($data) ? "success add data" : "failed add data";

        return redirect()->route('category.index')->with('message', $message);

    }

    public function update(Request $request)
    {
        $category_identifier = $request->edit_identifier;
        $category_status_active = $request->edit_status;
        $category_id = $request->edit_id;
        $message = "";

        $data = [
            'category_identifier' => $category_identifier,
            'category_status_active' => $category_status_active,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data_category = Category::where('category_id', '=', $category_id);
        $message = $data_category->update($data) ? "success update data" : "failed update data";

        return redirect()->route('category.index')->with('message', $message);
    }

    public function delete(Request $request)
    {
        $category_id = $request->edit_id;

        $data_category = Category::where('category_id', '=', $category_id);
        $status = $data_category->forceDelete() ? 1 : 0;

        if ($status == 1) {
            $message = "success delete data";
            $data_ptc = ProductToCategory::where('ptc_category_id', '=', $category_id);
            $message = $data_ptc->forceDelete() ? "success delete data" : "failed delete data";
        } else {
            $message = "failed delete data";
        }

        return redirect()->route('category.index')->with('message', $message);
    }
}
