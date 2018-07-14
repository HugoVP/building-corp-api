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
    Schema::create('contracts', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('worker_id')->unsigned();
      $table->integer('job_id')->unsigned();
      $table->date('start_date');
      $table->date('end_date');
      $table->date('termination_date')->nullable();
     
      $table->enum('status', [
        'ACTIVE',
        'EXPIRED',
        'CANCELED',
      ]);
     
      $table->double('salary', 15, 4)->unsigned();
      $table->boolean('with_social_security')->default(true);
      $table->timestamps();
    });

    Schema::table('contracts', function (Blueprint $table) {
      $table
        ->foreign('worker_id')->references('id')->on('workers')
        ->onDelete('restrict')
        ->onUpdate('restrict');
      
      $table
        ->foreign('job_id')->references('id')->on('jobs')
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
    Schema::table('contracts', function (Blueprint $table) {
      $table
        ->dropForeign('contracts_job_id_foreign')
        ->dropForeign('contracts_worker_id_foreign');
    });

    Schema::dropIfExists('contracts');
  }
}
