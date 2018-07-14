<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model {
  /**
   * Get the worker that owns the contract.
   */
  public function worker() {
    return $this->belongsTo(\App\Worker::class);
  }

    /**
   * Get the job that owns the contract.
   */
  public function job() {
    return $this->belongsTo(\App\Job::class);
  }
}