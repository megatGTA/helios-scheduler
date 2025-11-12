<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class WorkOrderController extends Controller
{
    /**
     * Display a paginated listing of work orders.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $query = WorkOrder::with([
            'scheduleTasks.assignments.technician.role'
        ]);

        // Optional filters
        if ($request->has('priority')) {
            $query->where('priority', (int) $request->query('priority'));
        }

        if ($request->has('status')) {
            // if you later add a status column: $query->where('status', $request->query('status'));
        }

        $data = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json($data);
    }

    /**
     * Store a newly created work order.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|between:1,3',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'engine_type' => 'nullable|string|max:255',
            'engine_part_number' => 'nullable|string|max:255',
            'engine_serial_number' => 'nullable|string|max:255',
        ]);

        $workOrder = DB::transaction(function () use ($validated) {
            return WorkOrder::create($validated);
        });

        return response()->json([
            'message' => 'Work order created',
            'data' => $workOrder->load('scheduleTasks'),
        ], 201);
    }

    /**
     * Display the specified work order.
     */
    public function show(WorkOrder $workOrder): JsonResponse
    {
        $workOrder->load('scheduleTasks.assignments.technician.role');

        return response()->json([
            'data' => $workOrder,
        ]);
    }

    /**
     * Update the specified work order.
     */
    public function update(Request $request, WorkOrder $workOrder): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|required|integer|between:1,3',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'engine_type' => 'nullable|string|max:255',
            'engine_part_number' => 'nullable|string|max:255',
            'engine_serial_number' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($workOrder, $validated) {
            $workOrder->update($validated);
        });

        return response()->json([
            'message' => 'Work order updated',
            'data' => $workOrder->fresh()->load('scheduleTasks'),
        ]);
    }

    /**
     * Remove the specified work order.
     */
    public function destroy(WorkOrder $workOrder): JsonResponse
    {
        // If you want soft deletes, implement softDeletes in model and use $workOrder->delete()
        $workOrder->delete();

        return response()->json([
            'message' => 'Work order deleted',
        ]);
    }
}
