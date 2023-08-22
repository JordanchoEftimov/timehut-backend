<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsenceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_approved',
        'absence_request_id',
        'company_id',
    ];

    protected $appends = [
        'status_name',
    ];

    public function absenceRequest(): BelongsTo
    {
        return $this->belongsTo(AbsenceRequest::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function statusName(): Attribute
    {
        return Attribute::get(fn () => match ($this->is_approved) {
            1 => 'Одобрено',
            0 => 'Одбиено',
            default => 'Непрегледано',
        });
    }
}
