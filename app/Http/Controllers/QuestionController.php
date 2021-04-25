<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Survey $survey){
        $data = request()->validate([
            'text' => 'required',
        ]);

        $survey->questions()->create($data);
        
        return ['message' => 'Question Created!'];
    }
    
}
