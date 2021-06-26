<?php

namespace App\Exports;

use App\Models\Equipment;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class EquipmentExport implements FromQuery, WithMapping, WithHeadings, Responsable, WithStrictNullComparison
{
    use Exportable;

    private $fileName = 'equipment.xlsx';

    public function query()
    {
        return Equipment::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'Equipment',
            'Category',
            'Users',
            'Users No.',
            'Available Quantity',
            'Total Quantity',
        ];
    }

    public function map($equipment): array
    {
        $availableQuantity = $equipment->available_quantity;
        $usersArr = $equipment->userEquipment()->whereNull('return_date')->get()->pluck('user.name')->toArray();
        $usersCount = count($usersArr);
        $usersCSV = $usersCount ? implode(', ', $usersArr) : '/';

        return [
            $equipment->id,
            $equipment->name,
            $equipment->category->name,
            $usersCSV,
            $usersCount,
            $availableQuantity,
            $availableQuantity + $usersCount,
        ];
    }
}
