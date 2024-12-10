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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time("check_in")->nullable();
            $table->time("check_out")->nullable();
            $table->enum('status', ['present', 'absent', 'late', 'leave'])->default('absent');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign("employee_id")->references("id")->on("employees");
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
        Schema::dropIfExists('attendance');
    }
};
