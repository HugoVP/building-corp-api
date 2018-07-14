<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Job::class)->create([
        'name' => 'FOREMAN',
        'description' => 'A construction foreman is the worker or tradesman who is in charge of a construction crew. This role is generally assumed by a senior worker.',
      ]);

      factory(App\Job::class)->create([
        'name' => 'ARCHITECT',
        'description' => 'An architect is a person who plans, designs, and reviews the construction of buildings.',
      ]);

      factory(App\Job::class)->create([
        'name' => 'BRICKLAYER',
        'description' => 'A bricklayer is a craftsman who lays bricks to construct brickwork.',
      ]);

      factory(App\Job::class)->create([
        'name' => 'OPERATOR',
        'description' => 'Operators are day-to-day end users of systems, that may or may not be mission-critical, but are typically managed and maintained by technicians or engineers.',
      ]);

      factory(App\Job::class)->create([
        'name' => 'BUYER',
        'description' => 'Construction buyers are the regulators for the materials required for a construction project, in which they purchase the products in accordance with the established budgets.',
      ]);
    }
}
