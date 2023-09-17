<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'address', 'active', 'user_id', 'avatar_url'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }

    public function absenceStatuses(): HasMany
    {
        return $this->hasMany(AbsenceStatus::class);
    }

    public function scopeIsActive($query)
    {
        return $query->where('active', true);
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function (Company $company) {
            foreach (Setting::SETTINGS as $setting) {
                Setting::create($setting, $company->id);
            }
        });
    }
}
