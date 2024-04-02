<?php

use App\Models\{Question, User};

use function Pest\Laravel\actingAs;

it('should list all the questions', function () {
    // Arrang
    // Criar algumas perguntas
    $user = User::factory()->create();
    actingAs($user);
    $questions = Question::factory()->count(5)->create();

    // Act
    // acessar a rota
    $response = \Pest\Laravel\get(route('dashboard'));

    // Assert
    // verificar se a lista de perguntas esta sendo mostrada
    /** @var Question $q **/
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
