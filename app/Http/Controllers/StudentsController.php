<?php

namespace App\Http\Controllers;

use App\Mail\sendNumber;
use App\Mail\SendResponse;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Student::all();
        return response()->view('cms.students.index', ['students' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //
        $request->validate([
            'title' => 'required|string|min:3|max:40',
            'message' => 'required|string|min:5',
            'type' => 'required',
            'student_university_id' => 'required|string|min:5|max:15',
            'student_name' => 'required|string|min:5',
            'student_email' => 'required|string|email|unique:admins,email',
            'image' => 'nullable|image|mimes:jpg,png|max:1024',
            'urgent' =>  'nullable|in:on,off',
        ]);
        $student = new Student();
        $student->title = $request->input('title');
        $student->message = $request->input('message');
        $student->type = $request->input('type');
        $student->student_university_id = $request->input('student_university_id');
        $student->student_name = $request->input('student_name');
        $student->email = $request->input('student_email');
        $student->urgent = $request->has('urgent');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_name = time() . '_image_' . $student->student_name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("students", $image_name,['disk' => 'public']);
            $student->image = "students/" . $image_name;
        }
        $saved = $student->save();
        if ($saved) {
            Mail::to($student)->send(new sendNumber($student));
        }


        return redirect()->route('students.create');
    }


    public function search()
    {
        return response()->view('cms.students.search');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $request->validate([
            'search' => 'required|max:20|exists:students,id',
        ]);

        $student = Student::findOrFail($request->search);
        return view('cms.students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student = Student::findOrFail($id);
        return view('cms.students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->close == 'close'  && $request->response == null) {
            return redirect()->route('students.edit',$id);
        }
        $student = Student::findOrFail($id);
        $student->response = $request->response;

        if ($request->close == 'close') {
            $student->status = 'Closed';
            $student->closed_date = date('Y-m-d H:i:s');

        }
        $saved = $student->save();
        if ($saved) {
            Mail::to($student)->send(new SendResponse($student));
        }
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
