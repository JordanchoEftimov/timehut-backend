<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsenceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'reason',
        'employee_id',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeFromAuthEmployee($query)
    {
        return $query->where('employee_id', auth()->user()->employee->id);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (AbsenceRequest $absenceRequest) {
            $employeeId = auth()->user()->employee->id;
            $absenceRequest->employee_id = $employeeId;
        });
    }
}
