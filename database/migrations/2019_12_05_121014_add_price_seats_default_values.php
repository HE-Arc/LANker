<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceSeatsDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('events', function (Blueprint $table) {
          $table->float('price')->default(0)->change();
          $table->bigInteger('seats')->default(0)->change();
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
         //
       });
     }
}
