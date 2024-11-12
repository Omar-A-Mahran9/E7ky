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
            // $table->double('size')->nullable()->change();
            // $table->double('weight')->nullable()->change();
            // $table->unsignedBigInteger('design_type_id')->after('brand_id');
            // $table->foreign('design_type_id')->references('id')->on('design_types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->double('size')->nullable(false)->change();
            // $table->double('weight')->nullable(false)->change();
            // $table->unsignedBigInteger('design_type_id');
            // $table->foreign('design_type_id')->references('id')->on('design_types');

        });
    }
};
