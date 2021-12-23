<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
	public function __construct() {
		$this->middleware('authAdmin:admin');
	}

	public function index() {
		$departments = Department::all();
		$users = User::all();
		return view('dashboard.department.index', compact('departments', 'users'));
	}

	public function create() {
		return view('dashboard.department.create');
	}

	public function store( Request $request ) {
		$this->validate($request, [
			"name" => "required|unique:departments",
		]);

		$request_data = $request->all();
		$department = Department::create($request_data);
		$department->save();
		return redirect()->route('departments.index');
	}

	public function destroy( $id ) {
		Department::findOrFail($id)->delete();
		return redirect()->route('departments.index');
	}
}
