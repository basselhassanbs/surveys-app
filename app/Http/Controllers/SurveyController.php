<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index(){
        return Survey::all()->load('questions.answers');
    }

    public function store(){
        $data = request()->validate([
            'title' => ['required', 'max:255'],
            'purpose' => 'required',
        ]);

        Survey::create($data);
        
        return ['message' => 'Survey Created!'];
    }

    public function show(Survey $survey){
        $survey->load('questions.answers');
        return $survey;
    }

    public function take(Survey $survey)
    {
        $questions = request()->all();
        foreach ($questions as $question) {
            $data = [
                'value' => $question['value'],
                'question_id' => $question['question_id'],
                'survey_id' => $survey->id
            ];
            Answer::create($data);
        }
    }
}
