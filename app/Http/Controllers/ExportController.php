<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentExport;
use App\Exports\UserEquipmentFileByDepartmentExport;
use App\Exports\UserEquipmentFileByPositionExport;
use App\Exports\UserEquipmentFileBySelectedExport;
use App\Exports\UserEquipmentFileExport;
use App\Http\Requests\ExportUserEquipmentRequest;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportEquipment()
    {
        $this->authorize('manage', Equipment::class);

        return new EquipmentExport();
    }

    public function exportUserEquipment(ExportUserEquipmentRequest $request)
    {
        $this->authorize('viewAny', User::class);

        if ($userIds = $request->userIds) {
            return new UserEquipmentFileBySelectedExport($userIds);
        }

        if ($data = $request->groupExport) {
            if ($data === 'all') {
                return new UserEquipmentFileExport();
            }

            if (str_starts_with($data, 'department')) {
                return new UserEquipmentFileByDepartmentExport(explode(' ', $data)[1]);
            }

            if (str_starts_with($data, 'position')) {
                return new UserEquipmentFileByPositionExport(explode(' ', $data)[1]);
            }
        }
    }
}
