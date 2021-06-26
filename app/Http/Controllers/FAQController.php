<?php

namespace App\Http\Controllers;

use App\Http\Requests\FAQRequest;
use App\Models\EquipmentCategory;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function store(FAQRequest $request, EquipmentCategory $equipmentCategory)
    {
        $this->authorize('manage', EquipmentCategory::class);

        $equipmentCategory->faq()->create($request->validated());

        return redirect()->back()->with('success_message', 'FAQ created successfully.');
    }

    public function update(FAQRequest $request, FAQ $faq)
    {
        $this->authorize('manage', EquipmentCategory::class);

        $faq->update($request->validated());

        return redirect()->back()->with('success_message', 'FAQ updated successfully.');
    }

    public function destroy(FAQ $faq)
    {
        $this->authorize('manage', EquipmentCategory::class);

        $faq->delete();

        return redirect()->back()->with('success_message', 'FAQ deleted successfully.');
    }
}
