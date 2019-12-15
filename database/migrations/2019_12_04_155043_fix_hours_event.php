<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixHoursEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('events', function (Blueprint $table) {
          $table->dateTime('date_start')->change();
          $table->dateTime('date_end')->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('events', function (Blueprint $table) {
        $table->date('date_start')->change();
        $table->date('date_end')->change();
      });
    }
}
