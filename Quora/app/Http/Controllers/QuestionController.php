<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    public function index()
    {

        $questions = Question::where('answer', '!=', null)->get();
        $answers = Question::where('answer', '=', null)->get();
        $bookmarked = Question::where('bookmarked', '=', 1)->get();
        return view('welcome', compact('questions', 'answers', 'bookmarked'));
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
       $question = Question::create([
           'question'   =>  $request->input('question'),
           'state'  =>  'Delhi',
           'topic'  =>  1,
           'answer' =>  NULL,
           'upvote' =>  0
        ]);
        return $question;
    }

    public function answerQuestion(Request $request)
    {
        $question = Question::find($request->input('question_id'));
        $question->update([
           'answer' =>  $request->input('answer')
        ]);
    }

    public function loadQuestionByCity($state)
    {
        $questions = Question::where('state', '=', $state)->where('answer', '!=', null)->get();
        return $questions;
    }

    public function upvote(Request $request)
    {
        $question = Question::find($request->input('question_id'));
        $question->update([
           'upvote' =>  $question->upvote + 1
        ]);
        return response()->json([
            'votes' =>  $question->upvote
        ]);
    }

    public function bookmarkQuestion(Request $request)
    {
        $question = Question::find($request->input('question_id'));

        $question->update([
        'bookmarked' => $question->bookmarked ? 0: 1
        ]);
        return response()->json([
           'bookmarked' =>  $question->bookmarked
        ]);
    }

    public function bookmarkedQuestions()
    {
        return Question::where('bookmarked', '1');
    }
}
