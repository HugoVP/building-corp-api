<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model {
  /**
   * Get the contracts that owns the worker.
   */
  public function contracts() {
    return $this->hasMany(\App\Contract::class);
  }
}
