<?php

use App\Models\Employee;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('cannot get shifts when not authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();

    $response = $this->getJson(route('v1.shifts.get'));

    $response->assertUnauthorized();
});

it('can get own shifts when authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $response = $this->getJson(route('v1.shifts.get'));

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

it('can start a shift if the user is an employee', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $response = $this->postJson(route('v1.shifts.start'));

    $response->assertCreated();
    $this->assertDatabaseHas('shifts', [
        'id' => $response->json()['data']['id'],
    ]);
});

it('cannot end a shift if the user did not start the shift', function () {
    $user = User::factory()->has(Employee::factory())->create();
    $anotherUser = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $this->postJson(route('v1.shifts.start'));

    Sanctum::actingAs($anotherUser);
    $response = $this->postJson(route('v1.shifts.end'));

    $response->assertNotFound();
});

it('can end shift if the user started it', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $this->postJson(route('v1.shifts.start'));
    $response = $this->postJson(route('v1.shifts.end'));

    $response->assertOk();
});
