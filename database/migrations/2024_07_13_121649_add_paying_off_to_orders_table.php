<?php

use App\Enums\PayingOffStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('paying_off')->after('status')->comment('App\Enums\PayingOffStatus')->default(PayingOffStatus::cashOnDelivery->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('paying_off')->after('status')->comment('App\Enums\PayingOffStatus')->default(PayingOffStatus::cashOnDelivery->value);
        });
    }
};
