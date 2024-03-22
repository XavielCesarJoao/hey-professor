<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseHas, post, put};

it('should be able to vote like a question', closure: function () {

    // Arrange
    $user     = User::factory()->create();
    $question = \App\Models\Question::factory()->create();
    actingAs($user);
    // Act
    post(route('question.like', $question))->assertRedirect();
    // Assert
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);

});
