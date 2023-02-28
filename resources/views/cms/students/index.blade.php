@extends('cms.parent')

@section('title', 'Students Suggestions and Complaints ')

@section('style')
    <style>
        .actions {
            display: flex;
            flex-direction: row;
            column-gap: 5px;
        }

        td,
        th {
            max-width: 270px;
            min-width: 60px;
            text-align: left;
            word-wrap: break-word;
        }

        td div {
            height: 60px;
            overflow: auto;
            max-width: 270px;
            word-wrap: break-word;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>image</th>
                                        <th>title</th>
                                        <th>message </th>
                                        <th>type</th>
                                        <th>student_university_id</th>
                                        <th>student_name</th>
                                        <th>email </th>
                                        <th>status</th>
                                        <th>urgent</th>
                                        <th>closed_date</th>
                                        <th>response</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><img src="{{ $student->image ? Storage::url($student->image) : 'https://www.jea.com/cdn/images/avatar/avatar-alt.svg' }}"
                                                    width="60px" height="60px" alt=""></td>
                                            <td>{{ $student->title }}</td>
                                            <td>{{ $student->message }}</td>
                                            <td>{{ $student->type }}</td>
                                            <td>{{ $student->student_university_id }}</td>
                                            <td>{{ $student->student_name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                <span class="{{ $student->status == 'Closed' ? 'badge badge-danger' : 'badge badge-success' }}">
                                                    {{ $student->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($student->urgent)
                                                    <span class="badge badge-success">Urgent</span>
                                                @else
                                                    <span class="badge badge-danger">In-Urgent</span>
                                                @endif
                                            </td>
                                            <td>{{ $student->closed_date }}</td>
                                            <td>
                                                <div>
                                                    {{ $student->response }}
                                                </div>
                                            </td>
                                            </td>
                                            <td class="actions">
                                                <a class="btn btn-outline-primary btn-sm btn-block"
                                                    href="{{ route('students.edit', $student->id) }}"> <i
                                                        class=" fas fa-plus"></i> Response</a>
                                            </td>
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
