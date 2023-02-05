<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'surname', 'phone', 'address', 'employment_date', 'company_id', 'email'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeFromAuthCompany($query)
    {
        return $query->where('company_id', auth()->user()->company->id);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (Employee $employee) {
            $employee->company_id = auth()->user()->company->id;
        });
    }
}
