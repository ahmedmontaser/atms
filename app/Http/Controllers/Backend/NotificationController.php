<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function update($id , $accept)
    {
        DB::table('notifications')->where('id' , $id)->update(['accept' => $accept]);
        $notification = Notifications::findOrFail($id);
        DB::table('requests')->where('id' , $notification->request_id)->update(['status' => $accept]);
        return back();
    }
}
