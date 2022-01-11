@extends('layouts.app')
@section('content')
<button class="btn btn-primary add" data-toggle="modal" data-target="#mark-modal">Add</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Maths</th>
            <th scope="col">Science</th>
            <th scope="col">History</th>
            <th scope="col">Term</th>
            <th scope="col">Total Marks</th>
            <th scope="col">Created On</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($marks as $mark)
        <tr>
            <th scope="row">{{$mark->id}}</th>
            <td>{{$mark->student->name}}</td>
            <td>{{$mark->maths}}</td>
            <td>{{$mark->science}}</td>
            <td>{{$mark->history}}</td>
            <td><?= Config::get('constants.TERM.'.$mark->term)?></td>
            <td>{{$mark->total_mark}}</td>
            <td>{{date("M d, Y h:i A", strtotime($mark->created_at))}}</td>
            <td>
                <a href="mark/delete/{{$mark->id}}" class="btn btn-danger" data-id="{{$mark->id}}">Delete</a>
                <a class="btn btn-warning edit" data-url="mark/edit/{{$mark->id}}" data-toggle="modal"
                    data-target="#mark-modal">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

<div id="mark-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="mark/save" name="mark-form" id="mark-form" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="student_id" class="control-label">Student</label>
                                <select class="form-control" name="student_id" id="student_id">
                                    @foreach($students as $student)
                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="student_id-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="term" class="control-label">Term</label>
                                <select class="form-control" name="term" id="term">
                                @foreach(Config::get('constants.TERM') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                                </select>
                                <span class="text-danger" id="term-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="maths" class="control-label">Maths</label>
                                <input type="number" class="form-control" name="maths" id='maths'>
                                <span class="text-danger" id="maths-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="science" class="control-label">Science</label>
                                <input type="number" class="form-control" name="science" id='science'>
                                <span class="text-danger" id="science-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="history" class="control-label">History</label>
                                <input type="number" class="form-control" name="history" id='history'>
                                <span class="text-danger" id="history-error"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-url="mark/save" data-form="mark-form" class="btn btn-primary save">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>