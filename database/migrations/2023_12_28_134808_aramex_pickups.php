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
        Schema::create('aramex_pickups', function (Blueprint $table) {
            $table->id();
            $table->string('aramex_id')->uniqid();
            $table->string('guid');
            $table->string('reference1');
            $table->string('reference2')->nullable();
            $table->string('status');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aramex_pickups');
    }
};
