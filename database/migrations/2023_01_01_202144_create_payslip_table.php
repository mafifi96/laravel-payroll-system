<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslip', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("present")->comment("days");
            $table->tinyInteger("absent")->comment("days");
            $table->decimal("allowances");
            $table->decimal("deductions");
            $table->decimal("salary");
            $table->decimal("net");
            $table->foreignId("payroll_id")->constrained("payroll");
            $table->foreignId("employee")->constrained("employee");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payslip');
    }
};
