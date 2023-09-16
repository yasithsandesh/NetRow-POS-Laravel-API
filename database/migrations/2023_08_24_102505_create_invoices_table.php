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
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('customer_mobile');
            $table->string('employee_email');
            $table->double("paid_amount");
            $table->double('discount');
            $table->unsignedBigInteger('payment_method_id');
            $table->timestamps();

            $table->foreign('customer_mobile')->references('mobile')->on('customers');
            $table->foreign('employee_email')->references('email')->on('employees');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
