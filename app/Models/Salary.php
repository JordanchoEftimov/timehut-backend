<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['payment', 'month', 'employee_id'];

    public function monthName(): Attribute
    {
        return Attribute::get(function () {
            switch ($this->month) {
                case 1:
                    return 'Јануари';
                case 2:
                    return 'Февруари';
                case 3:
                    return 'Март';
                case 4:
                    return 'Април';
                case 5:
                    return 'Мај';
                case 6:
                    return 'Јуни';
                case 7:
                    return 'Јули';
                case 8:
                    return 'Август';
                case 9:
                    return 'Септември';
                case 10:
                    return 'Октомври';
                case 11:
                    return 'Ноември';
                case 12:
                    return 'Декември';
                default:
                    return 'Непознато';
            }
        });
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeForLoggedInEmployee($query)
    {
        return $query->where('employee_id', auth()->user()->employee->id);
    }
}
