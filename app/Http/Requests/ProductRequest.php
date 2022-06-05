<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_identifier' => 'required',
            'product_desc' => 'required',
            'category' => 'required',
            'product_price' => 'required',
            'product_stock' => 'required',
            'the_img' => 'required'
        ];
    }

    public function messages()
    {
        $messages = [
            'product_identifier.required' => 'Nama produk wajib diisi',
            'product_desc.required' => 'Deskripsi wajib diisi',
            'category.required' => 'Kategori wajib diisi',
            'product_price.required' => 'Harga wajib diisi',
            'product_stock.required' => 'Stok wajib diisi',
            'the_img.required' => 'Gambar wajib diisi'
        ];

        return $messages;
    }
}
