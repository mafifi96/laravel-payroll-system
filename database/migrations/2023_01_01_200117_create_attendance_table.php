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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            //$table->enum("log_typ",[1,2,3,4])->comment("1 Time-in-AM , 2 Time-out-AM , 3 Time-in-PM , 4 Time-out-PM");
            $table->time("from");
            $table->time("to");
            $table->tinyInteger("hours");
            $table->foreignId("employee_id")->constrained("employee")->cascadeOnDelete()->cascadeOnUpdate();
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
