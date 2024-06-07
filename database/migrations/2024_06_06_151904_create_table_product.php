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
        //product table
        if (!Schema::hasTable('ms_products')) {
            Schema::create('ms_products', function (Blueprint $table) {
                $table->integer('id')->primary()->nullable(false);
                $table->integer('category_id')->nullable(false);
                $table->string('name', 50)->nullable(false);
                $table->mediumInteger('weight')->nullable(false);
                $table->bigInteger('price')->nullable(false);
                $table->mediumInteger('stock')->nullable(false);
                $table->bigInteger('sale')->nullable(false);
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
        Schema::dropIfExists('ms_products');
    }
};
