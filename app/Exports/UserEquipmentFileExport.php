<?php

namespace App\Exports;

use App\Models\UserEquipment;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserEquipmentFileExport implements FromQuery, WithMapping, WithHeadings, Responsable
{
    use Exportable;

    private $fileName = 'user_equipment_files.xlsx';

    public function query()
    {
        return UserEquipment::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'User',
            'Department',
            'Position',
            'Admin',
            'Equipment',
            'Serial No.',
            'Date',
            'Return Date'
        ];
    }

    public function map($userItem): array
    {
        return [
            $userItem->user->id,
            $userItem->user->name,
            $userItem->user->department_name,
            $userItem->user->position->name,
            $userItem->admin->name,
            $userItem->equipment->name,
            $userItem->serialNumber->serial_number,
            $userItem->date,
            $userItem->return_date ?? '/',
        ];
    }

}
