<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Contract;

class ContractController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->rules = [
      'worker_id' => 'required|exists:workers,id',
      'job_id' => 'required|exists:jobs,id',
      'beginning' => 'required|date',
      'ending' => 'required|date',
      'termination' => 'date',
      'status' => 'required|in:ACTIVE,EXPIRED,CANCELED',
      'income' => 'required|numeric|max:9999999999.9999',
      'security' => 'boolean'
    ];
  }
    
  public function index() {
    $contracts = Contract::all();
    return response()->json([$contracts, 200]);
  }

  public function show($id) {
    try {
      $contract = Contract::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'contract_not_found'], 404);
    }
    
    return response()->json($contract, 200);
  }

  public function store(Request $request) {
    $validator = $this->validate($request, $this->rules);

    $contract = new Contract;
    $contract->worker_id = $request->worker_id;
    $contract->job_id = $request->job_id;
    $contract->start_date = Carbon::parse($request->beginning);
    $contract->end_date = Carbon::parse($request->ending);
    $contract->termination_date = Carbon::parse($request->termination);
    $contract->status = 'ACTIVE';
    $contract->salary = $request->income;
    $contract->with_social_security = $request->security;
    
    if (!$contract->save()) {
      return response()->json(['error' => 'contract_not_stored'], 500);
    }

    return response()->json($request, 200);
  }

  public function update(Request $request, $id) {
    $validator = $this->validate($request, $this->rules);

    try {
      $contract = Contract::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'contract_not_found'], 404);
    }

    $contract->worker_id = $request->worker_id;
    $contract->job_id = $request->job_id;
    $contract->job_id = $request->job_id;
    $contract->start_date = Carbon::parse($request->beginning);
    $contract->end_date = Carbon::parse($request->ending);
    $contract->termination_date = Carbon::parse($request->termination);
    $contract->status = $request->status;
    $contract->salary = $request->income;
    $contract->with_social_security = $request->security;
    
    if (!$contract->save()) {
      return response()->json(['error' => 'contract_not_updated'], 500);
    }
    
    return response()->json($contract, 200);
  }
}
