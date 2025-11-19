<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'task_name',
        'description',
        'start_date',
        'due_date',
        'planned_date',
        'asset_name',
        'status',
        'cs_id'
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function cs()
    {
        return $this->belongsTo(Technician::class, 'cs_id');
    }
}
