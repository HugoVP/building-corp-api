<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ContractsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      /* Get all Jobs */
      $jobs = \App\Job::all();

      /* Get all Workers */
      \App\Worker::chunk(10, function ($workers) use ($jobs) {
        /* For each group of 10 workers */
        foreach ($workers as $worker) {
          /* Create an ACTIVE contract */
          factory(\App\Contract::class)->create([
            'worker_id' => $worker->id,
            'job_id' => $jobs->random()->id,
            'status' => 'ACTIVE',
          ]);

          /* Create a random(0, 10) number of non-ACTIVE contracts */
          factory(\App\Contract::class, random_int(0, 10))->create([
            'worker_id' => $worker->id,
            'job_id' => $jobs->random()->id,
          ]);
        }
      });
    }
}
