<?php

namespace App\Http\Requests;

use App\Models\PurchaseOrder;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
        $commentableTypes = [
            Ticket::class,
            PurchaseOrder::class,
        ];

        return [
            'content' => 'required|string',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|in:' . implode(',', array_values($commentableTypes)),
        ];
    }
}
