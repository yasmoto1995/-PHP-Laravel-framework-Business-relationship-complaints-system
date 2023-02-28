@extends('cms.parent')

@section('title', 'Edit User')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('students.update', $student->id) }}">
                    @method('PUT')
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



                        <div class="form-group">
                            <label for="title">response</label>
                            <textarea class="form-control" name="response" id="message" placeholder="Enter The message">{{ old('response', $student->response) }}</textarea>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="close" name="close"
                                id="close" @checked($student->status == 'Closed')  >
                            <label class="form-check-label" for="close">
                                close
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="not_close" name="close"
                                id="open" @checked($student->status == 'Open') >
                            <label class="form-check-label" for="open">
                                not close
                            </label>
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </section>

@endsection
