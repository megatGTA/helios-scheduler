<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(WorkOrder::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        return response()->json($workOrder, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
 * Get all schedule tasks linked to a specific Work Order.
 */
public function tasks($id)
{
    $workOrder = WorkOrder::with('scheduleTasks')->findOrFail($id);
    return response()->json($workOrder->scheduleTasks, 200);
}

/**
 * Get Work Order details with all linked schedule tasks.
 */
public function details($id)
{
    $workOrder = WorkOrder::with('scheduleTasks')->findOrFail($id);
    return response()->json($workOrder, 200);
}

}
