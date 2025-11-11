<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TechnicianController;
use App\Http\Controllers\Api\ScheduleTaskController;
use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\ManhourPlanController;
use App\Http\Controllers\Api\ApprovalController;
use App\Http\Controllers\Api\WorkOrderController;

Route::get('/work-orders/{id}/tasks', [WorkOrderController::class, 'tasks']);
Route::get('/work-orders/{id}/details', [WorkOrderController::class, 'details']);
Route::apiResource('technicians', TechnicianController::class);
Route::apiResource('schedule-tasks', ScheduleTaskController::class);
Route::apiResource('assignments', AssignmentController::class);
Route::apiResource('manhour-plans', ManhourPlanController::class);
Route::apiResource('approvals', ApprovalController::class);
Route::apiResource('work-orders', WorkOrderController::class);
Route::get('/schedule-tasks/{id}/details', [ScheduleTaskController::class, 'details']);

