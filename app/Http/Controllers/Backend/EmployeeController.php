<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Notifications;
use App\Models\Requests;
use App\Models\User;

use Auth;
use Illuminate\Support\Facades\Hash;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class EmployeeController extends Controller
{
	public function __construct() {
		date_default_timezone_set('Africa/Cairo');
	}

	//admin
	public function index() {
		$this->middleware('authAdmin:admin');

		$users = DB::table('users')
			->where('active', 1)
			->get();

		return view('dashboard.employee.index', compact('users'));
	}

	//admin
	public function list() {
		$this->middleware('authAdmin:admin');

		$users = DB::table('users')
			->where('active', 1)
			->get();
		return view('dashboard.employee.list', compact('users'));
	}

	//auth
	public function create() {
		$users = User::all();
		$this->middleware('auth');

		$employees = DB::table('employees')->where('user_id', auth()->id())->get();
		if ( $employees->count() > 0 ) {
			foreach ( $employees as $employee ) {
				$department = Department::findOrFail($employee->department_id);
				return view('dashboard.employee.profile', compact('employee', 'department', 'users'));
			}
		}
	}

	//auth
	public function editView() {
		$users = User::all();

		$this->middleware('auth');

		$employees = DB::table('employees')->get();
		return view('dashboard.employee.edit', compact('employees', 'users'));
	}

	//admin
	public function show( $id ) {
		$this->middleware('authAdmin:admin');

		$users = User::all();
		$user = User::findOrFail($id);
		$departments = Department::paginate();
		$employees = DB::table('employees')->where('user_id', $id)->get();

		return view('dashboard.employee.view', compact('employees', 'departments', 'user', 'users'));
	}

	//auth
	public function edit( Request $request ) {
		$users = User::all();

		$this->middleware('auth');

		$this->validate($request, [
			"pic" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
			"name" => "required",
			"email" => "required",
		]);

		$user = User::findOrFail(Auth::user()->id);

		$employees = DB::table('employees')->where('user_id', $user->id)->get();

		if ( $employees->count() > 0 ) {
			foreach ( $employees as $employee ) {
				if ( $request->pic ) {
					$path = public_path('uploads/users_images/' . Auth::user()->id . '/');
					if ( !file_exists($path) ) {
						mkdir($path, 0777, true);
					}

					Storage::disk('public_uploads')->delete('users_images/' . Auth::user()->id . '/' . $employee->pic);

					\Intervention\Image\Facades\Image::make($request->pic)->resize(300, null, function ( $constraint ) {
						$constraint->aspectRatio();
					})->save(public_path('uploads/users_images/' . Auth::user()->id . '/' . $request->pic->hashName()));

					$photo = $request->pic->hashName();
				}

				$user->update([
					'name' => $request->name,
					'email' => $request->email,
				]);

				DB::table('employees')->where('id', $employee->id)->update([
					'pic' => $photo,
				]);

				return redirect()->route('employees.create');
			}
		}
	}

	//admin
	public function update( $id ) {
		$this->middleware('authAdmin:admin');

		$user = User::findOrFail($id);

		if ( $user->head == 0 ) {
			$user->update(['head' => 1]);
			return redirect()->back();
		}
		if ( $user->head == 1 ) {
			$user->update(['head' => 0]);
			return redirect()->back();
		}
	}

	//admin
	public function destroy( $id ) {
		$this->middleware('authAdmin:admin');

		$user = User::findOrFail($id);

		$user->update(['active' => -2]);
		return redirect('home');
	}

	public function homeRedirection() {
		if ( Auth::check() ) {
			return redirect('/employee/home');
		} else {
			if ( Auth::guard('admin')->check() ) {
				return redirect('/admin/home');
			} else {
				return view('welcome');
			}
		}
		//set system redirection (Admin - Employee)
	}

	public function userRedirection() {
		//set employee redirection
		if ( Auth::user() ) {
			$active = DB::table('users')
				->where('id', Auth::user()->id)
				->get();

			if ( $active->count() > 0 ) {
				foreach ( $active as $a ) {
					setcookie('active', $a->active, time() + 1800);
					if ( $a->active == 1 ) {
						setcookie('head', $a->head, time() + 1800);

						$employee = DB::table('employees')
							->where('user_id', $a->id)
							->get();

						if ( $employee->count() > 0 ) {
							$department = DB::table('employees')->where('user_id', Auth::user()->id)->get();
							if ( $department->count() > 0 ) {
								foreach ( $department as $item ) {
									$employees = DB::table('employees')
										->where('department_id', $item->department_id)
										->get();

									$notifications = DB::table('notifications')
										->where('department_id', $item->department_id)
										->get();

									$notifications_list = DB::table('notifications')
										->where('department_id', $item->department_id)
										->get();
								}
							}
							$users = User::all();
							$requests = Requests::paginate();
							$departments = Department::paginate();
							return redirect('/employee/home');
						} else {
							return redirect('selection');
						}
					} else {
						return view('dashboard.employee.guest');
					}
				}
			}
		} else {
			return redirect('/');
		}
	}

	//auth

	public function select() {
		$this->middleware('auth');

		$this->middleware('auth');
		$departments = Department::paginate();
		// $img = Image::make('css/foo.jpg')->resize(300, 200)->save()->response();

		return view('dashboard.employee.selection', compact('departments'));
	}

	//auth
	public function addMember( Request $request ) {
		$this->middleware('auth');

		$this->validate($request, [
			"pic" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
			"user_id" => "required",
			"department_id" => "required",
		]);

		$request_data = $request->except('pic');

		if ( $request->pic ) {
			$image = $this->handleImageAndGetFileToStore($request, "pic");
			$request_data['pic'] = $image;
		}

		$employee = Employee::create($request_data);
		$employee->save();

		return redirect('home');
	}

	public function home() {
		$users = User::all();
		return view('dashboard.employee.home', compact('users'));
	}

	//auth
	public function check() {
		$this->middleware('auth');

		$format = 'Y-m-d H:i:s';
		$date = date($format);
		$t = new Attendance();
		$t->check = 1;
		$t->check_date = $date;
		$t->user_id = Auth::user()->id;
		$t->save();
		return back();
	}

	//auth
	public function out() {
		$users = User::all();
		$this->middleware('auth');
		$attendace = DB::table('attendances')
			->where('user_id', Auth::user()->id)
			->get();

		if ( $attendace->count() > 0 ) {
			foreach ( $attendace as $a ) {
				$date_today = date("j, n, Y");

				$date_submitted = date("j, n, Y", strtotime($a->check_date));

				$attendance_hours = date('H') - date("H", strtotime($a->check_date));

				if ( $date_today == $date_submitted ) {
					$format = 'Y-m-d H:i:s';
					$date = date($format);

					DB::table('attendances')->where('id', $a->id)->update([
						'check_out' => 1,
						'sum' => $attendance_hours,
						'check_out_date' => $date,
					]);
				}
			}
		}
		return back();
	}

	public function restView() {
		$users = User::all();
		return view('dashboard.employee.rest', compact('users'));
	}

	public function restPassword( Request $request ) {
		$this->validate($request, [
			'password' => 'required|min:6',
		]);

		$user = User::findOrFail(Auth::user()->id);
		$user->password = Hash::make($request->password);
		$user->save();

		$users = User::all();
		return redirect('home');
	}

	public function getNewNotificationsNumberHead() {
		$department = DB::table('employees')
			->where('user_id', Auth::user()->id)
			->first();

		$notifications = DB::table('notifications')->where('seen', 0)->where('department_id', $department->department_id)->whereNotIn('user_id', [Auth::user()->id])->count();

		return $notifications;
	}

	public function getNewNotificationsNumberUser() {
		$notifications = DB::table('notifications')->where('seen_by_user', 0)->where('user_id', Auth::user()->id)->count();
		return $notifications;
	}

	public function getNotificationsUser() {
		if ( Auth::user()->head == 0 ) {
			return Auth::user()->notifications;
		}
	}

	public function getNotificationsHead() {
		if ( Auth::user()->head == 1 ) {
			$department = DB::table('employees')
				->where('user_id', Auth::user()->id)
				->first();

			$notifications = DB::table('notifications')->where('seen', 0)->where('department_id', $department->department_id)->whereNotIn('user_id', [Auth::user()->id])->paginate(5);
			return $notifications;
		}
	}

	public function viewRequest( $notificationId ) {
		$users = User::all();
		$notification = Notifications::findOrFail($notificationId);
		$request = Requests::findOrFail($notification->request_id);
		$user = User::where('id', $request->user_id)->first();
		$employee = Employee::where('user_id', $request->user_id)->first();
		return view('dashboard.employee.view_request', compact('request', 'user', 'employee', 'users', 'notification'));
	}

	public function acceptRequest( $notificationId ) {
		DB::table('notifications')->where('id', $notificationId)->update(['seen' => 1, 'accept' => 1]);
		$notification = Notifications::findOrFail($notificationId);
		DB::table('requests')->where('id', $notification->request_id)->update(['status' => 1]);
		return back();
	}

	public function acceptRequestNotification( $requestId ) {
		DB::table('notifications')->where('request_id', $requestId)->update(['seen' => 1, 'accept' => 1]);
		DB::table('requests')->where('id', $requestId)->update(['status' => 1]);
		return back();
	}

	public function rejectRequestNotification( $requestId ) {
		DB::table('notifications')->where('request_id', $requestId)->update(['seen' => 1, 'accept' => -1]);
		DB::table('requests')->where('id', $requestId)->update(['status' => -1]);
		return back();
	}

	public function rejectRequest( $notificationId ) {
		DB::table('notifications')->where('id', $notificationId)->update(['seen' => 1, 'accept' => -1]);
		$notification = Notifications::findOrFail($notificationId);
		DB::table('requests')->where('id', $notification->request_id)->update(['status' => -1]);
		return back();
	}

	public function getAttendanceHours() {
		$users = DB::table('users')
			->where('active', 1)
			->get();
		$employees = Employee::where('department_id', Auth::user()->employee->department->id)->get();
		$departments = Department::paginate();

		$hours_of_user_attendance = array();
		$attendances = Attendance::paginate();

		if ( $users->count() > 0 ) {
			foreach ( $users as $user ) {
				$hours_of_user_attendance[$user->id] = DB::table('attendances')->where('user_id', $user->id)->sum('sum');
			}
		}

		return view('dashboard.employee.attendance', compact('users', 'departments', 'employees', 'attendances', 'hours_of_user_attendance'));
	}

	public function notifications() {
		$users = User::all();

		$requests = Requests::all();
		return view('dashboard.employee.notifications', compact('users', 'requests'));
	}

	private function handleImageAndGetFileToStore( $request, $key ) {
		if ( $request->file($key) ) {
			$path = public_path('uploads/users_images/' . $request->user_id);
			if ( !file_exists($path) ) {
				mkdir($path, 0777, true);
			}
			$image = $request->file($key);
			$filename = $image->getClientOriginalName();
			$fileExtension = $image->getClientOriginalExtension();
			$file_to_store = time() . '' . explode('.', $filename)[0] . '.' . $fileExtension;

			$image->move('uploads/users_images/' . $request->user_id, $file_to_store);

			return $file_to_store;
		} else {
			return null;
		}
	}
}

