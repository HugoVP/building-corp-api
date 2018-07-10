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
      $table->uuid('id')->primary();
      $table->uuid('job_worker_id');
      $table->string('firstname');
      $table->string('lastname');
      $table->string('address');
      $table->string('zip_code');
      $table->double('salary', 15, 4)->unsigned();
      $table->boolean('has_social_security')->default(0);
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
