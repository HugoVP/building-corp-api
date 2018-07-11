<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeIdPrimaryAtJobWorkerTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('job_worker', function (Blueprint $table) {
      $table->dropColumn('id');
    });

    Schema::table('job_worker', function (Blueprint $table) {
      $table->uuid('id')->primary()->first();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('job_worker', function (Blueprint $table) {
      $table->dropColumn('id');
    });

    Schema::table('job_worker', function (Blueprint $table) {
      $table->uuid('id');
    });
  }
}
