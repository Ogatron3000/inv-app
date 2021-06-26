<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\EquipmentTicket;
use App\Models\OfficeSuppliesTicket;
use App\Models\PurchaseOrder;
use App\Models\RepairTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $notifications = auth()->user()->unreadNotifications;

        if ($user->isSuperAdmin()) {
            $categories = EquipmentCategory::whereHas('equipmentInStock')->with('equipment')->get();

            return view('home.super_admin', compact('categories', 'notifications'));
        }

        if ($user->isAdministration() || $user->isSupport()) {
            // https://stackoverflow.com/a/34873643/13262365
            $ticketGroups = Ticket::whereIn('ticketable_type',
                $user->isSupport() ? [
                    EquipmentTicket::class,
                    RepairTicket::class,
                ] : [OfficeSuppliesTicket::class])
                ->open()->take(10)->get()->groupBy('status');

            return view('home.admin', compact('ticketGroups', 'notifications'));
        }

        if ($user->isHR()) {
            // https://stackoverflow.com/a/34873643/13262365
            $purchaseOrderGroups = PurchaseOrder::take(10)->get()
                ->groupBy(function ($item, $key) {
                    return $item['is_approved'] === '/' ? 'open' : 'closed';
                })->reverse();

            return view('home.hr', compact('purchaseOrderGroups', 'notifications'));
        }

        if ($user->isRegularUser()) {
            $ticketTypes = Ticket::TICKET_TYPES;

            return view('home.user', compact('user', 'notifications', 'ticketTypes'));
        }
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
