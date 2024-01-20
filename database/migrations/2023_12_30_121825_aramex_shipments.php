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
        Schema::create('aramex_shipments', function (Blueprint $table) {
            $table->id();
            $table->string('aramex_id')->uniqid();
            $table->string('reference1')->nullable();
            $table->string('reference2')->nullable();
            $table->string('reference3')->nullable();
            $table->string('foreignHAWB')->nullable();
            $table->string('labelURL');
            $table->string('labelContents')->nullable();
            $table->string('status');
            $table->mediumText('shipmentDetails');
            $table->string('shipmentAttachments')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('aramex_shipments');
    }
};
