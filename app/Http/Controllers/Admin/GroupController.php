<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function index()
    {
        $groups = Group::with(['teachers.user'])  // load teachers AND their users
            ->withCount('students')
            ->get();

        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        $students = Student::orderBy('full_name')->get();
        $teachers = Teacher::with('user')->get();

        return view('admin.groups.create', compact('students', 'teachers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:100'],
            'schedule_info' => ['nullable', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
            'students' => ['nullable', 'array'],
            'teachers' => ['nullable', 'array'],
        ]);

        $data['active'] = $request->has('active');

        $group = Group::create($data);

        $group->students()->sync($request->students ?? []);
        $group->teachers()->sync($request->teachers ?? []);

        return redirect()->route('admin.groups.index')
            ->with('status', 'Group created successfully.');
    }

    public function edit(Group $group)
    {
        $students = Student::orderBy('full_name')->get();
        $teachers = Teacher::with('user')->get();

        return view('admin.groups.edit', compact('group', 'students', 'teachers'));
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:100'],
            'schedule_info' => ['nullable', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
            'students' => ['nullable', 'array'],
            'teachers' => ['nullable', 'array'],
        ]);

        $data['active'] = $request->has('active');

        $group->update($data);

        $group->students()->sync($request->students ?? []);
        $group->teachers()->sync($request->teachers ?? []);

        return redirect()->route('admin.groups.index')
            ->with('status', 'Group updated successfully.');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('admin.groups.index')
            ->with('status', 'Group deleted successfully.');
    }
}