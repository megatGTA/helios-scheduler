<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'cs_id',
        'handover_reason',
        'start_date',
        'due_date',
        'engine_type',
        'engine_part_number',
        'engine_serial_number'
    ];
    public function scheduleTasks()
    {
        return $this->hasMany(ScheduleTask::class);
    }
    public function cs()
    { 
        return $this->belongsTo(Technician::class, 'cs_id');
    }
    public function handoverLogs()
    {
        return $this->hasMany(WorkOrderHandoverLog::class);
    }
}

