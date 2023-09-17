<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Pause;
use App\Models\Shift;
use Illuminate\Http\Resources\Json\JsonResource;

class PauseController extends Controller
{
    public function startPause(Shift $shift): JsonResource
    {
        abort_if(auth()->id() !== $shift->employee->user_id, 403);
        $pause = new Pause();
        $pause->start_at = now();
        $pause->shift()->associate($shift);
        $pause->save();

        return JsonResource::make($pause);
    }

    public function endPause(Shift $shift, Pause $pause): JsonResource
    {
        abort_if(auth()->id() !== $shift->employee->user_id, 403);
        abort_if($pause->shift_id !== $shift->id, 403);
        abort_if(! $pause->is_active, 403);

        $pause->end_at = now();
        $pause->save();

        return JsonResource::make($pause);
    }
}
