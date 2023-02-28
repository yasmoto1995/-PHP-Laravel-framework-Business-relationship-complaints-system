@extends('cms.parent')

@section('title', 'Admins')

@section('style')
    <style>
        .delete-btn {
            color: red;
            outline-width: 0px;
            outline-color: white;
            border-width: 0px;
            background-color: transparent;
            padding: 0px;
        }

        .actions {
            display: flex;
            flex-direction: row;
            column-gap: 10px;
        }
    </style>
@endsection

@section('content')
<section class="content">
<div class="container-fluid">
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Admins</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
             <tbody>

              @foreach ($admins as $admin)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <img class="img-circle img-bordered-sm" src="{{ $admin->image ? Storage::url($admin->image) :  'https://www.jea.com/cdn/images/avatar/avatar-alt.svg' }}"
                        width="60px" height="60px" alt="">
                    </td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td class="actions">
                      <a href="{{ route('admin.edit', $admin->id) }}">Edit</a>
                      <form action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="delete-btn" type="submit">Delete</button>
                    </form>
                </tr>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
</section>
@endsection
