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
        'asset_name',
        'description',
        'status',
        'planned_date',
        'start_date',
        'due_date',
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
