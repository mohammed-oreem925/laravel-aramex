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
            $table->string('test_username')->nullable();
            $table->string('test_password')->nullable();
            $table->renameColumn('username', 'live_username');
            $table->renameColumn('password', 'live_password');
            $table->unsignedBigInteger('delivery_service_id')->nullable();
            $table->unsignedBigInteger('merchnat_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aramex_credentials', function (Blueprint $table) {
            $table->dropColumn('test_username');
            $table->dropColumn('test_password');
            $table->renameColumn('live_username', 'username');
            $table->renameColumn('live_password', 'password');
            $table->dropColumn('delivery_service_id');
        });
    }
};
