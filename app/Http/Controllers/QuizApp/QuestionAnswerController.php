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
    public function questionAnswer()
    {
        try {
            $questionAnswer = QuestionAnswer::orderBy('id', 'desc')->paginate(20);
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
    public function createQuestionAnswer()
    {
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

    public function storeQuestionAnswer(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    "question" => "required",
                    "option_a" => "required",
                    "option_b" => "required",
                    "option_c" => "required",
                    "option_d" => "required",
                    "correct_answer" => "required",
                    "marks" => "required|numeric",
                ],
                [
                    "question" => "Please provide question",
                    "option_a" => "Please provide option a",
                    "option_b" => "Please provide option b",
                    "option_c" => "Please provide option c",
                    "option_d" => "Please provide option d",
                    "correct_answer" => "Please provide correct answer",
                    "marks.required" => "Please provide marks",
                    "marks.numeric" => "Please provide marks in numeric value",
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $questionAnswer = new QuestionAnswer();
            $questionAnswer->question = $request->question;
            $questionAnswer->option_a = $request->option_a;
            $questionAnswer->option_b = $request->option_b;
            $questionAnswer->option_c = $request->option_c;
            $questionAnswer->option_d = $request->option_d;
            $questionAnswer->correct_answer = $request->correct_answer;
            $questionAnswer->marks = $request->marks;
            $questionAnswer->is_active = $request->has('is_active') ? true : false;
            $questionAnswer->save();

            $continueCreating = $request->has('continue_creating') ? 1 : 0;

            if ($continueCreating == 1) {
                Log::info('Successfully Data Added.');
                return redirect()->route('create.question.answer')->with('success', 'Question Answer created successfully.');
            } else {
                Log::info('Successfully Data Added.');
                return redirect()->route('question.answer')->with('success', 'Question Answer created successfully.');
            }

        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

    //-------------------------- View Question Answer --------------------------
    public function viewQuestionAnswer($id)
    {
        try {
            $questionAnswer = QuestionAnswer::find($id);

            if (!$questionAnswer) {
                Log::info('Data Not Found!!!');
                return redirect()->back()->with('error', 'Data not found.');
            }

            Log::info('Successfully Data Viewed.');
            return view('Admin/View/viewQuestionAnswer', ['questionAnswer' => $questionAnswer]);

        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }
    //-------------------------- Edit Question Answer --------------------------
    public function editQuestionAnswer($id)
    {
        try {
            $questionAnswer = QuestionAnswer::find($id);

            if (!$questionAnswer) {
                Log::info('Data Not Found!!!');
                return redirect()->back()->with('error', 'Data not found.');
            }

            Log::info('Successfully Data Retrieved.');
            return view('Admin/Edit/editQuestionAnswer', ['questionAnswer' => $questionAnswer]);

        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

    public function updateQuestionAnswer(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    "question" => "required",
                    "option_a" => "required",
                    "option_b" => "required",
                    "option_c" => "required",
                    "option_d" => "required",
                    "correct_answer" => "required",
                    "marks" => "required|numeric",
                ],
                [
                    "question" => "Please provide question",
                    "option_a" => "Please provide option a",
                    "option_b" => "Please provide option b",
                    "option_c" => "Please provide option c",
                    "option_d" => "Please provide option d",
                    "correct_answer" => "Please provide correct answer",
                    "marks.required" => "Please provide marks",
                    "marks.numeric" => "Please provide marks in numeric value",
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $questionAnswer = QuestionAnswer::find($request->id);
            $questionAnswer->question = $request->question;
            $questionAnswer->option_a = $request->option_a;
            $questionAnswer->option_b = $request->option_b;
            $questionAnswer->option_c = $request->option_c;
            $questionAnswer->option_d = $request->option_d;
            $questionAnswer->correct_answer = $request->correct_answer;
            $questionAnswer->marks = $request->marks;
            $questionAnswer->is_active = $request->has('is_active') ? true : false;
            $questionAnswer->save();

            Log::info('Successfully Data updated.');

            return redirect()->route('question.answer')->with('success', 'Question answer has been updated successfully');

        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

    //-------------------------- Delete Questions Answer --------------------------
    public function deleteQuestionAnswer(Request $request)
    {
        try {
            $id = $request->id;
            $questionAnswer = QuestionAnswer::where('id', $id)->first();
            $questionAnswer->delete();

            if ($questionAnswer === 0) {
                return redirect()->route('question.answer')->with('error', 'Data Not Found!!!');
            }

            Log::info('Successfully Data Deleted.');
            return redirect()->route('question.answer')->with('success', 'Question answer has been deleted successfully');
        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return redirect()->back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

    //-------------------------- Search Questions Answer --------------------------
    public function searchQuestionAnswer(Request $request)
    {
        try {
            $search = $request->input('search');

            $questionAnswer = QuestionAnswer::where('question', 'like', '%' . $search . '%')
                ->orWhere('marks', 'like', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate(20);

            $hasData = !$questionAnswer->isEmpty();

            Log::info('Question Answer Status Search Successfully');
            return view('Admin/questionAnswer')->with([
                'questionAnswers' => $questionAnswer,
                'hasData' => $hasData,
            ]);
        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

    //-------------------------- Active Deactive Questions Answer --------------------------
    public function activeDeactiveQuestionAnswer($id)
    {
        try {
            $questionAnswer = QuestionAnswer::findOrFail($id);
            if (!$questionAnswer) {
                Log::info('Data Not Found!!!');
                return redirect()->back()->with('error', 'Data not found.');
            }

            $questionAnswer->is_active = !$questionAnswer->is_active;
            $questionAnswer->save();

            Log::info('Question Answer Status Change Successfully');
            return redirect()->back()->with('success', 'Status updated successfully.');

        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

    //-------------------------- Sort Questions Answer --------------------------
    public function sortId(Request $request)
    {
        try {
            $query = QuestionAnswer::query();

            $currentSortColumn = $request->session()->get('sort_column', 'id');
            $currentSortOrder = $request->session()->get('sort_order', 'asc');

            $sortColumn = $request->input('sort_column', 'id');

            if ($sortColumn === $currentSortColumn) {
                $sortOrder = ($currentSortOrder === 'asc') ? 'desc' : 'asc';
            } else {
                $sortOrder = 'asc';
            }

            $request->session()->put('sort_column', $sortColumn);
            $request->session()->put('sort_order', $sortOrder);

            $query->orderBy($sortColumn, $sortOrder);

            $perPage = $request->input('per_page', 20);
            $questionAnswers = $query->paginate($perPage);

            $hasData = !$questionAnswers->isEmpty();

            Log::info('Question Answer Sorting With Id Successfully');
            return view('Admin/questionAnswer')->with([
                'questionAnswers' => $questionAnswers,
                'hasData' => $hasData,
            ]);
        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }
    public function sortMarks(Request $request)
    {
        try {
            $query = QuestionAnswer::query();

            $currentSortColumn = $request->session()->get('sort_column', 'marks');
            $currentSortOrder = $request->session()->get('sort_order', 'asc');

            $sortColumn = $request->input('sort_column', 'marks');

            if ($sortColumn === $currentSortColumn) {
                $sortOrder = ($currentSortOrder === 'asc') ? 'desc' : 'asc';
            } else {
                $sortOrder = 'asc';
            }

            $request->session()->put('sort_column', $sortColumn);
            $request->session()->put('sort_order', $sortOrder);

            $query->orderBy($sortColumn, $sortOrder);

            $perPage = $request->input('per_page', 20);
            $questionAnswers = $query->paginate($perPage);

            $hasData = !$questionAnswers->isEmpty();

            Log::info('Question Answer Sorting With Marks Successfully');
            return view('Admin/questionAnswer')->with([
                'questionAnswers' => $questionAnswers,
                'hasData' => $hasData,
            ]);
        } catch (QueryException $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'Database Error Occurred!!! Please Try Again.');
        } catch (Exception $ex) {
            Log::error(__FILE__ . ' || Line ' . __LINE__ . ' || ' . $ex->getMessage() . ' || ' . $ex->getCode());
            return back()->with('error', 'An Unexpected Error Occurred!!! Please Try Again.');
        }
    }

}