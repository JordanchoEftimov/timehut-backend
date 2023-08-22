<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AbsenceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'reason',
        'employee_id',
    ];

    protected $appends = [
        'status_name',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function absenceStatus(): HasOne
    {
        return $this->hasOne(AbsenceStatus::class);
    }

    public function scopeFromAuthEmployee($query)
    {
        return $query->where('employee_id', auth()->user()->employee->id);
    }

    public function statusName(): Attribute
    {
        return Attribute::get(fn () => match ($this->absenceStatus->is_approved) {
            1 => 'Одобрено',
            0 => 'Одбиено',
            default => 'Непрегледано',
        });
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (AbsenceRequest $absenceRequest) {
            // link the absence request to the logged in employee
            $employeeId = auth()->user()->employee->id;
            $absenceRequest->employee_id = $employeeId;
        });
        self::created(function (AbsenceRequest $absenceRequest) {
            // create an absence status that the company can review
            $absenceStatus = new AbsenceStatus();
            $absenceStatus->absenceRequest()->associate($absenceRequest);
            $company = Company::query()
                ->firstWhere('id', auth()->user()->employee->company_id);
            $absenceStatus->company()->associate($company);
            $absenceStatus->save();
        });
    }
}
