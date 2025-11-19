<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderHandoverLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'old_cs_id',
        'new_cs_id',
        'changed_by',
        'reason',
        'changed_at',
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function oldCs()
    {
        return $this->belongsTo(Technician::class, 'old_cs_id');
    }

    public function newCs()
    {
        return $this->belongsTo(Technician::class, 'new_cs_id');
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
