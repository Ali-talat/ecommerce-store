<?php

namespace App\Http\Requests;

use App\Rules\ProductQty;
use Illuminate\Foundation\Http\FormRequest;

class productStockRequest extends FormRequest
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
            'sku'=>'nullable',
            'manage_stock'=>'nullable|in:0,1',
            'in_stock'=>'required|in:0,1',
            // 'qty'=>'required_if:manage_stock,==,1'
            'qty'=> [new ProductQty($this->manage_stock)]
         
        ];
    }
}
