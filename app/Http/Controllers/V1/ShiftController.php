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
    public function startShift(): JsonResource
    {
        $this->authorize('startShift', Shift::class);

        $employee = Employee::query()->firstWhere('user_id', auth()->id());
        $shift = new Shift();
        $shift->start_at = now();
        $shift->employee()->associate($employee);
        $shift->save();

        return JsonResource::make($shift);
    }

    /**
     * @throws AuthorizationException
     */
    public function endShift(): JsonResource
    {
        $this->authorize('endShift', Shift::class);
        $employee = Employee::query()->firstWhere('user_id', auth()->id());
        $shift = $employee->activeShift;
        abort_if(! $shift, 404);
        abort_if($shift->start_at == null || ! $shift->is_active, 403);

        $shift->end_at = now();
        $shift->save();

        return JsonResource::make($shift);
    }

    /**
     * @throws AuthorizationException
     */
    public function getShifts(): AnonymousResourceCollection
    {
        $employee = Employee::query()->firstWhere('user_id', auth()->id());

        $shifts = $employee->shifts()
            ->whereNotNull('end_at')
            ->paginate(10);

        return ShiftResource::collection($shifts);
    }
}
