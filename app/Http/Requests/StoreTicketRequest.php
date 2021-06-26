<?php

namespace App\Http\Requests;

use App\Models\EquipmentTicket;
use App\Models\HrItemRequest;
use App\Models\OfficeSuppliesTicket;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'ticket_type.name' => 'required|string|in:' . implode(',', array_values(Ticket::TICKET_TYPES)),

            'ticket_data.equipment_category_id' => 'required_if:ticket_type.name,' . Ticket::EQUIPMENT_TICKET . '|integer|exists:equipment_categories,id',

            'ticket_data.office_item' => 'required_if:ticket_type.name,' . Ticket::OFFICE_SUPPLIES_TICKET . '|string|max:255',
            'ticket_data.quantity' => 'required_if:ticket_type.name,' . Ticket::OFFICE_SUPPLIES_TICKET . '|integer',

            'ticket_data.equipment_id' => 'required_if:ticket_type.name,' . Ticket::REPAIR_TICKET . '|integer|exists:equipment,id',

            // comment is only required with repair ticket
            'comment.content' => 'required_if:ticket_type.name,' . Ticket::REPAIR_TICKET . '|nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'ticket_data.equipment_category_id' => 'equipment category',
            'ticket_data.office_item' => 'office item',
            'ticket_data.quantity' => 'quantity',
            'comment.content' => 'comment',
        ];
    }

    public function messages()
    {
        return [
            'ticket_data.equipment_category_id.required_if' => 'The equipment category field is required.',
            'ticket_data.office_item.required_if' => 'The office item field is required.',
            'ticket_data.quantity.required_if' => 'The quantity field is required.',
            'ticket_data.equipment_id.required_if' => 'The equipment field is required.',
            'comment.content.required_if' => 'The comment field is required.',
        ];
    }

}
