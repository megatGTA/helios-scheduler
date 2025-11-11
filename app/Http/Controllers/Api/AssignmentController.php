<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Assignment::with(['scheduleTask', 'technician'])->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Add logic for storing a new assignment if needed
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $assignment = Assignment::with(['scheduleTask', 'technician'])->findOrFail($id);
        return response()->json($assignment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Add logic for updating an assignment if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Add logic for deleting an assignment if needed
    }
}
