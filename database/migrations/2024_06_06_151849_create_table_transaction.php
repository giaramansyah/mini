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
        //transaction table
        if (!Schema::hasTable('ts_transactions')) {
            Schema::create('ts_transactions', function (Blueprint $table) {
                $table->integer('id')->primary()->nullable(false);
                $table->string('invoice_no', 20)->nullable(false);
                $table->mediumInteger('total_weight')->nullable(false);
                $table->bigInteger('shipping_fee')->nullable(false);
                $table->bigInteger('total_price')->nullable(false);
                $table->string('user_code', 15)->nullable(false);
                $table->integer('user_id')->nullable(false);
                $table->string('shipping_address', 250)->nullable(false);
                $table->timestamp('shipping_date')->nullable(false);
                $table->integer('expedition_id')->nullable(false);
                $table->string('shipping_type', 10)->nullable(false);
                $table->timestamp('transaction_date')->nullable(true);
                $table->bigInteger('created_by')->nullable(false);
                $table->bigInteger('updated_by')->nullable(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ts_transactions');
    }
};
