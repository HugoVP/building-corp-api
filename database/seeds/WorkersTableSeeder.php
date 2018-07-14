<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class WorkersTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    factory(\App\Worker::class, 30)->create();
  }
}
