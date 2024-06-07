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
        //sales table
        if (!Schema::hasTable('ts_sales')) {
            Schema::create('ts_sales', function (Blueprint $table) {
                $table->integer('id')->primary()->nullable(false);
                $table->string('invoice_no', 20)->nullable(false);
                $table->mediumInteger('total_weight')->nullable(false);
                $table->bigInteger('shipping_fee')->nullable(false);
                $table->bigInteger('total_price')->nullable(false);
                $table->bigInteger('total_sale')->nullable(false);
                $table->string('user_code', 15)->nullable(false);
                $table->string('shipping_address', 250)->nullable(false);
                $table->timestamp('shipping_date')->nullable(true);
                $table->integer('expedition_id')->nullable(false);
                $table->string('shipping_type', 10)->nullable(false);
                $table->timestamp('sales_date')->nullable(true);
                $table->bigInteger('created_by')->nullable(false);
                $table->bigInteger('updated_by')->nullable(false);
                $table->timestamps();
            });
        }

        //detail sales table
        if (!Schema::hasTable('dt_sales')) {
            Schema::create('dt_sales', function (Blueprint $table) {
                $table->integer('id')->primary()->nullable(false);
                $table->integer('sales_id')->nullable(false);
                $table->integer('product_id')->nullable(false);
                $table->string('invoice_no', 20)->nullable(false);
                $table->mediumInteger('qty')->nullable(false);
                $table->mediumInteger('weight')->nullable(false);
                $table->bigInteger('unit_price')->nullable(false);
                $table->float('discount')->nullable(false);
                $table->bigInteger('price')->nullable(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ts_sales');
        Schema::dropIfExists('dt_sales');
    }
};
