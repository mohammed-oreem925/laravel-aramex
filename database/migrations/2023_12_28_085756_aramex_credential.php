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
        Schema::create('aramex_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('country_code');
            $table->string('entity');
            $table->string('testNumber')->nullable();
            $table->string('testPin')->nullable();
            $table->string('liveNumber')->nullable();
            $table->string('livePin')->nullable();
            $table->boolean('isTest')->default(true);
            $table->foreignId('user_id')->constrained();
            $table->boolean('active')->default(true);
            $table->boolean('enable_local_log')->default(false);
            $table->boolean('enable_db_log')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aramex_credentials');
    }
};
