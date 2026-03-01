<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    
    public function index(Request $request)
    {
        // 1) Date for this screen
        $date = $request->query('date', now()->toDateString());

        // 2) All teachers with their user for display name
        $teachers = Teacher::with('user')
            ->orderBy('id')
            ->get();

        // 3) Existing attendance for that date
        $attendance = TeacherAttendance::where('attendance_date', $date)
            ->get()
            ->keyBy('teacher_id');

        // 4) Attach status to each teacher
        foreach ($teachers as $teacher) {
            $teacher->attendance_status = optional($attendance->get($teacher->id))->status;
        }

        // 5) Summary counts
        $summary = [
            'P' => $attendance->where('status', 'P')->count(),
            'A' => $attendance->where('status', 'A')->count(),
            'R' => $attendance->where('status', 'R')->count(),
        ];

        return view('admin.teacher_attendance.index', [
            'teachers' => $teachers,
            'date'     => $date,
            'summary'  => $summary,
        ]);
    }

    public function store(Request $request)
    {
        $date = $request->input('attendance_date');

        foreach ($request->attendance ?? [] as $teacherId => $status) {
            TeacherAttendance::updateOrCreate(
                [
                    'teacher_id' => $teacherId,
                    'attendance_date' => $date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()
            ->route('admin.teacher-attendance.index', ['date' => $date])
            ->with('status', 'Teacher attendance saved.');
    }
}