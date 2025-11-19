<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Models\WorkOrderHandoverLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class WorkOrderController extends Controller
{
    /**
     * List all Work Orders (with CS + Tasks).
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);

        $query = WorkOrder::with([
            'cs',                 // Work Order owner
            'scheduleTasks.cs'    // Tasks + inherited CS
        ]);

        if ($request->has('priority')) {
            $query->where('priority', (int) $request->query('priority'));
        }

        return response()->json(
            $query->orderBy('created_at', 'desc')->paginate($perPage)
        );
    }

    /**
     * Create Work Order
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|between:1,3',
            'cs_id' => 'nullable|exists:technicians,id',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'engine_type' => 'nullable|string|max:255',
            'engine_part_number' => 'nullable|string|max:255',
            'engine_serial_number' => 'nullable|string|max:255',
        ]);

        $workOrder = DB::transaction(function () use ($validated) {
            $wo = WorkOrder::create($validated);

            if (isset($validated['cs_id'])) {
                $wo->scheduleTasks()->update([
                    'cs_id' => $validated['cs_id']
                ]);
            }

            return $wo;
        });

        return response()->json([
            'message' => 'Work order created successfully',
            'data' => $workOrder->load(['cs', 'scheduleTasks.cs']),
        ], 201);
    }

    /**
     * Display Single Work Order.
     */
    public function show(WorkOrder $workOrder): JsonResponse
    {
        return response()->json([
            'data' => $workOrder->load(['cs', 'scheduleTasks.cs']),
        ]);
    }
    /**
     * Get handover history for a Work Order.
     */
    public function handoverLogs(WorkOrder $workOrder): JsonResponse
    {
        $logs = $workOrder->handoverLogs()
            ->with(['oldCS','newCS','changer'])
            ->orderBy('changed_at','desc')
            ->get();

        return response()->json([
            'work_order_id' => $workOrder->id,
            'handover_logs' => $logs
        ]);
    }
    /**
 * Explicit Work Order Handover (WM action).
 */
    public function handover(Request $request, WorkOrder $workOrder): JsonResponse
    {
        $validated = $request->validate([
            'new_cs_id' => 'required|exists:technicians,id',
            'reason' => 'nullable|string'
    ]);

        $oldCs = $workOrder->cs_id;
        $newCs = $validated['new_cs_id'];

    // Prevent pointless handover
        if ($oldCs == $newCs) {
            return response()->json([
                'message' => 'Work Order is already assigned to this CS.'
            ], 409);
    }

    DB::transaction(function () use ($workOrder, $oldCs, $newCs, $validated) {

        // Create handover log
        \App\Models\WorkOrderHandoverLog::create([
            'work_order_id' => $workOrder->id,
            'old_cs_id' => $oldCs,
            'new_cs_id' => $newCs,
            'changed_by' => auth()->id(),
            'reason' => $validated['reason'] ?? null,
            'changed_at' => now(),
        ]);

        // Update CS on Work Order
        $workOrder->update([
            'cs_id' => $newCs
        ]);

        // Update CS for all tasks
        $workOrder->scheduleTasks()->update([
            'cs_id' => $newCs
        ]);
    });

    return response()->json([
        'message' => 'Work Order handed over successfully.',
        'data' => $workOrder->fresh()->load(['cs', 'scheduleTasks.cs'])
    ]);
}

    /**
     * Update Work Order (including handover).
     */
    public function update(Request $request, WorkOrder $workOrder): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|required|integer|between:1,3',
            'cs_id' => 'sometimes|exists:technicians,id',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'engine_type' => 'nullable|string|max:255',
            'engine_part_number' => 'nullable|string|max:255',
            'engine_serial_number' => 'nullable|string|max:255',
            'handover_reason' => 'nullable|string',
        ]);

        DB::transaction(function () use ($workOrder, $validated) {

            if (isset($validated['cs_id'])) {
                $oldCs = $workOrder->cs_id;
                $newCs = $validated['cs_id'];

                if ($oldCs != $newCs) {

                    // Save handover log
                    WorkOrderHandoverLog::create([
                        'work_order_id' => $workOrder->id,
                        'old_cs_id' => $oldCs,
                        'new_cs_id' => $newCs,
                        'changed_by' => auth()->id(),
                        'reason' => $validated['handover_reason'] ?? null,
                        'changed_at' => now(),
                    ]);

                    // Update task assignments
                    $workOrder->scheduleTasks()->update([
                        'cs_id' => $newCs
                    ]);
                }
            }

            $workOrder->update($validated);
        });

        return response()->json([
            'message' => 'Work order updated successfully',
            'data' => $workOrder->fresh()->load(['cs', 'scheduleTasks.cs']),
        ]);
    }

    /**
     * Deletion disabled (traceability requirement).
     */
    public function destroy()
    {
        return response()->json([
            'message' => 'Deleting Work Orders is not allowed for traceability reasons.'
        ], 403);
    }
}
