<?php

use App\Models\Employee;
use App\Models\Pause;
use App\Models\Shift;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can start a pause', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $response = $this->postJson(route('v1.shifts.start', $employee));

    $shift = Shift::query()->firstWhere('id', $response->json()['data']['id']);

    $response = $this->postJson(route('v1.pauses.start', ['employee' => $employee, 'shift' => $shift]));

    $response->assertCreated();
});

it('cannot end a pause for another employee\'s shift', function () {
    $user = User::factory()->has(Employee::factory())->create();
    $anotherUser = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $response = $this->postJson(route('v1.shifts.start', $employee));

    $shift = Shift::query()->firstWhere('id', $response->json()['data']['id']);

    $response = $this->postJson(route('v1.pauses.start', ['employee' => $employee, 'shift' => $shift]));

    Sanctum::actingAs($anotherUser);
    $anotherEmployee = Employee::query()->firstWhere('user_id', $anotherUser->id);
    $pause = Pause::query()->firstWhere('id', $response->json()['data']['id']);

    $response = $this->postJson(route('v1.pauses.end', [
        'employee' => $anotherEmployee,
        'shift' => $shift,
        'pause' => $pause,
    ]));

    $response->assertForbidden();
});

it('can end own pause for own shift', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $response = $this->postJson(route('v1.shifts.start', $employee));

    $shift = Shift::query()->firstWhere('id', $response->json()['data']['id']);

    $response = $this->postJson(route('v1.pauses.start', ['employee' => $employee, 'shift' => $shift]));

    $pause = Pause::query()->firstWhere('id', $response->json()['data']['id']);

    $response = $this->postJson(route('v1.pauses.end', [
        'employee' => $employee,
        'shift' => $shift,
        'pause' => $pause,
    ]));

    $response->assertOk();
});

it('cannot end pause that it\'s not active', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $response = $this->postJson(route('v1.shifts.start', $employee));

    $shift = Shift::query()->firstWhere('id', $response->json()['data']['id']);

    $response = $this->postJson(route('v1.pauses.start', ['employee' => $employee, 'shift' => $shift]));

    $pause = Pause::query()->firstWhere('id', $response->json()['data']['id']);

    $this->postJson(route('v1.pauses.end', [
        'employee' => $employee,
        'shift' => $shift,
        'pause' => $pause,
    ]));

    $response = $this->postJson(route('v1.pauses.end', [
        'employee' => $employee,
        'shift' => $shift,
        'pause' => $pause,
    ]));

    $response->assertForbidden();
});
