<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseOrderRequest extends FormRequest
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
            'purchase_order.delivery_deadline' => 'required|date',
            'purchase_order.price' => 'required|integer',

            'comment.content' => 'nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'purchase_order.delivery_deadline' => 'delivery deadline',
            'purchase_order.price' => 'price',
            'comment.content' => 'comment',
        ];
    }
}
