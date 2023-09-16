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
        Schema::create('grns', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('supplier_mobile');
            $table->string('employee_email');
            $table->double('paid_amount');
            $table->timestamps();

            $table->foreign('supplier_mobile')->references('mobile')->on('suppliers');
            $table->foreign('employee_email')->references('email')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grns');
    }
};
