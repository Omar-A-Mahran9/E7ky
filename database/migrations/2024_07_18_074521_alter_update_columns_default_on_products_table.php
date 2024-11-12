<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('price')->nullable();
            $table->double('size')->nullable() ;
            $table->double('weight')->nullable() ;
            $table->dropUnique(['name_ar']);
            $table->dropUnique(['name_en']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('price')->nullable()->change();
            $table->double('size')->nullable()->change();
            $table->double('weight')->nullable()->change();
            $table->dropUnique(['name_ar']);
            $table->dropUnique(['name_en']);
        });
    }
};