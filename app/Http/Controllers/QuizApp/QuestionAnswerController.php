<?php

namespace App\Http\Controllers\QuizApp;

use App\Http\Controllers\Controller;
use App\Models\QuizApp\QuestionAnswer;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class QuestionAnswerController extends Controller
{
    //-------------------------- Show All Questions --------------------------
    public function showQuestionAnswer(){
        try {
            $questionAnswer = QuestionAnswer::paginate(20);
            $hasData = !$questionAnswer->isEmpty();
    
            Log::info('Successfully Data Retrieved.');
            
            return view('Admin/questionAnswer')->with([
                'questionAnswers' => $questionAnswer,
                'hasData' => $hasData,
            ]);
        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }
    //-------------------------- Create Question Answer --------------------------
    public function createQuestionAnswer(){
        try {
            return view('Admin/Create/createQuestionAnswer');
        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

    public function storeQuestionAnswer(Request $request){
        try {
            $validator = Validator::make($request->all(),
                [
                   "question"=>"required",
                   "option_a"=>"required",
                   "option_b"=>"required",
                   "option_c"=>"required",
                   "option_d"=>"required",
                   "correct_answer"=>"required",
                   "marks"=>"required|numeric",
                ],
                [
                   "question"=>"Please provide question",
                   "option_a"=>"Please provide option a",
                   "option_b"=>"Please provide option b",
                   "option_c"=>"Please provide option c",
                   "option_d"=>"Please provide option d",
                   "correct_answer"=>"Please provide correct answer",
                   "marks.required"=>"Please provide marks",
                   "marks.numeric"=>"Please provide marks in numeric value",
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $questionAnswer = new QuestionAnswer();
            $questionAnswer->question= $request->question;
            $questionAnswer->option_a= $request->option_a;
            $questionAnswer->option_b= $request->option_b;
            $questionAnswer->option_c= $request->option_c;
            $questionAnswer->option_d= $request->option_d;
            $questionAnswer->correct_answer= $request->correct_answer;
            $questionAnswer->marks= $request->marks;
            $questionAnswer->is_active = $request->has('is_active') ? true : false;
            $questionAnswer->save();

            Log::info('Successfully Data Added.');
            
            return redirect()->route('show.question.answer')->with('success', 'Question Answer has been added successfully');
   
        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }
}
