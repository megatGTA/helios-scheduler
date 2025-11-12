<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AssignmentController extends Controller
{
    public function index(): JsonResponse
    {
        $assignments = Assignment::with(['scheduleTask.workOrder', 'technician.role'])->get();
        return response()->json($assignments);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'schedule_task_id' => 'required|exists:schedule_tasks,id',
            'technician_id' => 'required|exists:technicians,id',
        ]);

        $assignment = Assignment::create($validated);

        return response()->json([
            'message' => 'Technician assigned successfully',
            'data' => $assignment->load(['scheduleTask.workOrder', 'technician.role'])
        ], 201);
    }

    public function show(Assignment $assignment): JsonResponse
    {
        return response()->json($assignment->load(['scheduleTask.workOrder', 'technician.role']));
    }

    public function destroy(Assignment $assignment): JsonResponse
    {
        $assignment->delete();

        return response()->json(['message' => 'Assignment deleted successfully']);
    }
}
