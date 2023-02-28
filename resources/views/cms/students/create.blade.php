@extends('cms.parent')

@section('title', 'Complaints and Suggestions')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Complaints and Suggestions</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea type="text" class="form-control" id="message" name="message" placeholder="Message">{{ old('message') }}</textarea>
                </div>

                <div>
                    <!-- select -->
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="Complaint">Complaint</option>
                            <option value="Suggestion">Suggestion</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="student_university_id">Student University ID</label>
                    <input type="text" class="form-control" value="{{ old('student_university_id') }}" id="student_university_id" name="student_university_id"
                        placeholder="Student University Id">
                </div>

                <div class="form-group">
                    <label for="student_name">Student name</label>
                    <input type="text" class="form-control" value="{{ old('student_name') }}" id="student_name" name="student_name"
                        placeholder="Student name">
                </div>

                <div class="form-group">
                    <label for="student_email">Student email</label>
                    <input type="email" class="form-control" value="{{ old('student_email') }}" id="student_email" name="student_email"
                        placeholder="Student email">
                </div>

                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" name="urgent" value="{{ old('urgent') }}" id="urgent">
                        <label class="custom-control-label" for="urgent">Is it urgent?</label>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
