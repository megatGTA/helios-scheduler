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
}

