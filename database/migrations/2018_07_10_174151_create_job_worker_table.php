<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobWorkerTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('job_worker', function (Blueprint $table) {
      $table->uuid('id');
      $table->uuid('job_id');
      $table->uuid('worker_id');
      $table->date('start_date');
      $table->date('end_date');
      $table->timestamps();
    });

    Schema::table('job_worker', function (Blueprint $table) {
      $table
        ->foreign('job_id')->references('id')->on('jobs')
        ->onDelete('restrict')
        ->onUpdate('restrict');

      $table
        ->foreign('worker_id')->references('id')->on('workers')
        ->onDelete('restrict')
        ->onUpdate('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('job_worker', function (Blueprint $table) {
      $table
        ->dropForeign('job_worker_job_id_foreign')
        ->dropForeign('job_worker_worker_id_foreign');
    });

    Schema::dropIfExists('job_worker');
  }
}
