<?php

use App\Models\Employee;
use App\Models\Shift;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('cannot get shifts when not authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();

    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.shifts.get', $employee));

    $response->assertUnauthorized();
});

it('can get own shifts when authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.shifts.get', $employee));

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'start_at',
                    'end_at',
                    'duration',
                ],
            ],
        ]);
});

it('cannot get another user\'s shifts when authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();
    $anotherUser = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($anotherUser);
    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.shifts.get', $employee));

    $response->assertForbidden();
});

it('can start a shift if the user is an employee', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $response = $this->postJson(route('v1.shifts.start', $employee));

    $response->assertCreated();
    $this->assertDatabaseHas('shifts', [
        'id' => $response->json()['data']['id'],
    ]);
});

it('cannot end a shift if the user did not start the shift', function () {
    $user = User::factory()->has(Employee::factory())->create();
    $anotherUser = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $startedShift = $this->postJson(route('v1.shifts.start', $employee));

    Sanctum::actingAs($anotherUser);
    $employee = Employee::query()->firstWhere('user_id', $anotherUser->id);
    $shift = Shift::query()->firstWhere('id', $startedShift->json()['data']['id']);
    $response = $this->postJson(route('v1.shifts.end', ['employee' => $employee, 'shift' => $shift]));

    $response->assertForbidden();
});

it('can end shift if the user started it', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $startedShift = $this->postJson(route('v1.shifts.start', $employee));

    $shift = Shift::query()->firstWhere('id', $startedShift->json()['data']['id']);
    $response = $this->postJson(route('v1.shifts.end', ['employee' => $employee, 'shift' => $shift]));

    $response->assertOk();
});

it('cannot end shift that is not active', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);
    $startedShift = $this->postJson(route('v1.shifts.start', $employee));

    $shift = Shift::query()->firstWhere('id', $startedShift->json()['data']['id']);
    $this->postJson(route('v1.shifts.end', ['employee' => $employee, 'shift' => $shift]));

    $response = $this->postJson(route('v1.shifts.end', ['employee' => $employee, 'shift' => $shift]));

    $response->assertForbidden();
});
