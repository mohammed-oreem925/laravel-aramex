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
        Schema::table('aramex_shipments', function (Blueprint $table) {
            $table->longText('labelContents')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('aramex_shipments', function (Blueprint $table) {
            $table->string('labelContents')->nullable()->change();
        });
    }
};
