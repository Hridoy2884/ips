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
        Schema::table('orders', function (Blueprint $table) {
        if (!Schema::hasColumn('orders', 'transaction_id')) {
            $table->string('transaction_id')->nullable()->after('payment_method');
        }
        if (!Schema::hasColumn('orders', 'payment_status')) {
            $table->string('payment_status')->default('pending')->after('transaction_id');
        }
        if (!Schema::hasColumn('orders', 'payment_proof')) {
            $table->string('payment_proof')->nullable()->after('payment_status');
        }
        if (!Schema::hasColumn('orders', 'advance_amount')) {
            $table->decimal('advance_amount', 10, 2)->default(0)->after('grand_total');
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['transaction_id', 'payment_status', 'payment_proof', 'advance_amount']);
    });
    }
};
