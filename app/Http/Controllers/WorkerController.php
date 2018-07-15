<?php

namespace App\Http\Controllers;

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
    $workers = Worker::all();
    return response()->json([$workers, 200]);
  }

  public function show($id) {
    try {
      $worker = Worker::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'worker_not_found'], 404);
    }
    
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
