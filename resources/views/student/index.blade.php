@extends('layouts.app')
@section('content')
<button class="btn btn-primary add" data-toggle="modal" data-target="#student-modal">Add</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Gender</th>
            <th scope="col">Reporting Teacher</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <th scope="row">{{$student->id}}</th>
            <td>{{$student->name}}</td>
            <td>{{$student->age}}</td>
            <td>{{$student->gender}}</td>
            <td><?= Config::get('constants.REPORTING_TEACHER.'.$student->reporting_teacher)?></td>
            <td>
                <a href="student/delete/{{$student->id}}" class="btn btn-danger" data-id="{{$student->id}}">Delete</a>
                <a class="btn btn-warning edit" data-url="student/edit/{{$student->id}}" data-toggle="modal"
                    data-target="#student-modal">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

<div id="student-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="student/save" name="student-form" id="student-form" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" id='name'>
                                <span class="text-danger" id="name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="age" class="control-label">Age</label>
                                <input type="number" class="form-control" name="age" id='age'>
                                <span class="text-danger" id="age-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="gender" class="control-label">Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                @foreach(Config::get('constants.GENDER') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                                </select>
                                <span class="text-danger" id="gender-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="reporting_teacher" class="control-label">Reporting Teacher</label>
                                <select class="form-control" name="reporting_teacher" id="reporting_teacher">
                                    @foreach(Config::get('constants.REPORTING_TEACHER') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="reporting_teacher-error"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-url="student/save" data-form="student-form" class="btn btn-primary save">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>