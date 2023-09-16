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
        Schema::create('grn_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->double('qty');
            $table->double('buying_price');
            $table->string('grn_id');
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stocks');
            $table->foreign('grn_id')->references('id')->on('grns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grn_items');
    }
};
