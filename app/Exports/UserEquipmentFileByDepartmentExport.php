<?php

namespace App\Exports;

use App\Models\UserEquipment;

class UserEquipmentFileByDepartmentExport extends UserEquipmentFileExport
{
    private $department;

    public function __construct(int $department)
    {
        $this->department = $department;
    }

    public function query()
    {
        return UserEquipment::query()->whereHas('user', function ($q) {
            $q->whereHas('position', function ($q) {
                $q->whereHas('department', function ($q) {
                    $q->where('id', $this->department);
                });
            });
        });
    }
}
