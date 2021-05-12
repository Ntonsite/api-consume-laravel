<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuestionController extends Controller
{
    public function fetch()
    {
        $response = Http::get('https://quizapi.io/api/v1/questions', [
            'apiKey' => 'WzIraAH1rxV866Jk77dgOUqz0JJnm3BVIBGrLYmx',
            'limit' => 10,
        ]);
        $quizzes = json_decode($response->body());
        foreach($quizzes as $quiz){
                $question = new Question;
                $question->question = $quiz->question;
                $question->answer_a = $quiz->answers->answer_a;
                $question->answer_b = $quiz->answers->answer_b;
                $question->answer_c = $quiz->answers->answer_c;
                $question->answer_d = $quiz->answers->answer_d;
                $question->save();
        }
        return "DONE";
    }

}
