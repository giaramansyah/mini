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
        //ticket table
        if (!Schema::hasTable('ts_tickets')) {
            Schema::create('ts_tickets', function (Blueprint $table) {
                $table->id();
                $table->string('ticket_code', 10)->nullable(false);
                $table->timestamp('ticket_date')->nullable(false);
                $table->integer('customer_id')->nullable(false);
                $table->string('subject', 20)->nullable(false);
                $table->string('product_id', 10)->nullable(false);
                $table->string('issue', 250)->nullable(false);
                $table->bigInteger('created_by')->nullable(false);
                $table->bigInteger('updated_by')->nullable(false);
                $table->timestamps();
            });
        }

        //detail ticket table
        if (!Schema::hasTable('dt_tickets')) {
            Schema::create('dt_tickets', function (Blueprint $table) {
                $table->id();
                $table->integer('ticket_id')->nullable(false);
                $table->string('status', 20)->nullable(false);
                $table->string('user_id', 10)->nullable(false);
                $table->timestamp('update_date')->nullable(true);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ts_tickets');
        Schema::dropIfExists('dt_tickets');
    }
};
