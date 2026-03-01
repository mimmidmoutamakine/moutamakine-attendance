<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $teacher = auth()->user()->teacher;

        $groups = $teacher->groups()->withCount('students')->get();

        return view('teacher.groups.index', compact('groups'));
    }

    public function show(Group $group, Request $request)
    {
        // 1) Current date for this screen: from query ?date=..., or today by default
        $date = $request->query('date', now()->toDateString());

        // 2) Get all students in this group
        $students = $group->students()
            ->orderBy('full_name')   // change column name if your field is different
            ->get();

        // 3) Load existing attendance records for this group + date
        $existing = StudentAttendance::where('group_id', $group->id)
            ->where('attendance_date', $date)
            ->get()
            ->keyBy('student_id');  // so we can do $existing[$student_id]

        // 4) Attach "attendance_status" to each student ('P', 'A', 'R' or null)
        foreach ($students as $student) {
            $student->attendance_status = optional($existing->get($student->id))->status;
        }

        // 5) Pass $date + $students to the view
        return view('teacher.groups.show', [
            'group'    => $group,
            'students' => $students,
            'date'     => $date,
        ]);
    }
    public function store(Request $request, Group $group)
    {
        $teacher = auth()->user()->teacher;

        if (! $teacher->groups->contains($group->id)) {
            abort(403);
        }

        $date = $request->attendance_date;

        foreach ($request->attendance as $studentId => $status) {
            StudentAttendance::updateOrCreate(
                [
                    'group_id' => $group->id,
                    'student_id' => $studentId,
                    'attendance_date' => $date,
                ],
                [
                    'teacher_id' => $teacher->id,
                    'status' => $status,
                ]
            );
        }

        return redirect()->back()->with('status', 'Attendance saved.');
    }
}