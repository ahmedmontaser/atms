<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Requests;
use Auth;

class RequestController extends Controller
{
	//admin
	public function index() {
		$this->middleware('authAdmin:admin');
		$users = DB::table('users')
			->where('active', 0)
			->get();

		return view('dashboard.request.index', compact('users'));
	}

	//admin
	public function create() {
		$this->middleware('authAdmin:admin');

		$users = DB::table('users')
			->where('active', 1)
			->get();
		$requests = DB::table('requests')
			->where('status', 0)
			->get();
		$employees = Employee::paginate();
		$departments = Department::paginate();
		return view('dashboard.request.checkout', compact('users', 'requests', 'employees', 'departments'));
	}

	//auth
	public function store( Request $request ) {
		$this->middleware('auth');

		$this->validate($request, [
			"reason" => "required",
		]);
		$t = new Requests();
		$t->user_id = Auth::user()->id;
		$t->reason = $request->reason;
		$t->status = 0;
		$t->save();
		$t2 = new Notifications();
		$t2->request_id = $t->id;
		$t2->user_id = $t->user_id;
		$department = DB::table('employees')->where('user_id', $t->user_id)->get();
		if ( $department->count() > 0 ) {
			foreach ( $department as $item ) {
				$t2->department_id = $item->department_id;
			}
		}
		$t2->save();
		return back();
	}

	//head
	public function headcheckout() {
		if ( Auth::user()->head == 1 ) {
			$users = DB::table('users')
				->where('active', 1)
				->get();
			$requests = DB::table('requests')
				->where('status', 0)
				->get();
			$employees = Employee::paginate();
			$head_department = DB::table('employees')->where('user_id', Auth::user()->id)->get();
			foreach ( $head_department as $d ) {
				$department = $d->department_id;
			}
			$department_data = Department::findOrFail($department);
			return view('dashboard.request.headcheckout', compact('users', 'requests', 'employees', 'department', 'department_data'));
		} else {
			return redirect('home');
		}
	}

	//admin
	public function edit( $id ) {
		$this->middleware('authAdmin:admin');

		DB::table('users')
			->where('id', $id)
			->update(['active' => 1]);
		return back();
	}

	//admin
	public function update( $id, $respond ) {
		$this->middleware('authAdmin:admin');

		DB::table('requests')->where('id', $id)->update(['status' => $respond]);
		DB::table('notifications')->where('request_id', $id)->update(['accept' => $respond, 'seen' => 1]);
		return back();
	}

	//admin
	public function destroy( $id ) {
		$this->middleware('authAdmin:admin');

		DB::table('users')
			->where('id', $id)
			->update(['active' => -1]);
		return back();
	}
}
