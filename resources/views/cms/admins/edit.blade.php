@extends('cms.parent')

@section('title', 'Edit Admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Admin</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form method="POST" action="{{ route('admin.update', $admin->id) }}">
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
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter username" value="{{ old('user_name') ?? $admin->name }}">
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email address</label>
                        <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter email" value="{{ old('user_email') ?? $admin->email }}">
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
