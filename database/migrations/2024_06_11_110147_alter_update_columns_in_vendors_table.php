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
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('description_ar')->nullable()->change();
            $table->string('description_en')->nullable()->change();
            $table->string('commercial_register')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('logo')->nullable()->change();
            $table->string('cover')->nullable()->change();
            $table->string('licensure')->nullable()->change();
            $table->tinyInteger('approved')->comment('VendorStatusEnum Class')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('description_ar')->nullable(false)->change();
            $table->string('description_en')->nullable(false)->change();
            $table->string('commercial_register')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('logo')->nullable(false)->change();
            $table->string('cover')->nullable(false)->change();
            $table->string('licensure')->nullable(false)->change();
            $table->boolean('approved')->change();
        });
    }
};
