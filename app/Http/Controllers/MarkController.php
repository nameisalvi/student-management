<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MarkService;
use Validator;

class MarkController extends Controller
{
    public function __construct(MarkService $markService)
    {
    	$this->markService = $markService;
    }

    public function index()
    {
        $marks = $this->markService->getmarks();
        $students = $this->markService->getStudents();

    	return view('mark.index', compact('marks', 'students'));
    }


    /**
    * Function for add/update student marks
    *
    * @param Request Illuminate\Http\Request
    *
    */
    public function save(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'student_id' => 'required',
    		'term' => 'required',
            'maths' => 'required',
    		'science' => 'required',
            'history' => 'required'
    	]);
    	if ($validator->fails()) {
    		return response()->json(['errors' => $validator->errors()], 422);
    	}
    	$created = $this->markService->storemark($request);
    	if ($created) {
    		return response()->json(['success' => true], 200);
    	}
    }

    /**
    * Edit marks
    *
    * @param request Illuminate\Http\Request
    *
    **/
    public function edit(Request $request)
    {
        return response()->json(['data' => $this->markService->get($request->id)], 200);
    }

    /**
    * For deleting marks
    * 
    * @param Request
    *
    **/
    public function delete(Request $request)
    {
        $deleted = $this->markService->delete($request->id);
        if ($deleted) {
            return redirect('/mark');
        }
    }
}
