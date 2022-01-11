<?php

namespace App\Services;

use App\Models\Student;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Str;

class StudentService 
{
	// For getting all Students
	public function getStudents()
	{
		return Student::where('is_deleted', 0)->select('*')
			->orderBy('id', 'desc')->get();
	}

	// For adding new Students
	public function storeStudent($request)
	{
		$data = [
			'name' => $request->name,
			'age' => $request->age,
			'gender' => $request->gender,
			'reporting_teacher' => $request->reporting_teacher,
			'updated_at' => Carbon::now()
		];
		if ($request->id) {
			return Student::where('id', $request->id)->update($data);
		}
		$data['created_at'] = Carbon::now();

		return Student::insert($data);
	}

	// For getting single Students
	public function get($id)
	{
		return Student::select('id','name','age','gender','reporting_teacher')->findOrFail($id);
	}

	// For soft deleting Students
	public function delete($id)
	{
		return Student::where('id', $id)->update(['is_deleted' => 1]);
	}
}

