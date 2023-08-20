<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pause extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_at',
        'end_at',
    ];

    protected $appends = ['is_active'];

    public $timestamps = false;

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function isActive(): Attribute
    {
        return Attribute::get(fn () => $this->start_at && ! $this->end_at);
    }
}
