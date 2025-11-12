<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'task_name',
        'description',
        'start_time',
        'end_time',
        'status'
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
