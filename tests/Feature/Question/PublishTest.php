<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to publish a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy') ->create(['draft' => true]);
    actingAs($user);

    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();
    expect($question)->draft->toBeFalse();
});

it('should be make sure that only the person who has created the question can publish the question', function () {
    $rigthUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $rigthUser->id]);

    actingAs($wrongUser);

    put(route('question.publish', $question))
        ->assertForbidden();

    actingAs($rigthUser);
    put(route('question.publish', $question))->assertRedirect();
});
