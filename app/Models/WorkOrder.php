<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'wo_number',
        'title',
        'description',
        'status',
        'start_date',
        'due_date',
        'handover_to',
        'handover_reason',
    ];
    

    public function scheduleTasks()
    {
        return $this->hasMany(ScheduleTask::class);
    }
}
