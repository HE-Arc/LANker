<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGameImageUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('eventgames', function (Blueprint $table) {
          $table->string('cover')->default('https://images.igdb.com/igdb/image/upload/t_cover_big/ya81ui.jpg');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('eventgames', function (Blueprint $table) {
          $table->dropColumn('cover');
      });
    }
}
