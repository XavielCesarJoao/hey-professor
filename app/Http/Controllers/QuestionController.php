<?php

namespace App\Http\Controllers;

use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuestionController extends Controller
{
    //
    public function store(): RedirectResponse
    {

        request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],
        ]);

        user()->questions()->create(
            [
                'question' => request()->question,
                'draft'    => true,
            ]
        );

        return  back();
    }

    public function index(): view
    {
        return view('questions.index', [
            'questions' => user()->questions,
        ]);
    }
}
