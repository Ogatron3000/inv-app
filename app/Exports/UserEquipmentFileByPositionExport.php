<?php

namespace App\Exports;

use App\Models\UserEquipment;

class UserEquipmentFileByPositionExport extends UserEquipmentFileExport
{
    private $position;

    public function __construct(int $position)
    {
        $this->position = $position;
    }

    public function query()
    {
        return UserEquipment::query()->whereHas('user', function ($q) {
            $q->whereHas('position', function ($q) {
                $q->where('id', $this->position);
            });
        });
    }
}
