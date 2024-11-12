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
        Schema::create('vendor_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->string('name');
            $table->string('code');
            $table->string('phone');
            $table->string('city');
            $table->string('country_code');
            $table->string('street_address');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('google_map_url');
            $table->decimal('lat', 11, 8);
            $table->decimal('long', 11, 8);

            $table->foreign('vendor_id')->references('id')->on('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_shipments');
    }
};
