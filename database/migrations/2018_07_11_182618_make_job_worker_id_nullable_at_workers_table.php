<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeJobWorkerIdNullableAtWorkersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('workers', function (Blueprint $table) {
      $table->dropColumn('job_worker_id');
    });

    Schema::table('workers', function (Blueprint $table) {
      $table->uuid('job_worker_id')->nullable()->after('id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('workers', function (Blueprint $table) {
      $table->dropColumn('job_worker_id');
    });
    
    Schema::table('workers', function (Blueprint $table) {
      $table->uuid('job_worker_id');
    });
  }
}
