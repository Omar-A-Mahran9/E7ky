<?php

use App\Enums\CustomerStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('google_link_acc')->nullable();
            $table->string('facebook_link_acc')->nullable();
            $table->string('status')->default('pending')->comment('App\Enums\CustomerStatus');
            $table->string('X_link')->nullable();
            $table->string('email')->unique();
            $table->text('job_description')->nullable(); // Job description of the talker
            $table->text('bio')->nullable(); // Short biography of the talker
            $table->string('image')->nullable(); // URL or path to the profile picture
            $table->string('cover_picture')->nullable(); // URL or path to the profile picture            $table->string('email')->unique();
            $table->date('birth_date')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->enum('gender', ['male', 'female'])->nullable(); // Define enum and make it unique
            $table->enum('type', ['speaker', 'customer'])->default('customer'); // Enum to distinguish between speaker and customer
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('block_flag')->default(0);
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
