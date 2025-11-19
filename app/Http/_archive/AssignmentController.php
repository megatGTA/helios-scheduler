<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ScheduleTask;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function index(): JsonResponse
    {
        $assignments = Assignment::with([
            'scheduleTask.workOrder',
            'technician.role'
        ])->get();

        return response()->json($assignments);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'schedule_task_id' => 'required|exists:schedule_tasks,id',
            'technician_id' => 'required|exists:technicians,id',
        ]);

        $task = ScheduleTask::findOrFail($validated['schedule_task_id']);
        $technician = Technician::with('role')->findOrFail($validated['technician_id']);

        // 1️⃣ Ensure technician role is CS
        if ($technician->role->name !== 'CS') {
            return response()->json([
                'message' => 'Only CS technicians can be assigned to tasks.'
            ], 422);
        }

        // 2️⃣ Check for duplicate assignment
        $exists = Assignment::where('schedule_task_id', $task->id)
            ->where('technician_id', $technician->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Technician already assigned to this task.'
            ], 409);
        }

        // 3️⃣ Create the assignment
        $assignment = DB::transaction(function () use ($validated) {
            return Assignment::create([
                'schedule_task_id' => $validated['schedule_task_id'],
                'technician_id' => $validated['technician_id'],
                'assigned_at' => now(),
            ]);
        });

        return response()->json([
            'message' => 'Technician assigned successfully',
            'data' => $assignment->load(['scheduleTask.workOrder', 'technician.role'])
        ], 201);
    }

    public function update(Request $request, Assignment $assignment): JsonResponse
    {
        $validated = $request->validate([
            'technician_id' => 'required|exists:technicians,id',
        ]);

        $newTechnician = Technician::with('role')->findOrFail($validated['technician_id']);

        // 1️⃣ Ensure technician role is CS
        if ($newTechnician->role->name !== 'CS') {
            return response()->json([
                'message' => 'Only CS technicians can be assigned to tasks.'
            ], 422);
        }

        // 2️⃣ Prevent duplicate assignment
        $duplicateExists = Assignment::where('schedule_task_id', $assignment->schedule_task_id)
            ->where('technician_id', $newTechnician->id)
            ->where('id', '!=', $assignment->id)
            ->exists();

        if ($duplicateExists) {
            return response()->json([
                'message' => 'This technician is already assigned to this task.'
            ], 409);
        }

        // 3️⃣ Update assignment
        $assignment->update([
            'technician_id' => $newTechnician->id,
            'assigned_at' => now(),
        ]);

        return response()->json([
            'message' => 'Assignment updated successfully',
            'data' => $assignment->fresh()->load(['scheduleTask.workOrder', 'technician.role'])
        ]);
    }

    public function show(Assignment $assignment): JsonResponse
    {
        return response()->json(
            $assignment->load(['scheduleTask.workOrder', 'technician.role'])
        );
    }

    public function destroy(Assignment $assignment): JsonResponse
    {
        $assignment->delete();

        return response()->json(['message' => 'Assignment removed']);
    }
}
