<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('officer_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate(); // officer that sends the requests
            $table->foreignId('hr_officer_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate(); // hr officer that approves/rejects the request
            $table->timestamp('delivery_deadline');
            $table->integer('price');
            $table->boolean('is_approved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}
