<?php

namespace App\Services;

use App\Models\Mark;
use App\Models\Student;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Str;

class MarkService 
{
	// For getting all Students
	public function getStudents()
	{
		return Student::where('is_deleted', 0)->select('id', 'name')
			->orderBy('id', 'desc')->get();
	}

	// For getting all marks
	public function getMarks()
	{
		return Mark::select('*')
			->where('is_deleted', 0)
			->with('student')
			->orderBy('id', 'desc')->get();
	}

	// For adding new Marks
	public function storeMark($request)
	{
		$data = [
			'student_id' => $request->student_id,
			'maths' => $request->maths,
			'science' => $request->science,
			'history' => $request->history,
			'term' => $request->term,
			'total_mark' => intval($request->science) + intval($request->history) + intval($request->maths),
			'updated_at' => Carbon::now()
		];
		if ($request->id) {
			return Mark::where('id', $request->id)->update($data);
		}
		$data['created_at'] = Carbon::now();

		return Mark::insert($data);
	}

	// For getting single Marks
	public function get($id)
	{
		return Mark::select('*')
			->with('student')
			->findOrFail($id);
	}

	// For soft deleting Marks
	public function delete($id)
	{
		return Mark::where('id', $id)->update(['is_deleted' => 1]);
	}
}

