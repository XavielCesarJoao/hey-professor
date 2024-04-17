<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    // Arrange :: Preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: verificar
    $request->assertRedirect();
    //    assertDatabaseCount('questions', 1);
    //    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);

});

it('should check if ends with question mark ?', function () {

    // Arrang :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), ['question' => str_repeat('*', 10)]);

    // Assert :: verificar
    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question? It is missing question mark in the end.']);
});

it('should have at least 10 characters', function () {

    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    // Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});

it('should create as a draft all the time', function () {
    $user = User::factory()->create();
    actingAs($user);
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);
});

test('only authenticated users cn create a new question', function () {
    post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ])->assertRedirect(route('login'));
});
