<?php

namespace App\Exports;

use App\Models\UserEquipment;

class UserEquipmentFileBySelectedExport extends UserEquipmentFileExport
{
    private $userIds;

    public function __construct(array $userIds)
    {
        $this->userIds = $userIds;
    }

    public function query()
    {
        return UserEquipment::query()->whereHas('user', function ($q) {
            $q->whereIn('id', $this->userIds);
        });
    }
}
