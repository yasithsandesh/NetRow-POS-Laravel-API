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
        Schema::create('employees', function (Blueprint $table) {
            $table->string("email",100)->primary();
            $table->string("fname",50);
            $table->string("lname",50);
            $table->string("nic",20);
            $table->string("mobile",10);
            $table->string("password",45);
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('employee_id')->references('id')->on('employee_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
