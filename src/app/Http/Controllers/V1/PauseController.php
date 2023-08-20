<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Pause;
use App\Models\Shift;
use Illuminate\Http\Resources\Json\JsonResource;

class PauseController extends Controller
{
    public function startPause(Employee $employee, Shift $shift): JsonResource
    {
        $pause = new Pause();
        $pause->start_at = now();
        $pause->shift()->associate($shift);
        $pause->save();

        return JsonResource::make($pause);
    }

    public function endPause(Employee $employee, Shift $shift, Pause $pause): JsonResource
    {
        abort_if($employee->user_id !== auth()->id, 403);
        abort_if($shift->employee_id !== $employee->id, 403);
        abort_if($pause->shift_id !== $shift->id, 403);
        abort_if(! $pause->is_active, 403);

        $pause->end_at = now();
        $pause->save();

        return JsonResource::make($pause);
    }
}
