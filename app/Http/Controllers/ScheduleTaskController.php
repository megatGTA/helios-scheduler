<?php

namespace App\Http\Controllers;

use App\Models\ScheduleTask;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScheduleTaskController extends Controller
{
    /**
     * List all tasks, or filter by Work Order ID.
     */
    public function index(Request $request): JsonResponse
    {
        $tasks = ScheduleTask::with(['cs', 'workOrder.cs'])
            ->when($request->work_order_id, function ($query) use ($request) {
                $query->where('work_order_id', $request->work_order_id);
            })
            ->orderBy('due_date')
            ->get();

        return response()->json($tasks);
    }

    /**
     * Create a task belonging to a Work Order.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'work_order_id' => 'required|exists:work_orders,id',
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'planned_date' => 'nullable|date',
            'asset_name' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,assigned,in_progress,completed',
        ]);

        $workOrder = WorkOrder::with('cs')->findOrFail($validated['work_order_id']);

        // Inherit CS from Work Order
        $validated['cs_id'] = $workOrder->cs_id;

        $task = ScheduleTask::create($validated);

        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task->load(['cs', 'workOrder.cs'])
        ], 201);
    }

    /**
     * Show a single task.
     */
    public function show(ScheduleTask $scheduleTask): JsonResponse
    {
        return response()->json(
            $scheduleTask->load(['cs', 'workOrder.cs'])
        );
    }

    /**
     * Update task details (NOT assignment).
     */
    public function update(Request $request, ScheduleTask $scheduleTask): JsonResponse
    {
        $validated = $request->validate([
            'task_name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'planned_date' => 'nullable|date',
            'asset_name' => 'nullable|string',
            'status' => 'nullable|in:pending,assigned,in_progress,completed',
        ]);

        // Prevent someone from changing task owner
        unset($validated['cs_id']);

        $scheduleTask->update($validated);

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $scheduleTask->fresh()->load(['cs', 'workOrder.cs'])
        ]);
    }

    /**
     * Tasks cannot be deleted (traceability requirement).
     */
    public function destroy()
    {
        return response()->json([
            'message' => 'Deleting tasks is not allowed for traceability reasons.'
        ], 403);
    }
}
