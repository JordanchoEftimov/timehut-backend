<?php

use App\Models\User;

it('can login successfully', function () {
    $user = User::factory()->create();
    $response = $this->postJson(route('v1.auth.login'), [
        'email' => $user->email,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'device_name' => 'Test',
    ]);

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'name',
                'email',
            ],
            'token',
        ]);
});

it('can\'t login with wrong credentials', function () {
    $response = $this->postJson(route('v1.auth.login'), [
        'email' => 'test@gmail.com',
        'password' => 'test',
        'device_name' => 'Test',
    ]);
    $response->assertJsonValidationErrorFor('email');
});

it('can\'t login with wrong password', function () {
    $user = User::factory()->create();
    $response = $this->postJson(route('v1.auth.login'), [
        'email' => $user->email,
        'password' => 'test',
        'device_name' => 'Test',
    ]);
    $response->assertJsonValidationErrorFor('email');
});

it('can\'t login with empty credentials', function () {
    $response = $this->postJson(route('v1.auth.login'), [
        'email' => '',
        'password' => '',
        'device_name' => 'Test',
    ]);
    $response->assertJsonValidationErrors(['email', 'password']);
});
