<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScheduleTask;
use Illuminate\Http\Request;

class ScheduleTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ScheduleTask::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'work_order_id' => 'required|exists:work_orders,id',
            'task_name'     => 'required|string|max:255',
            'asset_name'    => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'status'        => 'required|string',
            'planned_date'  => 'nullable|date',
        ]);

        $task = ScheduleTask::create($validated);
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = ScheduleTask::findOrFail($id);
        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = ScheduleTask::findOrFail($id);
        $task->update($request->all());
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ScheduleTask::destroy($id);
        return response()->json(null, 204);
    }
    public function details($id)
    {
       $task = ScheduleTask::with(['workOrder', 'assignments.technician'])->findOrFail($id);
       return response()->json($task, 200);
    }

}
