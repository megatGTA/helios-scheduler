<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $technicians = Technician::with('role')->get();

        return response()->json($technicians);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'role_id' => 'required|exists:roles,id'
        ]);

        $technician = Technician::create($validated);

        return response()->json([
            'message' => 'Technician created successfully',
            'data' => $technician->load('role')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technician $technician): JsonResponse
    {
        return response()->json($technician->load('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technician $technician): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'role_id' => 'sometimes|required|exists:roles,id'
        ]);

        $technician->update($validated);

        return response()->json([
            'message' => 'Technician updated successfully',
            'data' => $technician->load('role')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technician $technician): JsonResponse
    {
        $technician->delete();

        return response()->json([
            'message' => 'Technician deleted successfully'
        ]);
    }
}
