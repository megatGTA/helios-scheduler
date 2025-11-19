<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\ScheduleTaskController;
// use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\RoleController;

Route::apiResource('work-orders', WorkOrderController::class);
Route::apiResource('schedule-tasks', ScheduleTaskController::class);
// Route::apiResource('assignments', AssignmentController::class);
Route::apiResource('technicians', TechnicianController::class);
Route::apiResource('roles', RoleController::class);
Route::get('/work-orders/{workOrder}/handover-logs', [WorkOrderController::class, 'handoverLogs']);
Route::post('/work-orders/{workOrder}/handover', [WorkOrderController::class, 'handover']);


