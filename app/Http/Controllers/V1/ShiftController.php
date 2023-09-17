<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ShiftResource;
use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function startShift(Employee $employee): JsonResource
    {
        $this->authorize('startShift', Shift::class);

        $shift = new Shift();
        $shift->start_at = now();
        $shift->employee()->associate($employee);
        $shift->save();

        return JsonResource::make($shift);
    }

    /**
     * @throws AuthorizationException
     */
    public function endShift(Employee $employee, Shift $shift): JsonResource
    {
        $this->authorize('endShift', $shift);
        abort_if(! $shift->is_active, 403);

        $shift->end_at = now();
        $shift->save();

        return JsonResource::make($shift);
    }

    /**
     * @throws AuthorizationException
     */
    public function getShifts(Employee $employee): AnonymousResourceCollection
    {
        abort_if($employee->user_id !== auth()->id(), 403);

        $shifts = $employee->shifts()
            ->paginate(10);

        return ShiftResource::collection($shifts);
    }
}
