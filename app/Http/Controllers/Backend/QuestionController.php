<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
	public function __construct() {
		$this->middleware('authAdmin:admin');
	}

	public function index() {
		$users = User::all();
		$questions = Question::all();
		$departments = Department::all();
		return view('dashboard.admin.questions', compact('questions', 'users', 'departments'));
	}

	public function store( Request $request ) {
		$request->validate([
			'text' => 'required',
			'department_id' => 'required'
		]);

		$question = new Question();
		$question->text = $request['text'];
		$question->department_id = $request['department_id'];
		$question->save();

		$answer1 = new Answer();
		$answer1->text = $request['answer1'];
		$answer1->question_id = $question->id;
		$answer1->save();
		$answer2 = new Answer();
		$answer2->text = $request['answer2'];
		$answer2->question_id = $question->id;
		$answer2->save();
		$answer3 = new Answer();
		$answer3->text = $request['answer3'];
		$answer3->question_id = $question->id;
		$answer3->save();

		return back();
	}

	public function destroy( $id ) {
		Question::findOrFail($id)->delete();
		return back();
	}
}
