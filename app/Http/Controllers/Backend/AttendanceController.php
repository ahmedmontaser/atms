<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
	public function __construct() {
		$this->middleware('authAdmin:admin');
	}

	public function index() {
		$users = DB::table('users')
			->where('active', 1)
			->get();
		$employees = Employee::paginate();
		$departments = Department::paginate();

		$hours_of_user_attendance = array();
		$attendances = Attendance::paginate();

		if ( $users->count() > 0 ) {
			foreach ( $users as $user ) {
				$hours_of_user_attendance[$user->id] = DB::table('attendances')->where('user_id', $user->id)->sum('sum');
			}
		}

		return view('dashboard.admin.attendance', compact('users', 'departments', 'employees', 'attendances', 'hours_of_user_attendance'));
	}

	public function create() {
		$users = DB::table('users')
			->where('active', 1)
			->get();

		$head_employee = DB::table('employees')->where('user_id', Auth::user()->id)->get();
		if ( $head_employee->count() > 0 ) {
			foreach ( $head_employee as $a ) {
				$employees = DB::table('employees')->where('department_id', $a->department_id)->get();
				$hours_of_user_attendance = array();
				$department = Department::findOrFail($a->department_id);

				if ( $employees->count() > 0 ) {
					foreach ( $employees as $employee ) {
						$hours_of_user_attendance[$employee->user_id] = DB::table('attendances')->where('user_id', $employee->user_id)->sum('sum');
					}
				}
			}
		}

		return view('dashboard.request.attendance_department', compact('users', 'department', 'hours_of_user_attendance'));
	}
}
