<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_reasons', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Refund', 'Cancel']); // 'cancellation' or 'return'
            $table->string('reason_ar');
            $table->string('reason_en');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_reasons');
    }
};