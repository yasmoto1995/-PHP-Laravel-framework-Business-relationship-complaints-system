@extends('cms.parent')

@section('title', 'Users')

@section('content')
<section class="content">
<div class="container-fluid">
<div class="row">

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>

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
          <table id="example2" class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>image</th>
                <th>Name</th>
                <th>Email</th>
                <th>title</th>
                <th>message </th>
                <th>type</th>
                <th>status</th>

                <th>closed_date</th>
                <th>response</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $student->id }}</td>
                    <td><img src="{{ $student->image ? Storage::url($student->image) :  'https://www.jea.com/cdn/images/avatar/avatar-alt.svg' }}" width="60px" height="60px" alt=""></td>
                    <td>{{ $student->student_name }}</td>
                    <td>{{ $student->email }}</td>

                    <td>{{ $student->title }}</td>
                    <td>{{ $student->message }}</td>
                    <td>{{ $student->type }}</td>
                    <td ><span class="{{ $student->status == 'Closed' ? 'badge badge-danger' : 'badge badge-success'}}">{{ $student->status }}</span> </td>

                    <td>{{ $student->closed_date }}</td>
                    <td>{{ $student->response  }}</td>
                    </td>
                  </tr>
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


