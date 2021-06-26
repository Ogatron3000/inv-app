<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('equipment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('serial_number_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->timestamp('date');
            $table->timestamp('return_date')->nullable();
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
        Schema::dropIfExists('user_equipment');
    }
}
