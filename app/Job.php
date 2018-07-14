<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
  /**
   * Get the contracts that owns the job.
   */
  public function contracts() {
    return $this->hasMany(\App\Contract::class);
  }
}