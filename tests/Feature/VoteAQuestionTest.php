<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post, put};

it('should be able to vote like a question', closure: function () {

    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();
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

it('shoul not be able to unlike more than 1 time', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();
    actingAs($user);

    // Act
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));

    // Assert
    expect($user->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});

it('should be able to vote unlike a question', closure: function () {

    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();
    actingAs($user);
    // Act
    post(route('question.unlike', $question))->assertRedirect();
    // Assert
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 0,
        'unlike'      => 1,
        'user_id'     => $user->id,
    ]);

});

it('shoul not be able to like more than 1 time', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();
    actingAs($user);

    // Act
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    // Assert
    expect($user->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});
