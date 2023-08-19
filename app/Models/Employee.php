<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'surname', 'phone', 'address', 'employment_date', 'company_id', 'email', 'user_id'];

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

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function scopeFromAuthCompany($query)
    {
        return $query->where('company_id', auth()->user()->company->id);
    }

    public function totalWorkingHours(): Attribute
    {
        return Attribute::get(function () {
            $total = $this->shifts()->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_at, start_at)))) as total_working_hours')->value('total_working_hours');

            return $total;
        });
    }

    public function totalSalary(): Attribute
    {
        return Attribute::get(function () {
            return $this->salaries()->sum('payment');
        });
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
