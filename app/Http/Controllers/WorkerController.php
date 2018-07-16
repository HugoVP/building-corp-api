<?php

namespace App\Http\Controllers;

use Log;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Worker;

class WorkerController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->rules = [
      'firstname' => 'required',
      'lastname' => 'required',
      'street_name' => 'required',
      'zip_code' => 'required',
    ];
  }
    
  public function index() {
    /**
     * Get all Workers, including their ACTIVE Contracts,
     * and the Job of each Contract
     */
    $workers = Worker::with(['contracts' => function ($query) {
      $query->with('job')->where('status', 'ACTIVE')->get();
    }])->get();
    
    /* Set the job property for the each Worker */
    $workers->each(function ($worker) {
      if ($contract = $worker->contracts->first()) {
        $worker->job = $contract->job->name;
      }
      
      /* Delete contracts property from Worker */
      unset($worker->contracts);
    });
    
    return response()->json([$workers, 200]);
  }

  public function show($id) {
    try {
      /* Get the Worker with the selected id,
       * including its ACTIVE Contracts
       * and the Job of each Contract
       */
      $worker = Worker::with(['contracts' => function ($query) {
        $query->with('job')->where('status', 'ACTIVE')->get();
      }])->findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'worker_not_found'], 404);
    }

    /* Get the first Contract of the Worker */
    if ($contract = $worker->contracts->first()) {
      /* Set worker's job property */
      $worker->job = $contract->job->name;
    }

    /* Delete contracts property from Worker */
    unset($worker->contracts);
    
    return response()->json($worker, 200);
  }

  public function store(Request $request) {
    $validator = $this->validate($request, $this->rules);

    $worker = new Worker;
    $worker->firstname = $request->firstname;
    $worker->lastname = $request->lastname;
    $worker->street_name = $request->street_name;
    $worker->zip_code = $request->zip_code;
    
    if (!$worker->save()) {
      return response()->json(['error' => 'worker_not_stored'], 500);
    }

    return response()->json($request, 200);
  }

  public function update(Request $request, $id) {
    $validator = $this->validate($request, $this->rules);

    try {
      $worker = Worker::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'worker_not_found'], 404);
    }

    $worker->firstname = $request->firstname;
    $worker->lastname = $request->lastname;
    $worker->street_name = $request->street_name;
    $worker->zip_code = $request->zip_code;
    
    if (!$worker->save()) {
      return response()->json(['error' => 'worker_not_updated'], 500);
    }
    
    return response()->json($worker, 200);
  }
}
