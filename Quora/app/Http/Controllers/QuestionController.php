<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::where('answer', '!=', null)->get();
        return view('welcome', compact('questions'));
    }

    public function loadTopic($topic)
    {
        $questions = Question::where('topic', $topic)->where('answer', '!=', null)->get();
        return $questions;
    }

    public function storeComment(Request $request)
    {
        $question_id = $request->input('question_id');
        $comment = $request->input('comment');
        $question = Question::find($question_id);
        $question->comments()->create([
           'comment'    =>  $comment
        ]);
        return 1;
    }

    public function getComments($id)
    {
        $question = Question::find($id);
        $comments = $question->comments;
        return $comments;
    }

    public function storeQuestion(Request $request)
    {
        Question::create([
           'question'   =>  $request->input('question'),
           'state'  =>  'Delhi',
           'topic'  =>  1,
           'answer' =>  NULL,
           'upvote' =>  0
        ]);
        return 1;
    }
}
