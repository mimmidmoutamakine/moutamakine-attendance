<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('full_name')->paginate(20);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'   => ['required', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'phone'       => ['nullable', 'string', 'max:100'],
            'active'      => ['nullable', 'boolean'],
            'notes'       => ['nullable', 'string'],
        ]);

        // checkbox 'active' if not sent = false
        $data['active'] = $request->has('active');

        Student::create($data);

        return redirect()->route('admin.students.index')
            ->with('status', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'full_name'   => ['required', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'phone'       => ['nullable', 'string', 'max:100'],
            'active'      => ['nullable', 'boolean'],
            'notes'       => ['nullable', 'string'],
        ]);

        $data['active'] = $request->has('active');

        $student->update($data);

        return redirect()->route('admin.students.index')
            ->with('status', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('status', 'Student deleted successfully.');
    }
}