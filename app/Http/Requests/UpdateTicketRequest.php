<?php

namespace App\Http\Requests;

use App\Models\EquipmentTicket;
use App\Models\OfficeSuppliesTicket;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'equipment_category_id' => 'sometimes|required|integer|exists:equipment_categories,id',
            'office_item' => 'sometimes|required|string',
            'quantity' => 'sometimes|required|integer',
            'equipment_id' => 'sometimes|required|integer|exists:equipment,id',
        ];
    }
}
