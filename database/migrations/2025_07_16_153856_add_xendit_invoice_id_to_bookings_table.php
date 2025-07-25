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
       Schema::table('bookings', function (Blueprint $table) {
            $table->string('xendit_invoice_id')->nullable()->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('xendit_invoice_id');
        });
    }
};
