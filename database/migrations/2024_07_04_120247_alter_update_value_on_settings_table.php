<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

return new class extends Migration
{
    public function __construct()
	{
		if (version_compare(Application::VERSION, '5.0', '>=')) {
			$this->tablename = Config::get('settings.table');
			$this->keyColumn = Config::get('settings.keyColumn');
			$this->valueColumn = Config::get('settings.valueColumn');
		} else {
			$this->tablename = Config::get('anlutro/l4-settings::table');
			$this->keyColumn = Config::get('anlutro/l4-settings::keyColumn');
			$this->valueColumn = Config::get('anlutro/l4-settings::valueColumn');
		}
	}
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->longText($this->valueColumn)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->longText($this->valueColumn)->change();
        });
    }
};
