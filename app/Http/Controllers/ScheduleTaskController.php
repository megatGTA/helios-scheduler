<?php

namespace App\Http\Controllers;

use App\Models\ScheduleTask;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScheduleTaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = ScheduleTask::with('workOrder')->get();
        return response()->json($tasks);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'work_order_id' => 'required|exists:work_orders,id',
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'nullable|string|max:50'
        ]);

        $task = ScheduleTask::create($validated);

        return response()->json([
            'message' => 'Schedule task created successfully',
            'data' => $task->load('workOrder')
        ], 201);
    }

    public function show(ScheduleTask $scheduleTask): JsonResponse
    {
        return response()->json($scheduleTask->load('workOrder'));
    }

    public function update(Request $request, ScheduleTask $scheduleTask): JsonResponse
    {
        $validated = $request->validate([
            'task_name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'nullable|string|max:50'
        ]);

        $scheduleTask->update($validated);

        return response()->json([
            'message' => 'Schedule task updated successfully',
            'data' => $scheduleTask->load('workOrder')
        ]);
    }

    public function destroy(ScheduleTask $scheduleTask): JsonResponse
    {
        $scheduleTask->delete();

        return response()->json(['message' => 'Schedule task deleted successfully']);
    }
}
