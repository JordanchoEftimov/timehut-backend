<?php

namespace App\Models;

use App\Helpers\NetToGross;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'address',
        'employment_date',
        'company_id',
        'user_id',
        'net_salary',
        'previous_work_months',
    ];

    protected $appends = [
        'gross_salary',
        'previous_work_months_additional_payment',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class);
    }

    public function activeShift(): HasOne
    {
        return $this->hasOne(Shift::class)->latestOfMany();
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function absenceRequests(): HasMany
    {
        return $this->hasMany(AbsenceRequest::class);
    }

    public function scopeFromAuthCompany($query)
    {
        return $query->where('company_id', auth()->user()->company->id);
    }

    public function totalWorkingHours(): Attribute
    {
        return Attribute::get(fn () => $this->shifts()->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_at, start_at)))) as total_working_hours')->value('total_working_hours'));
    }

    public function previousWorkMonthsAdditionalPayment(): Attribute
    {
        return Attribute::get(fn () => $this->net_salary * (round($this->previous_work_months / 12) * 0.05));
    }

    public function totalSalary(): Attribute
    {
        return Attribute::get(fn () => $this->salaries()->sum('net_payment'));
    }

    public function grossSalary(): Attribute
    {
        return Attribute::get(fn () => NetToGross::netToGross($this->net_salary));
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (Employee $employee) {
            if (auth()->check()) {
                $employee->company_id = auth()->user()->company->id;
            }
        });
    }
}
