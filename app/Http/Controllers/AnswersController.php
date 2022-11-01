<?php

namespace App\Http\Controllers;
use App\Question;
use App\Answer;

use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function store(Question $question, Request $request)
    {
        $question->answers()->create($request->validate([
            'body' => 'required'
        ]) + ['user_id' => \Auth::id()]);

        return back()->with('success', "Your answer has been submitted successfully");
    } 
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        if (request()->expectsJson())
        {
            return response()->json([
                'message' => "Your answer has been removed"
            ]);
        }

        return back()->with('success', "Your answer has been removed");
    }
    
}
