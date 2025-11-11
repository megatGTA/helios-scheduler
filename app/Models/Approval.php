<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = ['assignment_id', 'approved_by', 'status', 'remarks'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
