<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->orderBy('id')->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'phone'    => 'nullable|string|max:50',
            'active'   => 'nullable|boolean',
        ]);

        // 1) Create the user with role=teacher
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'role'     => 'teacher',
        ]);

        // 2) Create teacher profile
        Teacher::create([
            'user_id' => $user->id,
            'phone'   => $data['phone'] ?? null,
            'active'  => $request->boolean('active'),
        ]);

        return redirect()
            ->route('admin.teachers.index')
            ->with('status', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');

        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $teacher->user_id,
            'password' => 'nullable|string|min:6',
            'phone'    => 'nullable|string|max:50',
            'active'   => 'nullable|boolean',
        ]);

        // Update user
        $user = $teacher->user;
        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        // Update teacher profile
        $teacher->phone  = $data['phone'] ?? null;
        $teacher->active = $request->boolean('active');
        $teacher->save();

        return redirect()
            ->route('admin.teachers.index')
            ->with('status', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        // Optional: also delete the linked user
        $user = $teacher->user;

        $teacher->delete();

        // If this user is only a teacher, you can delete them
        // If you want to keep the login, comment the next line:
        $user->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('status', 'Teacher deleted successfully.');
    }
}