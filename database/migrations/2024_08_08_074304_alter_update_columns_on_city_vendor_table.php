<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('city_vendor', function (Blueprint $table) {
            // // Drop the index only if it exists
            // if (Schema::hasColumn('city_vendor', 'vendor_has_fast_shipping'))
            // {
            //     $table->dropUnique(['vendor_has_fast_shipping']);
            //     $table->dropColumn('vendor_has_fast_shipping');
            // }
            // // Drop the other column and add soft deletes
            // $table->dropColumn('vendor_has_fast_shipping');
            // $table->dropColumn('shipping_price');
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('city_vendor', function (Blueprint $table) {
            $table->boolean('vendor_has_fast_shipping')->nullable();
            $table->decimal('shipping_price', 8, 2)->nullable();
            $table->dropSoftDeletes();
        });
    }
};