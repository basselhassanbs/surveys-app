<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $survey = Survey::create($data);
        $survey->questions()->createMany(request()->questions);

        return ['message' => 'Survey Created!'];
    }

    public function show(Survey $survey){
        $survey->load('questions.answers');
        return $survey;
    }

    public function take()
    {
        $questions = request()->all();
        foreach ($questions as $question) {
            $data = [
                'value' => $question['value'],
                'question_id' => $question['question_id'],
                'survey_id' => $question['survey_id']
            ];
            Answer::create($data);
        }
    }

    public function answers($survey_id,$question_id,$value){
        $answers = DB::table('answers')
            ->where('survey_id',$survey_id)
            ->where('question_id',$question_id)
            ->where('value', $value)
            ->select(DB::raw('count(*) as count'))
            ->value('count');

            return $answers;
    }
}
