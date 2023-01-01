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
        Schema::create('employee_allowances', function (Blueprint $table) {
            $table->id();
            $table->float("amount");
            //$table->enum("type",[1,2,3])->comment("1 monthly , 2 semi-month , 3 once");
            $table->date("effective_date");
            $table->foreignId("employee_id")->constrained("employee")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("allowance_id")->constrained("allowances")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('employee_allowances');
    }
};
