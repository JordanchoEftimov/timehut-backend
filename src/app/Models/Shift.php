<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['start_at', 'end_at'];

    protected $appends = ['duration'];

    public $timestamps = false;

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function pauses(): HasMany
    {
        return $this->hasMany(Pause::class);
    }

    public function duration(): Attribute
    {
        return Attribute::get(fn () => $this->start_at->diff($this->end_at)->format('%H:%I:%S'));
    }

    public function day(): Attribute
    {
        return Attribute::get(function () {
            Carbon::setLocale('mk');

            return $this->start_at->translatedFormat('l');
        });
    }

    public function scopeForLoggedInEmployee($query)
    {
        return $query->where('employee_id', auth()->user()->employee->id);
    }
}
