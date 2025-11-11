<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_task_id',
        'technician_id',
        'assigned_date',
        'status',
        'remarks',
    ];

    public function scheduleTask()
    {
        return $this->belongsTo(ScheduleTask::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
