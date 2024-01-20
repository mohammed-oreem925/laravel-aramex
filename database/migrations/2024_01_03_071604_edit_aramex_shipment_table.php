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
            $table->mediumText('shipments');
            $table->mediumText('shipment_details_response');
            $table->string('pickupGUID')->nullable();
        });

        DB::statement('UPDATE aramex_shipments SET shipment_details_response = shipmentDetails');

        Schema::table('aramex_shipments', function (Blueprint $table) {
            $table->dropColumn('shipmentDetails');
        });
    }

    public function down(): void
    {
        Schema::table('aramex_shipments', function (Blueprint $table) {
            $table->dropColumn('pickupGUID');
            $table->mediumText('shipmentDetails');
        });

        DB::statement('UPDATE aramex_shipments SET shipmentDetails = shipment_details_response');

        Schema::table('aramex_shipments', function (Blueprint $table) {
            $table->dropColumn('shipment_details_response');
            $table->dropColumn('shipments');
        });
    }
};
