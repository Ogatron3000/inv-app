<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EquipmentCategoryController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserEquipmentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\SerialNumberController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/mark-as-read', [HomeController::class, 'markNotification'])->name('markNotification');

    Route::get('users/autocomplete', [UserController::class, 'autocomplete'])->name('users.autocomplete');
    Route::resource('/users', UserController::class);

    Route::post('/user-equipment/{user}', [UserEquipmentController::class, 'store']);
    Route::put('/user-equipment/return/{user_equipment}', [UserEquipmentController::class, 'update']);

    Route::resource('/equipment', EquipmentController::class);
    Route::get('/serial-numbers-by-equipment/{equipment}', [EquipmentController::class, 'serial_numbers']);

    Route::get('/export/equipment', [ExportController::class, 'exportEquipment'])->name('export.equipment');
    Route::post('/export/user-equipment', [ExportController::class, 'exportUserEquipment'])->name('export.user_equipment');

    Route::post('/equipment/{equipment}/serial-numbers', [SerialNumberController::class, 'store'])->name('serial_numbers.store');
    Route::put('/equipment/{equipment}/serial-numbers/{serial_number}', [SerialNumberController::class, 'update'])->name('serial_numbers.update');
    Route::delete('/equipment/{equipment}/serial-numbers/{serial_number}', [SerialNumberController::class, 'destroy'])->name('serial_numbers.destroy');

    Route::resource('/tickets', TicketController::class);
    Route::put('/tickets/{ticket}/manage', [TicketController::class, 'manage'])->name('tickets.manage');
    Route::put('/tickets/{ticket}/release', [TicketController::class, 'release'])->name('tickets.release');
    Route::put('/tickets/{ticket}/approve', [TicketController::class, 'approve'])->name('tickets.approve');
    Route::put('/tickets/{ticket}/reject', [TicketController::class, 'reject'])->name('tickets.reject');
    Route::get('/equipment-by-ticket/{ticket}', [TicketController::class, 'equipment']);

    Route::get('/tickets/{ticket}/purchase-orders/create', [PurchaseOrderController::class, 'create'])->name('purchase-orders.create');
    Route::post('/tickets/{ticket}/purchase-orders', [PurchaseOrderController::class, 'store'])->name('purchase-orders.store');
    Route::resource('/purchase-orders', PurchaseOrderController::class)->except('create', 'store');
    Route::put('/purchase-orders/{purchase_order}/approve', [PurchaseOrderController::class, 'approve'])->name('purchase-orders.approve');
    Route::put('/purchase-orders/{purchase_order}/reject', [PurchaseOrderController::class, 'reject'])->name('purchase-orders.reject');

    Route::resource('/equipment-categories', EquipmentCategoryController::class);
    Route::post('/equipment-categories/{equipment_category}/faq', [FAQController::class, 'store'])->name('faq.store');
    Route::resource('/faq', FAQController::class)->only('update', 'destroy');

    Route::resource('/roles', RoleController::class);
    Route::resource('/positions', PositionController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::get('/positions-by-department/{department}', [DepartmentController::class, 'positions']);

    Route::resource('/comments', CommentController::class);
});
