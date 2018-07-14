<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('workers', function (Blueprint $table) {
      $table->increments('id');
      $table->string('firstname');
      $table->string('lastname');
      $table->string('street_name');
      $table->string('zip_code');
      $table->uuid('photo');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('workers');
  }
}
