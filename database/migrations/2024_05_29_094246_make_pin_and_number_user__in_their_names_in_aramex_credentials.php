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
        Schema::table('aramex_credentials', function (Blueprint $table) {
            $table->renameColumn('testNumber', 'test_number');
            $table->renameColumn('testPin', 'test_pin');
            $table->renameColumn('liveNumber', 'live_number');
            $table->renameColumn('livePin', 'live_pin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aramex_credentials', function (Blueprint $table) {
            $table->renameColumn('test_number', 'testNumber');
            $table->renameColumn('test_pin', 'testPin');
            $table->renameColumn('live_number', 'liveNumber');
            $table->renameColumn('live_pin', 'livePin');
        });
    }
};
