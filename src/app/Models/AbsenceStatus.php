<?php

namespace App\Models;

use App\Notifications\AbsenceRequestApprovedNotification;
use App\Notifications\AbsenceRequestDeniedNotification;
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

    protected static function boot()
    {
        parent::boot();

        self::updated(function (AbsenceStatus $absenceStatus) {
            $user = $absenceStatus->absenceRequest->employee->user;
            if ($absenceStatus->isDirty('is_approved')) {
                if ($absenceStatus->is_approved) {
                    $user->notify(new AbsenceRequestApprovedNotification($absenceStatus->absenceRequest));
                } else {
                    $user->notify(new AbsenceRequestDeniedNotification($absenceStatus->absenceRequest));
                }
            }
        });
    }
}
