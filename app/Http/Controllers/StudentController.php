<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StudentService;
use Validator;

class StudentController extends Controller
{
    public function __construct(StudentService $studentService)
    {
    	$this->studentService = $studentService;
    }

    public function index()
    {
        $students = $this->studentService->getStudents();

    	return view('student.index', compact('students'));
    }


    /**
    * Function for add/update student students
    *
    * @param Request Illuminate\Http\Request
    *
    */
    public function save(Request $request)
    {
        
    	$validator = Validator::make($request->all(), [
    		'name' => 'required',
    		'age' => 'required',
            'gender' => 'required',
    		'reporting_teacher' => 'required'
    	]);
    	if ($validator->fails()) {
    		return response()->json(['errors' => $validator->errors()], 422);
    	}
    	$stored = $this->studentService->storeStudent($request);
    	if ($stored) {
    		return response()->json(['success' => true], 200);
    	}
    }

    /**
    * Edit students
    *
    * @param request Illuminate\Http\Request
    *
    **/
    public function edit(Request $request)
    {
        return response()->json(['data' => $this->studentService->get($request->id)], 200);
    }

    /**
    * For deleting students
    * 
    * @param Request
    *
    **/
    public function delete(Request $request)
    {
        $deleted = $this->studentService->delete($request->id);
        if ($deleted) {
            return redirect('student');
        }
    }
}
