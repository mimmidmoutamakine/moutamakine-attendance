<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Group;
use App\Models\StudentAttendance;
use App\Models\TeacherAttendance;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $last7 = Carbon::today()->subDays(6)->toDateString();

        // Core numbers
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalGroups   = Group::count();

        // Student attendance today
        $studentToday = StudentAttendance::where('attendance_date', $today)->get();
        $studentSummaryToday = [
            'P' => $studentToday->where('status', 'P')->count(),
            'A' => $studentToday->where('status', 'A')->count(),
            'R' => $studentToday->where('status', 'R')->count(),
        ];

        // Teacher attendance today
        $teacherToday = TeacherAttendance::where('attendance_date', $today)->get();
        $teacherSummaryToday = [
            'P' => $teacherToday->where('status', 'P')->count(),
            'A' => $teacherToday->where('status', 'A')->count(),
            'R' => $teacherToday->where('status', 'R')->count(),
        ];

        // Student attendance for last 7 days (grouped by date)
        $studentLast7 = StudentAttendance::selectRaw('attendance_date, COUNT(*) as total')
            ->whereBetween('attendance_date', [$last7, $today])
            ->groupBy('attendance_date')
            ->orderBy('attendance_date')
            ->get();

        return view('admin.dashboard', [
            'today'                => $today,
            'totalStudents'        => $totalStudents,
            'totalTeachers'        => $totalTeachers,
            'totalGroups'          => $totalGroups,
            'studentSummaryToday'  => $studentSummaryToday,
            'teacherSummaryToday'  => $teacherSummaryToday,
            'studentLast7'         => $studentLast7,
        ]);
    }
}