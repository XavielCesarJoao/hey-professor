<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    //
    public function store(): RedirectResponse
    {

        $atrributes = request()->validate([
            'question' => ['required', 'min:23'],
        ]);

        Question::query()->create($atrributes);

        return  to_route('dashboard');
    }
}
